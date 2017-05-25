<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends MY_Model{

    function get_sentiment_graph_data(Datetime $start = null, Datetime $end = null){
        $raw_data = <<<JSON
        {
        "results": [
            {
            "startDate": "2017-04-01T00:00:00",
            "endDate": "2017-04-02T00:00:00",
            "creationDate": "2017-05-23T09:32:08",
            "numberOfDocuments": 2281,
            "numberOfRelevantDocuments": 2281,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.14,
                "volume": 319,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.31,
                "volume": 715,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.55,
                "volume": 1247,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.03,
                "volume": 73,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.69,
                "volume": 1567,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.11,
                "volume": 240,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.14,
                "volume": 330,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 62,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 7,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-02T00:00:00",
            "endDate": "2017-04-03T00:00:00",
            "creationDate": "2017-05-23T09:32:07",
            "numberOfDocuments": 2171,
            "numberOfRelevantDocuments": 2171,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.14,
                "volume": 313,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.4,
                "volume": 860,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.46,
                "volume": 998,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 0,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 107,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.69,
                "volume": 1494,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.09,
                "volume": 190,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.14,
                "volume": 307,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 66,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 7,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-03T00:00:00",
            "endDate": "2017-04-04T00:00:00",
            "creationDate": "2017-05-23T09:32:06",
            "numberOfDocuments": 2181,
            "numberOfRelevantDocuments": 2181,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 368,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.31,
                "volume": 680,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.52,
                "volume": 1133,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 5,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 110,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.67,
                "volume": 1468,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.09,
                "volume": 206,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.14,
                "volume": 309,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 74,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 9,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-04T00:00:00",
            "endDate": "2017-04-05T00:00:00",
            "creationDate": "2017-05-23T09:32:04",
            "numberOfDocuments": 2058,
            "numberOfRelevantDocuments": 2058,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 356,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.32,
                "volume": 660,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.51,
                "volume": 1042,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.07,
                "volume": 137,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.62,
                "volume": 1277,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.12,
                "volume": 244,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.15,
                "volume": 307,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 68,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 23,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-05T00:00:00",
            "endDate": "2017-04-06T00:00:00",
            "creationDate": "2017-05-23T09:32:00",
            "numberOfDocuments": 2379,
            "numberOfRelevantDocuments": 2379,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.16,
                "volume": 389,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.35,
                "volume": 826,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.49,
                "volume": 1164,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 1,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 120,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.62,
                "volume": 1468,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.14,
                "volume": 339,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.15,
                "volume": 366,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 73,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 12,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-06T00:00:00",
            "endDate": "2017-04-07T00:00:00",
            "creationDate": "2017-05-23T09:31:47",
            "numberOfDocuments": 2262,
            "numberOfRelevantDocuments": 2262,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.2,
                "volume": 444,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.3,
                "volume": 673,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.51,
                "volume": 1145,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 4,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.04,
                "volume": 101,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.61,
                "volume": 1374,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.13,
                "volume": 289,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.18,
                "volume": 404,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 80,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 10,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-07T00:00:00",
            "endDate": "2017-04-08T00:00:00",
            "creationDate": "2017-05-23T09:31:45",
            "numberOfDocuments": 2138,
            "numberOfRelevantDocuments": 2138,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.16,
                "volume": 345,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.32,
                "volume": 689,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.52,
                "volume": 1104,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 104,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.63,
                "volume": 1346,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 224,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.18,
                "volume": 386,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 66,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 10,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-08T00:00:00",
            "endDate": "2017-04-09T00:00:00",
            "creationDate": "2017-05-23T09:31:45",
            "numberOfDocuments": 1684,
            "numberOfRelevantDocuments": 1684,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.13,
                "volume": 221,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 558,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.54,
                "volume": 905,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 0,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 76,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.64,
                "volume": 1075,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 167,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.18,
                "volume": 305,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 47,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 14,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-09T00:00:00",
            "endDate": "2017-04-10T00:00:00",
            "creationDate": "2017-05-23T09:31:45",
            "numberOfDocuments": 1760,
            "numberOfRelevantDocuments": 1760,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.13,
                "volume": 220,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.3,
                "volume": 534,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.57,
                "volume": 1006,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 0,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 89,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.61,
                "volume": 1068,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 179,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.2,
                "volume": 359,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 52,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 13,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-10T00:00:00",
            "endDate": "2017-04-11T00:00:00",
            "creationDate": "2017-05-23T09:31:43",
            "numberOfDocuments": 2044,
            "numberOfRelevantDocuments": 2044,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 346,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.34,
                "volume": 702,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.49,
                "volume": 996,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 4,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 112,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.58,
                "volume": 1189,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 209,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.21,
                "volume": 421,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.05,
                "volume": 98,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 11,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-11T00:00:00",
            "endDate": "2017-04-12T00:00:00",
            "creationDate": "2017-05-23T09:31:40",
            "numberOfDocuments": 2323,
            "numberOfRelevantDocuments": 2323,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.18,
                "volume": 424,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.35,
                "volume": 804,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.47,
                "volume": 1095,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 1,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 116,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.63,
                "volume": 1460,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.13,
                "volume": 303,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.15,
                "volume": 354,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 79,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 10,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-12T00:00:00",
            "endDate": "2017-04-13T00:00:00",
            "creationDate": "2017-05-23T09:31:38",
            "numberOfDocuments": 2365,
            "numberOfRelevantDocuments": 2365,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 406,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 772,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.5,
                "volume": 1187,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.04,
                "volume": 97,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.66,
                "volume": 1556,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.12,
                "volume": 281,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.14,
                "volume": 340,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 76,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 13,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-13T00:00:00",
            "endDate": "2017-04-14T00:00:00",
            "creationDate": "2017-05-23T09:31:37",
            "numberOfDocuments": 2143,
            "numberOfRelevantDocuments": 2143,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.16,
                "volume": 333,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 701,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.52,
                "volume": 1109,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 1,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.04,
                "volume": 93,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.6,
                "volume": 1282,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.13,
                "volume": 268,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.19,
                "volume": 412,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 77,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 10,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-14T00:00:00",
            "endDate": "2017-04-15T00:00:00",
            "creationDate": "2017-05-23T09:31:35",
            "numberOfDocuments": 1988,
            "numberOfRelevantDocuments": 1988,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.16,
                "volume": 322,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 657,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.51,
                "volume": 1009,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 3,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 95,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.64,
                "volume": 1275,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 205,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.17,
                "volume": 346,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 57,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 7,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-15T00:00:00",
            "endDate": "2017-04-16T00:00:00",
            "creationDate": "2017-05-23T09:31:35",
            "numberOfDocuments": 2308,
            "numberOfRelevantDocuments": 2308,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.1,
                "volume": 231,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.37,
                "volume": 856,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.53,
                "volume": 1221,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.03,
                "volume": 65,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.61,
                "volume": 1416,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.18,
                "volume": 417,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.12,
                "volume": 283,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.05,
                "volume": 111,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 14,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-16T00:00:00",
            "endDate": "2017-04-17T00:00:00",
            "creationDate": "2017-05-23T09:31:35",
            "numberOfDocuments": 1706,
            "numberOfRelevantDocuments": 1706,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.15,
                "volume": 249,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 571,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.52,
                "volume": 886,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 0,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 81,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.62,
                "volume": 1058,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.12,
                "volume": 208,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.18,
                "volume": 300,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 50,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 9,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-17T00:00:00",
            "endDate": "2017-04-18T00:00:00",
            "creationDate": "2017-05-23T09:31:35",
            "numberOfDocuments": 2157,
            "numberOfRelevantDocuments": 2157,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.19,
                "volume": 402,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.3,
                "volume": 646,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.51,
                "volume": 1109,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 3,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 98,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.61,
                "volume": 1318,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.12,
                "volume": 260,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.17,
                "volume": 377,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 94,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 7,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-18T00:00:00",
            "endDate": "2017-04-19T00:00:00",
            "creationDate": "2017-05-23T09:31:35",
            "numberOfDocuments": 2621,
            "numberOfRelevantDocuments": 2621,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.19,
                "volume": 493,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.31,
                "volume": 816,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.5,
                "volume": 1312,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 4,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 136,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.62,
                "volume": 1637,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.12,
                "volume": 310,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.17,
                "volume": 440,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 83,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 11,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-19T00:00:00",
            "endDate": "2017-04-20T00:00:00",
            "creationDate": "2017-05-23T09:31:35",
            "numberOfDocuments": 2736,
            "numberOfRelevantDocuments": 2736,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.19,
                "volume": 510,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.27,
                "volume": 749,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.54,
                "volume": 1477,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 124,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.65,
                "volume": 1765,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.11,
                "volume": 313,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.15,
                "volume": 413,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 109,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 10,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-20T00:00:00",
            "endDate": "2017-04-21T00:00:00",
            "creationDate": "2017-05-23T09:32:12",
            "numberOfDocuments": 2410,
            "numberOfRelevantDocuments": 2410,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 419,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.28,
                "volume": 683,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.54,
                "volume": 1308,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 122,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.64,
                "volume": 1539,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.11,
                "volume": 275,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.15,
                "volume": 365,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 85,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 22,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-21T00:00:00",
            "endDate": "2017-04-22T00:00:00",
            "creationDate": "2017-05-23T09:32:12",
            "numberOfDocuments": 3213,
            "numberOfRelevantDocuments": 3213,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.15,
                "volume": 487,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.31,
                "volume": 1006,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.54,
                "volume": 1720,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 5,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 159,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.62,
                "volume": 1987,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.11,
                "volume": 354,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.17,
                "volume": 541,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.05,
                "volume": 146,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 21,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-22T00:00:00",
            "endDate": "2017-04-23T00:00:00",
            "creationDate": "2017-05-23T09:32:10",
            "numberOfDocuments": 2282,
            "numberOfRelevantDocuments": 2282,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.14,
                "volume": 330,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 742,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.53,
                "volume": 1210,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 1,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 103,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.57,
                "volume": 1308,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 229,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.23,
                "volume": 536,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 93,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 12,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-23T00:00:00",
            "endDate": "2017-04-24T00:00:00",
            "creationDate": "2017-05-23T09:32:09",
            "numberOfDocuments": 1989,
            "numberOfRelevantDocuments": 1989,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 332,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.28,
                "volume": 566,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.55,
                "volume": 1091,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.04,
                "volume": 79,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.62,
                "volume": 1225,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 190,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.17,
                "volume": 347,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.07,
                "volume": 131,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 15,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-24T00:00:00",
            "endDate": "2017-04-25T00:00:00",
            "creationDate": "2017-05-23T09:32:06",
            "numberOfDocuments": 2125,
            "numberOfRelevantDocuments": 2125,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 364,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.3,
                "volume": 634,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.53,
                "volume": 1127,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 1,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.06,
                "volume": 119,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.56,
                "volume": 1189,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.17,
                "volume": 356,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.17,
                "volume": 355,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 88,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 17,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-25T00:00:00",
            "endDate": "2017-04-26T00:00:00",
            "creationDate": "2017-05-23T09:31:48",
            "numberOfDocuments": 2269,
            "numberOfRelevantDocuments": 2269,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.16,
                "volume": 362,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.32,
                "volume": 736,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.52,
                "volume": 1171,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 2,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.07,
                "volume": 157,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.58,
                "volume": 1312,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.13,
                "volume": 297,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.18,
                "volume": 409,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 71,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 21,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-26T00:00:00",
            "endDate": "2017-04-27T00:00:00",
            "creationDate": "2017-05-23T09:31:48",
            "numberOfDocuments": 2324,
            "numberOfRelevantDocuments": 2324,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.16,
                "volume": 381,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.34,
                "volume": 781,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.5,
                "volume": 1162,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 4,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.06,
                "volume": 133,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.59,
                "volume": 1379,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.1,
                "volume": 244,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.2,
                "volume": 474,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.03,
                "volume": 81,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 9,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-27T00:00:00",
            "endDate": "2017-04-28T00:00:00",
            "creationDate": "2017-05-23T09:31:48",
            "numberOfDocuments": 2115,
            "numberOfRelevantDocuments": 2115,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.17,
                "volume": 363,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.33,
                "volume": 699,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.5,
                "volume": 1053,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 3,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.06,
                "volume": 117,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.6,
                "volume": 1266,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.11,
                "volume": 235,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.19,
                "volume": 408,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.04,
                "volume": 79,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 7,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-28T00:00:00",
            "endDate": "2017-04-29T00:00:00",
            "creationDate": "2017-05-23T09:31:48",
            "numberOfDocuments": 2145,
            "numberOfRelevantDocuments": 2145,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.22,
                "volume": 473,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.34,
                "volume": 728,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.44,
                "volume": 944,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 1,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.04,
                "volume": 93,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.57,
                "volume": 1220,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.12,
                "volume": 247,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.18,
                "volume": 394,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.08,
                "volume": 176,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0.01,
                "volume": 14,
                "hidden": false
                }
            ]
            },
            {
            "startDate": "2017-04-29T00:00:00",
            "endDate": "2017-04-30T00:00:00",
            "creationDate": "2017-05-23T09:31:48",
            "numberOfDocuments": 1751,
            "numberOfRelevantDocuments": 1751,
            "categories": [
                {
                "categoryId": 6152118353,
                "category": "Basic Negative",
                "proportion": 0.23,
                "volume": 405,
                "hidden": false
                },
                {
                "categoryId": 6152118348,
                "category": "Basic Positive",
                "proportion": 0.34,
                "volume": 587,
                "hidden": false
                },
                {
                "categoryId": 6152118351,
                "category": "Basic Neutral",
                "proportion": 0.43,
                "volume": 759,
                "hidden": false
                }
            ],
            "emotions": [
                {
                "categoryId": 6152118352,
                "category": "Surprise",
                "proportion": 0,
                "volume": 0,
                "hidden": false
                },
                {
                "categoryId": 6152118354,
                "category": "Anger",
                "proportion": 0.05,
                "volume": 79,
                "hidden": false
                },
                {
                "categoryId": 6152118345,
                "category": "Neutral",
                "proportion": 0.55,
                "volume": 962,
                "hidden": false
                },
                {
                "categoryId": 6152118346,
                "category": "Disgust",
                "proportion": 0.13,
                "volume": 229,
                "hidden": false
                },
                {
                "categoryId": 6152118347,
                "category": "Joy",
                "proportion": 0.2,
                "volume": 351,
                "hidden": false
                },
                {
                "categoryId": 6152118349,
                "category": "Sadness",
                "proportion": 0.07,
                "volume": 123,
                "hidden": false
                },
                {
                "categoryId": 6152118350,
                "category": "Fear",
                "proportion": 0,
                "volume": 7,
                "hidden": false
                }
            ]
            }
        ],
        "status": "success"
        }
JSON;

        $json = json_decode($raw_data, true);

        $collection = [];

        foreach($json["results"] as $_data){
            $data = [
                "date" => (new Datetime($_data["startDate"]))->format("Y-m-d"),
                "number_documents" => $_data["numberOfRelevantDocuments"],
                "categories_negative_volume" => $_data["categories"][0]["volume"],
                "categories_positive_volume" => $_data["categories"][1]["volume"],
                "categories_neutral_volume" => $_data["categories"][2]["volume"],
            ];

            $collection[] = $data;
        }

        return $collection;
    }
}