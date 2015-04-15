<?php

namespace helpers;

/**
 * Auxiliary class related to curl functions
 *
 * @class CurlHelper
 * @version <1.0.0>
 * @date 14/04/2015
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class CurlHelper {

    /**
     * Method that sends the content to an URL by cURL.
     *
     * @param $url
     * @param $content
     * @param string $contentType
     * @return mixed|string
     */
    public static function send($url, $content = "", $contentType = "text/html") {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);

        //disabling cache
        curl_setopt($ch, CURLOPT_FRESH_CONNECT, true);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: ' . $contentType . '; charset=utf-8', 'Content-Length: '.strlen($content)));
        $result = curl_exec($ch);

        if(!$result)
            $result = curl_error($ch);

        curl_close($ch);

        return $result;
    }

}