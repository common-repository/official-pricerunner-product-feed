<?php

    namespace PricerunnerSDK\Parsers;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class StringParser
     * @package PricerunnerSDK\Parsers
     */
    class StringParser
    {
        /**
         * @param int $length
         * @return string
         */
        public static function getRandomString($length = 20)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';

            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }

            return $randomString;
        }

        /**
         * @param $string
         * @return string
         */
        public static function getXmlReadyString($string)
        {
            $string = strip_tags($string);
            $string = static::stripUnwantedCharacters($string);
            $string = static::removeDoubleSpaces($string);

            return $string;
        }

        /**
         * Takes a string, checks for wrong word spacings and returns a new one
         *
         * @param $string
         * @return string
         */
        private static function removeDoubleSpaces($string)
        {
            return preg_replace('/\s{2,}/', ' ', $string);
        }

        private static function stripUnwantedCharacters($string)
        {
            return preg_replace('/[^\w \.,\s!+\'"#:?=\d<>^_\-\\/]/u', '', $string);
        }
    }
