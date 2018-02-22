<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 17:33
 */

namespace Dreceiptx\Client;


interface HTTPClient
{
    /**
     * @param string $url
     * @param string[] $params
     * @param string[] $options
     * @return HTTPResponse
     */
    public function get($url, $params = array(), $options =  array());

    /**
     * @param string $url
     * @param string $folderPath
     * @param string[] $params
     * @param string[] $options
     * @return HTTPFileResponse
     */
    public function download($url, $folderPath, $params =  array(), $options =  array());

    /**
     * @param string $url
     * @param string $body
     * @param string[] $headers
     * @return HTTPResponse
     */
    public function post($url, $body = null, $headers =  array());
}