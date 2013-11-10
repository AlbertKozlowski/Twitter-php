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
