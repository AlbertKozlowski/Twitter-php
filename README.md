Twitter-PHP
============================
The MIT License (MIT)
Copyright (c) 2013 Albert Kozłowski

Simple PHP wrapper for Twitter 1.1 REST API.

**It ONLY supports application-only authentication.**


1. Twitter docs
------------

- [Twitter developer site](https://dev.twitter.com/apps/)
- [REST API v1.1 Resources](https://dev.twitter.com/docs/api/1.1)
- [REST API v1.1 Limits](https://dev.twitter.com/docs/rate-limiting/1.1/limits)
- [Application-only authentication](https://dev.twitter.com/docs/auth/application-only-auth)

2. Usage
------------

        <?php

        include('TwitterRestApi.php');

        $twitter = new TwitterRestApi(YOUR_CONSUMER_KEY,YOUR_CONSUMER_SECRET);
        $twitter->call(RESOURCE,PARAMS);


3. EXAMPLE
------------

        <?php

        include('TwitterRestApi.php');

        $twitter = new TwitterRestApi(YOUR_CONSUMER_KEY,YOUR_CONSUMER_SECRET);
        $response = $twitter->call('user_timeline',array('screen_name' => 'nasa'));
        var_dump($response);
