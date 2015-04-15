<?php

use fabricadesms\Sms;

/**
 * Class SmsTest
 */
class SmsTest extends PHPUnit_Framework_TestCase
{

    /**
     * Testing if the user didn't send a config.
     */
    public function testConfigWithoutConfigFile()
    {
        try {
            new Sms();
        } catch(Exception $e) {
            $this->assertEquals($e->getMessage(), "Invalid arguments. Use config array");
        }
    }

    /**
     * Testing if the user didn't send an array
     */
    public function testNotConfigurationArray()
    {
        try {
            new Sms('something');
        } catch(Exception $e) {
            $this->assertEquals($e->getMessage(), "Invalid arguments. Use config array");
        }
    }

    /**
     * Testing if the config array is missing the login
     */
    public function testConfigWithoutLogin()
    {
        try {
            new Sms(
                array(
                )
            );
        } catch(Exception $e) {
            $this->assertEquals($e->getMessage(), "Invalid arguments. The config array is missing the 'login' key");
        }
    }

    /**
     * Testing if the config array is missing the login
     */
    public function testConfigWithoutPassword()
    {
        try {
            new Sms(
                array(
                    'login' => 'LOGIN'
                )
            );
        } catch(Exception $e) {
            $this->assertEquals($e->getMessage(), "Invalid arguments. The config array is missing the 'password' key");
        }
    }

    /**
     * Testing if the connection is working
     */
    public function testConfigSendSms()
    {
        $sms = new Sms(
            array(
                'login' => 'LOGIN',
                'password' => 'PASSWORD'
            )
        );
        $return = $sms->sendSms(6281818181, 'Some message');
        $this->assertEquals($return->status, 0);
    }
}