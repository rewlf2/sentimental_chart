<?php
interface CrimsonHexagonConfig{
    const API_URL = "https://api.crimsonhexagon.com/api/",

        AUTH = 'rsvn1w-CJ9zZwoowZ1PpznrCJFS9vbDeD1oY7CiouJs',

        //settings
        // when data is empty, fetch x before today
        // set null to disable it
        FETCH_DATE_WHEN_DATA_EMPTY = "180 day",

        //endpoints
        // params: unsigned int id, string start_date, string end_date
        sentiment_endpoint = self::API_URL . "monitor/results?auth=" . self::AUTH . "&id=%u&start=%s&end=%s",
        // params: unsigned int id, string start_date, string end_date
        volume_endpoint = self::API_URL . "monitor/dayandtime?auth=" . self::AUTH . "&id=%u&start=%s&end=%s&aggregatebyday=false&uselocaltime=false";

}
