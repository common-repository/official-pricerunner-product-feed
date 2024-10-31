<?php

    namespace PricerunnerSDK\Errors;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    class ProductErrorLevels
    {
        /**
         * Used for warning type errors, XML generation is still allowed but the user will be notified
         */
        const ERROR_TYPE_WARNING = 0;

        /**
         * Used for fatal type errors, XML generation with fatal errors is not allowed and the user will be notified
         */
        const ERROR_TYPE_FATAL = 1;
    }
