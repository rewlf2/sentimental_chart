<?php

/**
 * handling crimson hexagon api data fetch and store data to database
 */
class CrimsonHexagonApiFetching
{
    /**
     * for fetching which monitor 
     *
     * @var int
     */
    protected $monitorId;

    /**
     * mysqli object for this api fetching to store data
     *
     * @var mysqli
     */
    protected $mysqli;
    
    /**
     * store when this object is created, using for inserting fetch api data date
     *
     * @var Datetime
     */
    protected $now;

    /**
     * for storing current hour for insert
     *
     * @var int
     */
    protected $hour;


    /**
     * @param int $monitorId
     * @param mysqli $mysqli
     */
    public function __construct($monitorId, mysqli $mysqli)
    {
        if($monitorId < 0)
        {
            throw new InvalidArgumentException("monitor id should not be negative: $monitorId");
        }

        $this->monitorId = $monitorId;
        $this->mysqli = $mysqli;
        $this->now = new Datetime(null, new DatetimeZone("utc"));
        $this->hour = (int) $this->now->format("H");
    }

    /**
     * fetch all defined endpoint from the config, will call this class functions
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    public function fetchAll(Datetime $start = null, Datetime $end = null)
    {
        // $this->fetchAuthors($start, $end);
        // $this->fetchInterestaffinities($start, $end);
        $this->fetchSentiments($start, $end);
        // $this->fetchSources($start, $end);
        // $this->fetchTwittermetrics($start, $end);
        $this->fetchVolumes($start, $end);
        // $this->fetchWordclouds($start, $end);
    }

    /**
     * fetch and store sentiment endpoint data
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    public function fetchSentiments(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["sentiment"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints['sentiment'],
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));

        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "results");
        
        foreach($apiResult["results"] as $result)
        {
            $startDate = new Datetime($result["startDate"]);
            $sentimentData = [
                "monitor_id" => $this->monitorId,
                
                "creation_date" => (new Datetime($result["creationDate"]))->format("Y-m-d H:i:s"),

                "date" => $startDate->format("Y-m-d"),
                "hour" => $this->hour,
                
                "number_of_documents" => $result["numberOfDocuments"],
                "number_of_relevant_documents" => $result["numberOfRelevantDocuments"],

                "category_negative_proportion" => $result["categories"][0]["proportion"],
                "category_negative_volume" => $result["categories"][0]["volume"],
                "category_negative_hidden" => $result["categories"][0]["hidden"],

                "category_positive_proportion" => $result["categories"][1]["proportion"],
                "category_positive_volume" => $result["categories"][1]["volume"],
                "category_positive_hidden" => $result["categories"][1]["hidden"],

                "category_neutral_proportion" => $result["categories"][2]["proportion"],
                "category_neutral_volume" => $result["categories"][2]["volume"],
                "category_neutral_hidden" => $result["categories"][2]["hidden"],

                "emotion_surprise_proportion" => $result["emotions"][0]["proportion"],
                "emotion_surprise_volume" => $result["emotions"][0]["volume"],
                "emotion_surprise_hidden" => $result["emotions"][0]["hidden"],

                "emotion_anger_proportion" => $result["emotions"][1]["proportion"],
                "emotion_anger_volume" => $result["emotions"][1]["volume"],
                "emotion_anger_hidden" => $result["emotions"][1]["hidden"],

                "emotion_neutral_proportion" => $result["emotions"][2]["proportion"],
                "emotion_neutral_volume" => $result["emotions"][2]["volume"],
                "emotion_neutral_hidden" => $result["emotions"][2]["hidden"],

                "emotion_disgust_proportion" => $result["emotions"][3]["proportion"],
                "emotion_disgust_volume" => $result["emotions"][3]["volume"],
                "emotion_disgust_hidden" => $result["emotions"][3]["hidden"],

                "emotion_joy_proportion" => $result["emotions"][4]["proportion"],
                "emotion_joy_volume" => $result["emotions"][4]["volume"],
                "emotion_joy_hidden" => $result["emotions"][4]["hidden"],

                "emotion_sadness_proportion" => $result["emotions"][5]["proportion"],
                "emotion_sadness_volume" => $result["emotions"][5]["volume"],
                "emotion_sadness_hidden" => $result["emotions"][5]["hidden"],

                "emotion_fear_proportion" => $result["emotions"][6]["proportion"],
                "emotion_fear_volume" => $result["emotions"][6]["volume"],
                "emotion_fear_hidden" => $result["emotions"][6]["hidden"]
            ];

            $this->insertIfNotExists(CrimsonHexagonConfig::tables['sentiment'], $sentimentData, 
                $startDate, $this->hour);
        }
    }

    /**
     * fetch volume data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    public function fetchVolumes(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["volume"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints['volume'], 
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));

        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "volumes");
     
        foreach($apiResult["volumes"] as $volume)
        {
            $startDate = new Datetime($volume["startDate"]);
            $volumeData = [
                "monitor_id" => $this->monitorId,
                "date" => $startDate->format("Y-m-d"),
                "number_of_documents" => $volume["numberOfDocuments"]
            ];

            foreach($volume["volume"] as $hour => $volumeValue)
            {
                // only getting data that is before now()
                if($volumeData["date"] === $this->now->format("Y-m-d")
                  && $hour >= $this->hour)
                {
                    continue;
                }

                // copy the data that will not change on each hour
                $eachVolumeData = $volumeData;
                $eachVolumeData["hour"] = $hour;
                $eachVolumeData["volume"] = $volumeValue;

                $this->insertIfNotExists(CrimsonHexagonConfig::tables['volume'], $eachVolumeData, 
                    $startDate, $hour);
            }
        }
    }

    /**
     * fetch sources data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    function fetchSources(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["sources"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints["sources"],
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "contentSources");

        foreach($apiResult["contentSources"] as $contentSource)
        {
            $startDate = new Datetime($contentSource["startDate"]);
            $sourceData = [
                "monitor_id" => $this->monitorId,
                "date" => $startDate->format("Y-m-d"),
                "hour" => $this->hour
            ];

            // only insert child data if the data is not exists
            if($this->insertIfNotExists(CrimsonHexagonConfig::tables["sources"], $sourceData,
                $startDate, $this->hour))
            {
                $sourceId = MysqlHelper::getLastInsertId($this->mysqli);

                foreach($contentSource["topSites"] as $site => $score)
                {
                    $topSiteData = [
                        "source_id" => $sourceId,
                        "site" => $site,
                        "score" => $score
                    ];

                    MysqlHelper::insertData($this->mysqli, CrimsonHexagonConfig::tables["source_top_site"], $topSiteData);
                }

                foreach($contentSource["sources"] as $sourceName => $score)
                {
                    $sourceData = [
                        "source_id" => $sourceId,
                        "source_name" => $sourceName,
                        "score" => $score
                    ];

                    MysqlHelper::insertData($this->mysqli, CrimsonHexagonConfig::tables["source_source"], $sourceData);
                }
            }

        }

    }

    /**
     * fetch interestaffinities data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    function fetchInterestaffinities(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["interestaffinities"], $start, $end);
        
        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints["interestaffinities"], 
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "dailyResults");

        foreach($apiResult["dailyResults"] as $dailyResult)
        {
            $startDate = new Datetime($dailyResult["startDate"]);
            $resultData = [
                "monitor_id" => $this->monitorId,
                "date" => $startDate->format("Y-m-d"),
                "hour" => $this->hour
            ];

            // only insert child data if the data is not exists
            if($this->insertIfNotExists(CrimsonHexagonConfig::tables["interestaffinitie"], $resultData,
                $startDate, $this->hour))
            {
                $interestaffinitieId = MysqlHelper::getLastInsertId($this->mysqli);
                foreach($dailyResult["info"] as $info)
                {
                    $infoData = [
                        "interestaffinitie_id" => $interestaffinitieId,
                        "id" => $info["id"],
                        "name" => $info["name"],
                        "relevancy_score" => $info["relevancyScore"],
                        "percent_in_monitor" => $info["percentInMonitor"],
                        "percent_on_twitter" => $info["percentOnTwitter"]
                    ];
                    
                    MysqlHelper::insertData($this->mysqli, CrimsonHexagonConfig::tables["interestaffinitie_info"], $infoData);
                }
            }
        }
    }

    /**
     * fetch wordcloud data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    function fetchWordcloud(Datetime $start = null, Datetime $end = null){
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["sentiment"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints["interestaffinities"],
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "data");
        
        foreach($apiResult["data"] as $hashTag => $score)
        {
            $starDate = $this->now;
            $wordCloud = [
                "monitor_id" => $this->monitorId,
                "date" => $startDate->format("Y-m-d"),
                "hour" => $this->hour
            ];

            // only insert child data if the data is not exists
            if($this->insertIfNotExists(CrimsonHexagonConfig::tables["wordcloud"], $wordCloud,
                $startDate, $this->hour))
            {
                $wordCloudId = MysqlHelper::getLastInsertId($this->mysqli);

                $wordCloudData = [
                    "wordcolud_id" => $wordCloudId,
                    "hash_tag" => $hashTag,
                    "score" => $score
                ];

                MysqlHelper::insertData($this->mysqli, CrimsonHexagonConfig::tables["wordcloud_word"], $wordCloudData);
            }
        }
    }
    
    /**
     * fetch authors data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    function fetchAuthors(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["sentiment"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::volume_endpoint, 
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "authors");

        foreach($apiResult["authors"] as $author)
        {
            $startDate = new Datetime($author["startDate"]);
            $authorData = [
                "monitor_id" => $this->monitorId,
                "date" => $startDate->format("Y-m-d"),
                "hour" => $this->hour,                
            ];

            // only insert child data if the data is not exists
            if($this->insertIfNotExists(CrimsonHexagonConfig::tables["author"], $authorData,
                $startDate, $this->hour))
            {
                $authorId = MysqlHelper::getLastInsertId($this->mysqli);

                foreach($author["authorDetails"] as $authorDetail)
                {
                    $authorDetailData = [
                        "author_id" => $authorId,
                        "kloutScore" => $authorDetail["kloutScore"],
                        "detailsDate" => $authorDetail["detailsDate"]
                    ];

                    MysqlHelper::insertData($this->mysqli, 
                        CrimsonHexagonConfig::tables["author_detail"], $authorDetailData);
                }
            }
        }
    }

    /**
     * fetch twittermetrics data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    function fetchTwittermetrics(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["sentiment"], $start, $end);
        
        $url = $this->createEndpointUrl(CrimsonHexagonConfig::volume_endpoint, 
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "dailyResults");

        foreach($apiResult["dailyResults"] as $dailyResult)
        {
            $starDate = new Datetime($contentSource["startDate"]);
            $resultData = [
                "monitor_id" => $this->monitorId,
                "date" => $startDate->format("Y-m-d"),
                "hour" => $this->hour,              
            ];

            // only insert child data if the data is not exists
            if($this->insertIfNotExists(CrimsonHexagonConfig::tables["twittermetric"], $resultData,
                $startDate, $this->hour))
            {
                $resultId = MysqlHelper::getLastInsertId($this->mysqli);

                foreach($dailyResult["topHashtags"] as $hashTag => $score)
                {
                    $topHashTagData = [
                        "result_id" => $resultId,
                        "hash_tag" => $hashTag,
                        "score" => $score
                    ];

                    MysqlHelper::insertData($this->mysqli, 
                        CrimsonHexagonConfig::tables["twittermetric_top_hash_tag"], $topHashTagData);
                }

                foreach($dailyResult["topRetweets"] as $topRetweet)
                {
                    $topRetweetData = [
                        "result_id" => $resultId,
                        "url" => $topRetweet["url"],
                        "is_original" => $topRetweet["isOriginal"],
                        "retweet_count" => $topRetweet["retweetCount"],
                    ];

                    MysqlHelper::insertData($this->mysqli, 
                        CrimsonHexagonConfig::tables["twittermetric_top_retweet"], $topHashTagData);
                }
            }
        }
    }

    /**
     * insert api result data if the data is not in the mysql table
     *
     * @param string $table
     * @param array $result
     * @param Datetime $date
     * @param int $hour
     * @return boolean
     */
    protected function insertIfNotExists($table, array $result, Datetime $date, $hour){
        if(!$isDataExists = $this->isDataExist($table, $date, $hour))
        {
            MysqlHelper::insertData($this->mysqli, $table, $result);            
        }

        return $isDataExists;
    }

    /**
     * checking is data already exists in the database by using
     * 'date'(current date) and 'data_date'(the hour of date that insert the data)
     *
     * @param string $table
     * @param Datetime $date
     * @param int $hour
     * @return boolean
     */
    protected function isDataExist($table, Datetime $date, $hour)
    {
        // checking if the date of hour of data has already been set
        $query = "SELECT null FROM " . CrimsonHexagonConfig::tables['sentiment'] . 
            " WHERE date(date) = date(?) AND hour = ?";
        $stmt = $this->mysqli->prepare($query);
        $thatDate = $date->format("Y-m-d");
        $stmt->bind_param("si", $thatDate, $hour);
        $stmt->execute();
        $result = $stmt->get_result();

        return (bool) $result->num_rows;
    }

    /**
     * check the api result key is exist.
     * this function is use for make sure the api result doesn't go too wrong
     *
     * @param array $apiResult
     * @param string $key
     * @return void
     */
    protected function checkApiResultKey(array $apiResult, $key)
    {
        if(!isset($apiResult[$key]))
        {
            throw new RuntimeException("Api result missing $key key: " . json_encode($apiResult));
        }
    }

    /**
     * create an endpointUrl from config url
     *
     * @param string $endpointUrl
     * @param mixed[] ...$params for sprintf variable, will apply those variable to $endpointUrl
     * @return string
     */
    protected function createEndpointUrl($endpointUrl, ... $params)
    {
        if(!$endpointUrl)
        {
            throw new InvalidArgumentException("end point url cannot be empty");
        }

        return sprintf($endpointUrl, ... $params);
    }

    /**
     * if there is no record, it will use config FETCH_DATE_WHEN_DATA_EMPTY setting
     * when start is null date is determent by the database last record or 
     * when end is null, end will be today + 1 day
     *
     * @param string $endpointDbTable
     * @param Datetime $start
     * @param Datetime null
     * @return array
     */
    protected function getStatEndDate($endpointDbTable, Datetime $start = null, Datetime $end = null)
    {
        if(!$endpointDbTable)
        {
            throw new InvalidArgumentException("end point db table cannot be empty");
        }

        if(!$end)
        {
            $end = new Datetime(null, new DatetimeZone("utc"));
            $end->modify("+1 day");
        }

        if($start === null)
        {
            $result = $this->mysqli
                ->query("SELECT date(max(date)) as date FROM $endpointDbTable"
                    . " HAVING date IS NOT NULL");

            if($result->num_rows)
            {
                $start = new Datetime($result->fetch_array()[0], new DatetimeZone("utc"));
                if($start > $end)
                {
                    throw new RuntimeException("start time is larger then end time: {${$start->format("Y-m-d")}} to {${$end->format("Y-m-d")}}");
                }
            }
            else
            {
                $start = new Datetime;
                if(CrimsonHexagonConfig::FETCH_DATE_WHEN_DATA_EMPTY)
                {
                    $start->modify("-" . CrimsonHexagonConfig::FETCH_DATE_WHEN_DATA_EMPTY);
                }
            }
        }

        return [$start, $end];
    }

    /**
     * call crimson hexagon api endpoint and return the json result
     *
     * @param string $url
     * @return string $apiResult
     */
    protected function getApiResult($url)
    {
        $apiContent = file_get_contents($url);

        $apiResult = json_decode($apiContent, true);

        if(json_last_error())
        {
            throw new RuntimeException("error while decoding api result: " . json_last_error_msg());
        }
        elseif(!$apiResult)
        {
            throw new RuntimeException("api result is empty");
        }
        elseif(!isset($apiResult["status"]))
        {
            throw new RuntimeException("unable to check status field for api result " . json_encode($apiResult));
        }
        elseif($apiResult["status"] !== "success")
        {
           throw new RuntimeException("api result status is not success: {$apiResult["status"]}");
        }
        else
        {
            return $apiResult;
        }

    }

}