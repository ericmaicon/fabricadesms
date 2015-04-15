<?php

use \helpers\CurlHelper;
use \helpers\MessageHelper;

/**
 * Class Sms
 *
 * @class Sms
 * @version <1.0.0>
 * @date 14/04/2015
 * @author Eric Maicon
 * @license
 * @since 1.0
 */
class Sms {

    const URL = "http://www.fabricadesms.com.br/sms/app/modulo/api/index.php";

    private $config;

    /**
     * Constructor to collect the config array
     *
     * @throws Exception
     */
    function __construct()
    {
        $arguments = func_num_args();

        if ($arguments != 1) {
            throw new Exception("Invalid arguments. Use config array");
        } else {
            $this->config = func_get_arg(0);

            if(!array_key_exists('login', $this->config))
                throw new Exception("Invalid arguments. The config array is missing the 'login' key");

            if(!array_key_exists('password', $this->config))
                throw new Exception("Invalid arguments. The config array is missing the 'password' key");
        }
    }

    /**
     * This method send an unique SMS
     *
     * @param $number
     * @param $message
     */
    public function sendSms($number, $message)
    {
        $params = http_build_query(
            array(
                'action' => 'sendsms',
                'lng' => $this->config['login'],
                'pwd' => $this->config['password'],
                'msg' => MessageHelper::treatMessage($message),
                'numbers' => $number,
            )
        );

        var_dump(self::URL . '?' . $params);exit;

        return CurlHelper::send(self::URL . '?' . $params);
    }

    /**
     * This method send multiple SMS
     *
     * @param $numbers
     * @param $message
     */
    public function sendMultipleSms($numbers, $message)
    {
        if(is_array($numbers))
            $numbers = implode(",", $numbers);

        $params = http_build_query(
            array(
                'action' => 'sendsms',
                'lng' => $this->config['login'],
                'pwd' => $this->config['password'],
                'msg' => MessageHelper::treatMessage($message),
                'numbers' => $numbers,
            )
        );

        return CurlHelper::send(self::URL . '?' . $params);
    }

    /**
     * Schedule the API to send at a date and time
     *
     * @param $numbers
     * @param $message
     * @param $date
     * @param $time
     */
    public function scheduleSms($numbers, $message, $date, $time)
    {
        if(is_array($numbers))
            $numbers = implode(",", $numbers);

        $params = http_build_query(
            array(
                'action' => 'sendsms',
                'lng' => $this->config['login'],
                'pwd' => $this->config['password'],
                'jobdate' => $date,
                'jobtime' => $time,
                'msg' => MessageHelper::treatMessage($message),
                'numbers' => $numbers,
            )
        );

        return CurlHelper::send(self::URL . '?' . $params);
    }

    /**
     * This method returns the balance
     */
    public function getBalance()
    {
        $params = http_build_query(
            array(
                'action' => 'getbalance',
                'lng' => $this->config['login'],
                'pwd' => $this->config['password'],
            )
        );

        return CurlHelper::send(self::URL . '?' . $params);
    }
}