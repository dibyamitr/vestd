# URL Shortener

URL Shortener is an api script to shorten the URL and also to view the number of times the original URL has been looked for from the short URL.

## API Key
**cd8b3804baa648d4fa3b8f9e6f4ef993**

## API Endpoints

*1. Creating the short URL*

```php

/***************************************************************
 * POST : https://www.example.com/api/v1/api-key/set-short-url *
 ***************************************************************/

// Request

{
    "url" : "the url to be shortened"
}

// Response
{
    "data" : "the short url",
    "status" : "status state",
    "msg" : "the required message"
}
```

*2. Running the short URL to return the main URL*

```php

/***************************************************************
 * POST : https://www.example.com/api/v1/api-key/call-full-url *
 ***************************************************************/

// Request

{
    "shortcode" : "only the shortcode of the short url"
}

// Response

{
    "data" : "the original url",
    "status" : "status state",
    "msg" : "the required message"
}

```

*3. Tracking the number of hits on the URL from the short URL*

```php

/******************************************************************
 * POST : https://www.example.com/api/v1/api-key/track-url-record *
 ******************************************************************/

// Request

{
    "shortcode" : "only the shortcode of the short url"
}

// Response

{
    "data" : {
                 "url" : "the original url",
                 "track_status" : "No. of times the url is looked for"
             },
    "status" : "status change",
    "msg" : "the required message"
}
```

## Installation
Please take a pull or download the source code. Put the folder as a standalone inside the required project. Next change the **hostname**, **username**, **databasename**, **password**, and the **base url** from the **config.json** file in the root. Also import the database file from the **NOTES** folder in the root.

## Tests
Please check the following tests:

1. Shorting of URL : *https://www.example.com*

2. Retrieving of URL : *by directly opening the short url*

3. Retrieve URL Tracking Status : *https://www.example.com/track-url*

## Video
Please check the two videos provided inside the **video** folder in the root.

1. Video for the API Endpoints

2. Video for the Test

## License
[The Unlicense](https://choosealicense.com/licenses/unlicense/)