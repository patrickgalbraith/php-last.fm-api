PHP last.fm API Documentation
-----------------------------

Overview
--------

The PHP last.fm API allows you to call methods and get responses in the
form of objects. Responses can be cached on the filesystem or in a database.
See the documentation for detailed information.


Usage
-----
    
    //Initialization
    require_once APPPATH.'libraries/LastFM/lastfm.api.php';
    LastFM_Caller_CallerFactory::getDefaultCaller()->setApiKey(LASTFM_APIKEY);
    
    //Installing cache (optional)
    LastFM_Caller_CallerFactory::getDefaultCaller()->setCache(new LastFM_Cache_DiskCache('/path/to/cache'));
    
    //Using rate limiter (optional)
    LastFM_Caller_CallerFactory::getDefaultCaller()->setRateLimit(280);

    //Searching for artists with the name 'radiohead' with a limit of 5
    try {
        $artists = LastFM_Artist::search('radiohead', 5);
    } catch(LastFM_Error $e) {
        echo $e;
    }


Encoding
--------

You don't need to worry about encoding when calling API methods. Everything
will automatically be UTF-8 encoded when needed. All responses will also be
UTF-8 encoded.


Authentication
--------------

It's easy to fetch a session for a user account. This allows you to perform
actions on that account in a manner that is secure for last.fm users. All
write services require authentication.


Submissions
-----------

Scrobbling is not yet supported, but will be added soon. Although it doesn't
really make sense to scrobble from within a PHP script ;-)


More
----

For further information, please visit the official API documentation:
http://www.last.fm/api
