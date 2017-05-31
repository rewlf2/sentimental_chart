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
        // TODO
        // $this->fetchAuthors($start, $end);
        // $this->fetchInterestaffinities($start, $end);
        $this->fetchSentiment($start, $end);
        // $this->fetchSources($start, $end);
        // $this->fetchTwittermetrics($start, $end);
        $this->fetchVolume($start, $end);
        // $this->fetchWordcloud($start, $end);
    }

    /**
     * fetch and store sentiment endpoint data
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    public function fetchSentiment(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["sentiment"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints['sentiment'],
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));

        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "results");
        
        foreach($apiResult["results"] as $result)
        {
            $sentimentData = [
                "monitor_id" => $this->monitorId,
                
                "creation_date" => (new Datetime($result["creationDate"]))->format("Y-m-d H:i:s"),

                "date" => (new Datetime($result["startDate"]))->format("Y-m-d H:i:s"),
                "hour" => $this->now->format("H"),
                
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

            if($this->isDataExistInTable(CrimsonHexagonConfig::tables['sentiment'], 
                $sentimentData["date"], $sentimentData["hour"]))
            {
                MysqlHelper::insertData(CrimsonHexagonConfig::tables['sentiment'], 
                    $sentimentData, $this->mysqli);
            }
        }
    }

    /**
     * fetch volume data from crimson hexagon, format api result data, store in database
     *
     * @param Datetime $start
     * @param Datetime $end
     * @return void
     */
    public function fetchVolume(Datetime $start = null, Datetime $end = null)
    {
        list($start, $end) = $this->getStatEndDate(CrimsonHexagonConfig::tables["volume"], $start, $end);

        $url = $this->createEndpointUrl(CrimsonHexagonConfig::endpoints['volume'], 
            $this->monitorId, $start->format("Y-m-d"), $end->format("Y-m-d"));

        $apiResult = $this->getApiResult($url);
        $this->checkApiResultKey($apiResult, "volumes");
     
        foreach($apiResult["volumes"] as $volume)
        {
            $volumeData = [
                "monitor_id" => $this->monitorId,
                "date" => (new Datetime($volume["startDate"]))->format("Y-m-d"),
                "number_of_documents" => $volume["numberOfDocuments"]
            ];

            foreach($volume["volume"] as $hour => $volume_value)
            {
                // only getting data that is before now()
                if($volumeData["date"] === $this->now->format("Y-m-d")
                  && $hour >= (int)$this->now->format("H"))
                {
                    continue;
                }

                // copy the data that will not change on each hour
                $eachVolumeData = $volumeData;
                $eachVolumeData["hour"] = $hour;
                $eachVolumeData["volume"] = $volume_value;

                // if data doesn't exist, insert it
                if($this->isDataExistInTable(CrimsonHexagonConfig::tables['volume'], $volumeData["date"], $hour))
                {
                    MysqlHelper::insertData(CrimsonHexagonConfig::tables['volume'], $eachVolumeData, $this->mysqli);            
                }
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

        // TODO
        throw new RuntimeException("TODO");

        foreach($apiResult["contentSources"] as $contentSource)
        {
            $source = [
                "monitor_id" => $this->monitorId,
                "date" => (new Datetime($contentSource["startDate"])),
                "hour" => $this->now->format("H")
            ];

            // TODO each parent query
            foreach($contentSource["topSites"] as $site => $score)
            {
                $eachSource = [
                    "id" => null,

                    "site" => $site,
                    "score" => $score
                ];
                // TODO each child
                // TODO handle child element, insert parent element then insert child, use parent id as reference.
                $query = "INSERT INTO xxx() VALUES();" .
                    "SELECT last_insert_id() as id;";
            }

            foreach($contentSource["sources"] as $sourceName => $score)
            {
                $scoresData = [
                    "id" => null,

                    "source_name" => $sourceName,
                    "score" => $score
                ];
                // TODO child
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

        // TODO
        throw new RuntimeException("TODO");

        foreach($apiResult["dailyResults"] as $dailyResult)
        {
            // parent
            $result = [
                "monitor_id" => $this->monitorId,
                "date" => (new Datetime($contentSource["startDate"])),
                "hour" => $this->now->format("H")
            ];

            // TODO parent insert query            
            foreach($dailyResult["info"] as $info)
            {
                $info_result = $result + [
                    "id_" => null,
                    
                    "id" => $info["id"],
                    "name" => $info["name"],
                    "relevancy_score" => $info["relevancyScore"],
                    "percent_in_monitor" => $info["percentInMonitor"],
                    "percent_on_twitter" => $info["percentOnTwitter"]
                ];
                //child

                // TODO handle child element, insert parent element then insert child, use parent id as reference.
                $query = "INSERT INTO xxx() VALUES();" .
                    "SELECT last_insert_id() as id;";
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
            $wordCloud = [
                "monitor_id" => $this->monitorId,
                "date" => (new Datetime($contentSource["startDate"])),
                "hour" => $this->now->format("H"),

                "hash_tag" => $hashTag,
                "score" => $score
            ];
            //TODO insert data
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
            $authorData = [
                "monitor_id" => $this->monitorId,
                "date" => (new Datetime($contentSource["startDate"])),
                "hour" => $this->now->format("H"),                
            ];

            // TODO parent
            foreach($author["authorDetails"] as $authorDetail)
            {
                $authorDetailData = [
                    "id" => null,
                    "kloutScore" => $authorDetail["kloutScore"],
                    "detailsDate" => $authorDetail["detailsDate"]
                ];
                // TODO insert child
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
            $resultData = [
                "monitor_id" => $this->monitorId,
                "date" => (new Datetime($contentSource["startDate"])),
                "hour" => $this->now->format("H"),              
            ];

            // TODO parent
            foreach($dailyResult["topHashtags"] as $hashTag => $score)
            {
                $topHashTagData = [
                    "id" => null,

                    "hash_tag" => $hashTag,
                    "score" => $score
                ];
                //TODO child
            }

            foreach($dailyResult["topRetweets"] as $topRetweet)
            {
                $topRetweetData = [
                    "id" => null,
                    
                    "url" => $topRetweet["url"],
                    "is_original" => $topRetweet["isOriginal"],
                    "retweet_count" => $topRetweet["retweetCount"],
                ];
                // TODO child 
            }
        }
    }

    /**
     * checking is data already exists in the database by using
     * 'date'(current date) and 'data_date'(the hour of date that insert the data)
     *
     * @param string $table
     * @param string $date Y-m-d formatted date string
     * @param int $hour
     * @return boolean
     */
    protected function isDataExistInTable($table, $date, $hour)
    {
        // checking if the date of hour of data has already been set
        $query = "SELECT null FROM " . CrimsonHexagonConfig::tables['sentiment'] . 
            " WHERE date(date) = date(?) AND hour = ?";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("si", $date, $hour);
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