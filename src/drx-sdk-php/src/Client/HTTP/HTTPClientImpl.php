<?php
/**
 * Created by PhpStorm.
 * User: lajtha
 * Date: 2018-02-17
 * Time: 21:40
 */

namespace Dreceiptx\Client;

require_once __DIR__."/HTTPClient.php";
require_once __DIR__."/HTTPResponse.php";

class HTTPClientImpl implements HTTPClient
{

    /**
     * @param string $url
     * @param string[] $params
     * @param string[] $options
     * @return HTTPResponse
     */
    public function get($url, $params = [], $options = [])
    {
        $paramString = "";
        $first = true;
        foreach ($params as $key=>$value){
            if ($first) {
                $paramString = "?";
                $first = false;
            } else {
                $paramString = $paramString."&";
            }
            $paramString = $paramString.$key."=".urlencode($value);
        }
        $parametrizedUrl = $url.$paramString;
        $ch = curl_init($parametrizedUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
//        print("\n");
//        print_r($info);
//        print("\n");
        curl_close($ch);
        return new HTTPResponse($result, $info["http_code"], null);

    }

    /**
     * @param string $url
     * @param string $folderPath
     * @param string[] $params
     * @param string[] $options
     * @return HTTPResponse
     */
    public function download($url, $folderPath, $params = [], $options = [])
    {
        // TODO: Implement download() method.
    }

    /**
     * @param string $url
     * @param string $body
     * @param string[] $options
     * @return HTTPResponse
     */
    public function post($url, $body = null, $options = [])
    {
        // TODO: Implement post() method.
    }

    /**
     * @param string $url
     * @param string $body
     * @param string[] $options
     * @return HTTPResponse
     */
    public function put($url, $body = null, $options = [])
    {
        // TODO: Implement put() method.
    }

    /**
     * @param string $url
     * @param string[] $options
     * @return HTTPResponse
     */
    public function delete($url, $options = [])
    {
        // TODO: Implement delete() method.
    }
}