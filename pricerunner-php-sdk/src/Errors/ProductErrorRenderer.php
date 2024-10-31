<?php

    namespace PricerunnerSDK\Errors;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    class ProductErrorRenderer
    {
        public function __construct($errors)
        {
            $this->errors = $errors;
        }

        public function render()
        {
            $errors = $this->errors;

            ob_start();
            require PRICERUNNER_SDK_ROOT_DIR . '/Templates/ErrorView.php';
            $output = ob_get_clean();

            return $output;
        }
    }
