<?php

namespace helpers;

/**
 * Auxiliary class related to message text functions
 *
 * @class MessageHelper
 * @version <1.0.0>
 * @date 14/04/2015
 * @author Eric Maicon
 * @license
 * @since 1.0
 **/
class MessageHelper {

    /**
     * Method that treat the message
     *
     * @param $message
     * @return string
     */
    public static function treatMessage($message) {
        $message = str_replace(' ', '+', $message);

        return $message;
    }

}