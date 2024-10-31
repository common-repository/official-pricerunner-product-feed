<?php

    namespace PricerunnerSDK\Errors;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class FileGeneratorErrors
     * @package PricerunnerSDK\Errors
     */
    class FileGeneratorErrors
    {
        /**
         * Error throwed when unable to create directory
         */
        const UNABLE_TO_CREATE_DIRECTORY = 1;

        /**
         * Error throwed when dir is not writable
         */
        const DIR_NOT_WRITABLE = 2;

        /**
         * Error throwed when unable to save file
         */
        const UNABLE_TO_SAVE_FILE = 3;

        /**
         * Error throwed when file not writable
         */
        const FILE_NOT_WRITABLE = 4;
    }
