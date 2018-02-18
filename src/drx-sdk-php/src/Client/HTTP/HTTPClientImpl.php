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
     * @return HTTPFileResponse
     */
    public function download($url, $filePath, $params = [], $options = [])
    {
        set_time_limit(0); // unlimited max execution time
        $file = fopen($filePath, "w+");
        $options = array(
            CURLOPT_FILE    => $file,
            CURLOPT_TIMEOUT =>  60,
            CURLOPT_URL     => $url,
            CURLOPT_BINARYTRANSFER => TRUE,
            CURLOPT_FOLLOWLOCATION => TRUE
        );

        $ch = curl_init();
        curl_setopt_array($ch, $options);
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
        // TODO: Implement post() method.
    }
}