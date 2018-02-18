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
require_once __DIR__."/HTTPFileResponse.php";

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
        $curlOptions = array(
            CURLOPT_RETURNTRANSFER => true
        );
        $ch = curl_init($parametrizedUrl);
        curl_setopt_array($ch, $curlOptions);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return new HTTPResponse($result, $info["http_code"], null);

    }

    /**
     * @param string $url
     * @param string $folderPath
     * @param string[] $params
     * @param string[] $options
     * @return HTTPFileResponse
     */
    public function download($url, $filePath, $params = [], $options = [])
    {
        set_time_limit(0); // unlimited max execution time
        $file = fopen($filePath, "w+");
        $curlOptions = array(
            CURLOPT_FILE    => $file,
            CURLOPT_TIMEOUT =>  60,
            CURLOPT_BINARYTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE
        );

        $ch = curl_init($url);
        curl_setopt_array($ch, $curlOptions);
        curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        fclose($file);
    }

    /**
     * @param string $url
     * @param string $body
     * @param string[] $options
     * @return HTTPResponse
     */
    public function post($url, $body = null, $options = [])
    {
        $curlOptions = array(
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_TIMEOUT =>  60,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'),
            CURLOPT_TIMEOUT => 5,
        CURLOPT_CONNECTTIMEOUT => 5
    );
        $ch = curl_init($url);
        curl_setopt_array($ch, $curlOptions);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return new HTTPResponse($result, $info["http_code"], null);
    }
}