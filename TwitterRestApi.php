<?php

/**
 * Class TwitterRestApiException
 */
class TwitterRestApiException extends Exception {};

/**
 * @author   Albert Kozlowski <vojant@gmail.com>
 * @license  MIT License
 * @link     https://github.com/vojant/Twitter-php
 */
class TwitterRestApi
{
    /**
     * Url for Twitter api
     */
    const TWITTER_API_URL = 'https://api.twitter.com';

    /**
     * Twitter URL that authenticates bearer tokens
     */
    const TWITTER_API_AUTH_URL = 'https://api.twitter.com/oauth2/token/';

    /**
     * Version of Twitter api
     */
    const TWITTER_API_VERSION = '1.1';

    /**
     * Timeout value for curl connections
     */
    const TIMEOUT = 10;

    /**
     * @var string
     */
    private $_accessToken = null;

    /**
     * @var string
     */
    private $_consumerKey;

    /**
     * @var string
     */
    private $_consumerSecret;


    /**
     * @param $consumerKey
     * @param $consumerSecret
     * @throws TwitterRestApiException
     */
    public function __construct($consumerKey,$consumerSecret)
    {
        if (!function_exists('curl_init')) {
            throw new TwitterRestApiException('You must have the cURL extension enabled to use this library');
        }
        $this->_consumerKey = $consumerKey;
        $this->_consumerSecret = $consumerSecret;
    }

    /**
     * Call Twitter api
     *
     * @link https://dev.twitter.com/docs/api/1.1
     *
     * @param $resource
     * @param array $parameters
     * @return mixed
     */
    public function call($resource, array $parameters = null)
    {
        $headers = array(
            "Authorization: Bearer " . $this->_getAccessToken(),
            "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
        );

        $url = self::TWITTER_API_URL . '/' . self::TWITTER_API_VERSION . '/' . ltrim($resource,'/') . '.json';
        $url = $url . '?' . http_build_query($parameters);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
        $rawResponse = curl_exec($curl);
        curl_close($curl);

        return json_decode($rawResponse,true);
    }

    /**
     * Get Bearer token
     *
     * @link https://dev.twitter.com/docs/auth/application-only-auth
     *
     * @return null|string
     * @throws TwitterRestApiException
     */
    private function _getAccessToken() {
        if (!$this->_accessToken) {
            $token = urlencode($this->_consumerKey) . ':' . urlencode($this->_consumerSecret);
            $token = base64_encode($token);

            $headers = array(
                "Authorization: Basic " . $token,
                "Content-Type: application/x-www-form-urlencoded;charset=UTF-8",
            );

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, self::TWITTER_API_AUTH_URL);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, self::TIMEOUT);
            $rawResponse = curl_exec($curl);
            curl_close($curl);

            $response = json_decode($rawResponse, true);

            if (isset($response["token_type"]) && $response["token_type"] == 'bearer') {
                $this->_accessToken = $response["access_token"];
            } else {
                throw new TwitterRestApiException('Error while getting access token');
            }
        }
        return $this->_accessToken;
    }
}