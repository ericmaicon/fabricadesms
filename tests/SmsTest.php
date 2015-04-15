<?php

use fabricadesms\Sms;

/**
 * Class SmsTest
 */
class SmsTest extends PHPUnit_Framework_TestCase
{

    public function testConfigWithoutLogin()
    {
        $sms = new Sms();
        $this->setExpectedException('Exception');
    }

    public function testConfigWithoutPassword()
    {
        $sms = new Sms(
            array(
                'login' => 'LOGIN'
            )
        );
        $this->setExpectedException('Exception');
    }

    public function testConfigSendSms()
    {
        $sms = new Sms(
            array(
                'login' => 'LOGIN',
                'password' => 'PASSWORD'
            )
        );
        $sms->sendSms(6281818181, 'Some message');
    }
}