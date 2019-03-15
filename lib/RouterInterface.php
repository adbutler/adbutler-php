<?php

namespace AdButler;

interface RouterInterface
{
    /**
     * Initialize the router based on a provided configuration.
     *
     * @param array $config
     * @return mixed
     */
    public static function init($config = []);

    /**
     * Perform a request for data based on the parameters provided.
     *
     * @param $method
     * @param $uri
     * @param $bodyParams
     * @param $queryParams
     * @return mixed
     */
    public static function request($method, $uri, $bodyParams, $queryParams);

    /**
     * Retrieve the API version being used.
     *
     * @return mixed
     */
    public static function getVersion();
}
