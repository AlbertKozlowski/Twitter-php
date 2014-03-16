Twitter-PHP
============================
The MIT License (MIT)  
Copyright (c) 2013 [Albert Kozłowski](https://twitter.com/albertkoz)

1. About
------------

Twitter-PHP is a simple PHP wrapper for Twitter 1.1 REST API.  
It supports [application-only authentication](https://dev.twitter.com/docs/auth/application-only-auth)
 and [single-user OAuth](https://dev.twitter.com/docs/auth/oauth/single-user-with-examples).

To get started just **create application** on [Twitter developer site](https://dev.twitter.com/apps/)
and follow instruction below.

  It's really **simple**, take a look:

    $twitter = new \TwitterPhp\RestApi($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
    $connectionUser = $twitter->connectAsUser();
    $connectionUser->post('statuses/update',array('status' => 'Hello World!'));

1. Installation
------------

- Include RestApi.php  in your application   

        require_once 'Twitter-php/RestApi.php';

- Or install via composer

         {
          "require": {
            "vojant/twitter-php": "dev-master"
          }
         }


2. Usage
------------

    <?php

    require_once 'Twitter-php/RestApi.php';

    $consumerKey = 'YOUR CONSUMER KEY';
    $consumerSecret = 'YOUR CONSUMER SECRET';
    $accessToken = 'YOUR ACCESS TOKEN';
    $accessTokenSecret = 'YOUR ACCESS TOKEN SECRET';

    $twitter = new \TwitterPhp\RestApi($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);


#### Login as application

    $connection = $twitter->connectAsApplication();

#### Call API

    $data = $connection->get(RESOURCE,PARAMETERS)

#### Login as user

    $connectionUser = $twitter->connectAsUser();

#### Call API / GET and POST

    $data = $connection->get(RESOURCE,PARAMETERS);
    $data = $connection->post(RESOURCE,PARAMETERS)

3. Examples
------------

    <?php
    
    include 'RestApi.php';
    
    /*
     * Config
     */
    $consumerKey = 'YOUR CONSUMER KEY';
    $consumerSecret = 'YOUR CONSUMER SECRET';
    $accessToken = 'YOUR ACCESS TOKEN';
    $accessTokenSecret = 'YOUR ACCESS TOKEN SECRET';
    
    
    /*
     * Create new RestApi instance
     * Consumer key and Consumer secret are required
     * Access Token and Access Token secret are required to use api as a user
     */
    $twitter = new \TwitterPhp\RestApi($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
    
    /*
     * Connect as application
     * https://dev.twitter.com/docs/auth/application-only-auth
     */
    $connection = $twitter->connectAsApplication();
    
    /*
     * Collection of the most recent Tweets posted by the user indicated by the screen_name, without replies
     * https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
     */
    $data = $connection->get('/statuses/user_timeline',array('screen_name' => 'TechCrunch', 'exclude_replies' => 'true'));
    
    /*
     * Connect as User
     * Access Token and Access Token Secret are required!
     * https://dev.twitter.com/docs/auth/oauth/single-user-with-examples
     */
    $connectionUser = $twitter->connectAsUser();
    
    /*
     * Tweet hello world to your timeline
     * https://dev.twitter.com/docs/api/1.1/post/statuses/update
     */
    $connectionUser->post('statuses/update',array('status' => 'Hello World!'));
    
    /*
     * Collection of the 5 most recent Tweets and retweets posted by the authenticating user and the users they follow
     * https://dev.twitter.com/docs/api/1.1/get/statuses/home_timeline
     */
    $tweets = $connectionUser->get('statuses/home_timeline',array('limit' => 5));

4. Docs
------------

- [Twitter developer site](https://dev.twitter.com/apps/)
- [REST API v1.1 Resources](https://dev.twitter.com/docs/api/1.1)
- [REST API v1.1 Limits](https://dev.twitter.com/docs/rate-limiting/1.1/limits)
- [Application-only authentication](https://dev.twitter.com/docs/auth/application-only-auth)
- [Single-user OAuth](https://dev.twitter.com/docs/auth/oauth/single-user-with-examples)

5. License
------------

The MIT License (MIT)

Copyright (c) 2013 Albert Kozłowski

Permission is hereby granted, free of charge, to any person obtaining a copy of
this software and associated documentation files (the "Software"), to deal in
the Software without restriction, including without limitation the rights to
use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
the Software, and to permit persons to whom the Software is furnished to do so,
subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
