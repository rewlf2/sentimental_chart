<?php

class CrimsonHexagonApiFetching{
    protected $id, $mysqli;
    
    function __construct($id, mysqli $mysqli){
        if($id < 0) throw new RuntimeException("id should not be negative: $id");

        $this->id = $id;
        $this->mysqli = $mysqli;
    }

    function fetchSentiment(Datetime $start = null, Datetime $end = null){
        $result = $this->mysqli->query("SELECT date(max(date)) as date FROM " . MysqlConfig::SENTIMENT_TABLE . " HAVING date IS NOT NULL");
        if($start === null && $result->num_rows){
            $start = new Datetime($result->fetch_array()[0], new DatetimeZone("utc"));
        }else{
            $start = new Datetime;
            if(CrimsonHexagonConfig::FETCH_DATE_WHEN_DATA_EMPTY)
                $start->modify("-" . CrimsonHexagonConfig::FETCH_DATE_WHEN_DATA_EMPTY);
        }
        $end = new Datetime(null, new DatetimeZone("utc"));
        $end->modify("+1 day");

        $url = sprintf(CrimsonHexagonConfig::sentiment_endpoint, $this->id, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $api_result = $this->getApiResult($url);
        if(!isset($api_result["results"]))
            throw new RuntimeException("Api result missing results key: " . json_encode($api_result));
        
        foreach($api_result["results"] as $result){
            $sentiment_data = [
                "monitor_id" => $this->id,

                "date" => (new Datetime($result["startDate"]))->format("Y-m-d H:i:s"),
                "hour" => (new Datetime($result["creationDate"]))->format("H"),
                
                "number_of_documents" => $result["numberOfDocuments"],
                "number_of_relevant_documents" => $result["numberOfRelevantDocuments"],

                "category_negative_proportion" => $result["categories"][0]["proportion"],
                "category_negative_volume" => $result["categories"][0]["volume"],
                "category_negative_hidden" => $result["categories"][0]["hidden"],

                "category_positive_proportion" => $result["categories"][2]["proportion"],
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

            // check is the date of hour of data is already set
            $query = "SELECT null FROM " . MysqlConfig::SENTIMENT_TABLE . " WHERE date(date) = date(?) AND hour = ?";
            $stmt = $this->mysqli->prepare($query);
            $stmt->bind_param("si", $sentiment_data["date"], $sentiment_data["hour"]);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows === 0)
                MysqlHelper::insertData(MysqlConfig::SENTIMENT_TABLE, $sentiment_data, $this->mysqli);
        }
    }

    function fetchVolume(Datetime $start = null, Datetime $end = null){
        $result = $this->mysqli->query("SELECT date(max(date)) as date FROM " . MysqlConfig::VOLUME_TABLE . " HAVING date IS NOT NULL");
        if($start === null && $result->num_rows){
            $start = new Datetime($result->fetch_array()[0], new DatetimeZone("utc"));
        }else{
            $start = new Datetime(null, new DatetimeZone("utc"));
            if(CrimsonHexagonConfig::FETCH_DATE_WHEN_DATA_EMPTY)
                $start->modify("-" . CrimsonHexagonConfig::FETCH_DATE_WHEN_DATA_EMPTY);
        }
        $end = new Datetime(null, new DatetimeZone("utc"));
        $end->modify("+1 day");

        if($start > $end)
            throw new RuntimeException("start time is larger then end time: {${$start->format("Y-m-d")}} to {${$end->format("Y-m-d")}}");

        $url = sprintf(CrimsonHexagonConfig::volume_endpoint, $this->id, $start->format("Y-m-d"), $end->format("Y-m-d"));
        $api_result = $this->getApiResult($url);
        if(!isset($api_result["volumes"]))
            throw new RuntimeException("Api result missing volumes key: " . json_encode($api_result));

        $now = new Datetime(null, new DatetimeZone("utc"));

        foreach($api_result["volumes"] as $volume){
            $volume_data = [
                "monitor_id" => $this->id,
                "date" => (new Datetime($volume["startDate"]))->format("Y-m-d"),
                "number_of_documents" => $volume["numberOfDocuments"]
            ];

            foreach($volume["volume"] as $hour => $volume_value){
                // only getting data that is before now()
                if($volume_data["date"] === $now->format("Y-m-d")
                  && $hour >= (int)$now->format("H")) 
                    continue;

                // copy the data that will not changes on each hour
                $each_volume_data = $volume_data;
                $each_volume_data["hour"] = $hour;
                $each_volume_data["volume"] = $volume_value;

                // check is data already set
                $query = "SELECT null FROM " . MysqlConfig::VOLUME_TABLE . " WHERE date(date) = date(?) AND hour = ? LIMIT 1";
                $stmt = $this->mysqli->prepare($query);
                $stmt->bind_param("si", $volume_data["date"], $hour);
                $stmt->execute();
                $result = $stmt->get_result();
                // if data not exists, insert it
                if($result->num_rows === 0){
                    MysqlHelper::insertData(MysqlConfig::VOLUME_TABLE, $each_volume_data, $this->mysqli);            
                }
            }
        }

    }


    protected function getApiResult($url){
        $api_content = file_get_contents($url);

        $api_result = json_decode($api_content, true);
        if(json_last_error())
            throw new RuntimeException("error while decoding api result: " . json_last_error_msg());
        elseif(!$api_result)
            throw new RuntimeException("api result is empty");
        elseif(!isset($api_result["status"]))
            throw new RuntimeException("unable to check status field for api result " . json_encode($api_result));
        elseif($api_result["status"] !== "success")
           throw new RuntimeException("api result status is not success: {$api_result["status"]}");
        else
            return $api_result;
    }

}