<?php

    namespace PricerunnerSDK\Models;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class GeneratedDataContainer
     * @package PricerunnerSDK\Models
     */
    class GeneratedDataContainer
    {
        /**
         * Array of all errors
         *
         * @var array
         */
        private $errors;

        /**
         * String containing the finished XML
         *
         * @var string
         */
        private $xmlString;

        /**
         * GeneratedDataContainer constructor.
         * @param string $xmlString
         * @param array $errors
         */
        public function __construct($xmlString, $errors)
        {
            $this->xmlString = $xmlString;
            $this->errors = $errors;
        }

        /**
         * @return string
         */
        public function getXmlString()
        {
            return $this->xmlString;
        }

        /**
         * @return array
         */
        public function getErrors()
        {
            return $this->errors;
        }
    }
