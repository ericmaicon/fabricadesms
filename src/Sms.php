<?php

namespace fabricadesms;

use fabricadesms\helpers\CurlHelper;
use fabricadesms\helpers\MessageHelper;
use fabricadesms\exceptions\InvalidConfigurationException;

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
            throw new InvalidConfigurationException("Invalid arguments. Use config array");
        } else {
            $this->config = func_get_arg(0);

            if(!is_array($this->config))
                throw new InvalidConfigurationException("Invalid arguments. Use config array");

            if(!array_key_exists('login', $this->config))
                throw new InvalidConfigurationException("Invalid arguments. The config array is missing the 'login' key");

            if(!array_key_exists('password', $this->config))
                throw new InvalidConfigurationException("Invalid arguments. The config array is missing the 'password' key");
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
                'lgn' => $this->config['login'],
                'pwd' => $this->config['password'],
                'msg' => MessageHelper::treatMessage($message),
                'numbers' => $number,
            )
        );

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
                'lgn' => $this->config['login'],
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
                'lgn' => $this->config['login'],
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
                'lgn' => $this->config['login'],
                'pwd' => $this->config['password'],
            )
        );

        return CurlHelper::send(self::URL . '?' . $params);
    }

    /**
     * This method returns the campaign status
     *
     * @param $id
     * @return mixed|string
     */
    public function getCampaignStatus($id)
    {
        $params = http_build_query(
            array(
                'action' => 'GetCampanha',
                'lgn' => $this->config['login'],
                'pwd' => $this->config['password'],
                'idCamp' => $id
            )
        );

        return CurlHelper::send(self::URL . '?' . $params);
    }

    /**
     * This method returns the response status
     *
     * @param $initalDate
     * @param $finalDate
     * @return mixed|string
     */
    public function getStatus($initalDate, $finalDate)
    {
        $params = http_build_query(
            array(
                'action' => 'GetResposta',
                'lgn' => $this->config['login'],
                'pwd' => $this->config['password'],
                'dt_ini' => $initalDate,
                'dt_fim' => $finalDate,
            )
        );

        return CurlHelper::send(self::URL . '?' . $params);
    }
}