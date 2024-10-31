<?php

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;

    /*
     * Root directory of the PricerunnerSDK folder
     */
    define('PRICERUNNER_SDK_ROOT_DIR', dirname(__FILE__));

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/PricerunnerSDK.php');

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Services/PricerunnerService.php');

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Errors/FileGeneratorErrors.php');
    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Errors/ProductErrorLevels.php');
    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Errors/ProductErrorRenderer.php');

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Models/GeneratedDataContainer.php');
    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Models/Product.php');

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Generators/FileGenerator.php');
    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Generators/XmlGenerator.php');

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Validators/ProductCollectionValidator.php');
    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Validators/BaseProductValidator.php');
    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Validators/ProductValidator.php');

    require_once(PRICERUNNER_SDK_ROOT_DIR . '/Parsers/StringParser.php');
