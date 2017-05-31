<?php
/**
 * Api config for api fetching
 */
interface CrimsonHexagonConfig
{
    const API_URL = "https://api.crimsonhexagon.com/api/",

        AUTH = 'rsvn1w-CJ9zZwoowZ1PpznrCJFS9vbDeD1oY7CiouJs',

        //settings
        // when data is empty, fetch x before today
        // set null to disable it
        FETCH_DATE_WHEN_DATA_EMPTY = "180 day",

        //params: unsigned int id, string start_date, string end_date
        // use sprintf to repalce those value
        ENDPOINT_QUERY_STRING_START = "?auth=" . self::AUTH . "&id=%u&start=%s&end=%s",

        endpoints = [
            'sentiment' => self::API_URL . "monitor/results" . self::ENDPOINT_QUERY_STRING_START ,
            'volume' => self::API_URL . "monitor/dayandtime" . self::ENDPOINT_QUERY_STRING_START . "&aggregatebyday=false&uselocaltime=false",
            'sources' => self::API_URL . "monitor/sources" . self::ENDPOINT_QUERY_STRING_START,
            'interestaffinities' => self::API_URL . "monitor/interestaffinities" . self::ENDPOINT_QUERY_STRING_START . "&daily=true",
            'wordcloud' => self::API_URL . "monitor/wordcloud" . self::ENDPOINT_QUERY_STRING_START,
 
            //twitter
            'authors' => self::API_URL . "monitor/authors" . self::ENDPOINT_QUERY_STRING_START,
            'twittermetrics' => self::API_URL . "monitor/twittermetrics" . self::ENDPOINT_QUERY_STRING_START
        ],
        
        tables = [
            'sentiment' => 'ch_sentiment',

            'volume' => 'ch_volume',

            'sources' => 'ch_sources',
            'source_top_site' => "ch_source_top_site",
            'source_source' => 'ch_source_source',
        
            'interestaffinitie' => 'ch_interestaffinitie',
            'interestaffinitie_info' => 'ch_interestaffinitie_info',

            'wordcloud' => 'ch_wordcloud',
            'wordcloud_word' => 'ch_wordcloud_word',

            //twitter
            'author' => 'ch_author',
            'author_detail' => 'ch_author_detail',

            'twittermetric' => 'ch_twittermetric',
            'twittermetric_top_hash_tag' => 'ch_twittermetric_top_hash_tag',
            'twittermetric_top_retweet' => 'ch_twittermetric_top_retweet'
        ];
}
