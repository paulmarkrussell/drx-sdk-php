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
    public function get($url, $params =  array(), $headers =  array())
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
            CURLOPT_URL => $parametrizedUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers
        );
        $ch = curl_init();
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
    public function download($url, $filePath, $params =  array(), $headers = array())
    {
        set_time_limit(0); // unlimited max execution time
        $file = fopen($filePath, "w+");
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_FILE    => $file,
            CURLOPT_TIMEOUT =>  60,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_BINARYTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE
        );

        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);
        curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        fclose($file);
    }

    /**
     * @param string $url
     * @param string $body
     * @param string[] $headers
     * @return HTTPResponse
     */
    public function post($url, $body = null, $headers = array())
    {
        $curlOptions = array(
            CURLOPT_URL => $url,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $body,
            CURLOPT_TIMEOUT =>  60,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 5,
        CURLOPT_CONNECTTIMEOUT => 5
    );
        $ch = curl_init();
        curl_setopt_array($ch, $curlOptions);
        $result = curl_exec($ch);
        $info = curl_getinfo($ch);
        curl_close($ch);
        return new HTTPResponse($result, $info["http_code"], null);
    }
}