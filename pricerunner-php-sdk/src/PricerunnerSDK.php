<?php

    namespace PricerunnerSDK;

    use PricerunnerSDK\Models\Product;
    use PricerunnerSDK\Parsers\StringParser;
    use PricerunnerSDK\Validators\ProductCollectionValidator;
    use PricerunnerSDK\Generators\XmlGenerator;
    use PricerunnerSDK\Generators\FileGenerator;
    use PricerunnerSDK\Services\PricerunnerService;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;

    /**
     * Class PricerunnerSDK
     * @package PricerunnerSDK
     * @license Mozilla Public License 2.0
     */
    class PricerunnerSDK
    {
        /**
         * @param Product[] $productArray
         * @param bool $withCData
         * @param ProductCollectionValidator $productCollectionValidator
         * @return Models\GeneratedDataContainer
         */
        public static function generateDataContainer($productArray, $withCData = false, ProductCollectionValidator $productCollectionValidator = null)
        {
            return XmlGenerator::getGeneratedData($productArray, $withCData, $productCollectionValidator);
        }

        /**
         * @param Product[] $productArray
         * @param ProductCollectionValidator $productCollectionValidator
         * @return array
         */
        public static function validateProducts($productArray, ProductCollectionValidator $productCollectionValidator = null)
        {
            $errors = array();

            if($productCollectionValidator == null) {
                $productCollectionValidator = new ProductCollectionValidator();
            }

            foreach ($productArray as $product) {
                $productValidator = $productCollectionValidator->addAndValidateProduct($product);

                if($productValidator->getErrorCount() ||$productValidator->getWarningCount()) {
                    $errors[] = $productValidator->getErrors();
                }
            }

            return $errors;
        }

        /**
         * @param string $filePath
         * @param string $content
         * @throws \Exception
         */
        public static function createFile($filePath, $content)
        {
            $fileGenerator = new FileGenerator();
            $fileGenerator->createDirAndFile($filePath, $content);
        }

        /**
         * @param string $filePath
         * @throws \Exception
         */
        public static function testFilePath($filePath)
        {
            $fileGenerator = new FileGenerator();
            $fileGenerator->testFilePath($filePath);
        }

        /**
         * @param int $length
         * @return string
         */
        public static function getRandomString($length = 20)
        {
            return StringParser::getRandomString($length);
        }

        /**
         * Takes a string, and removes all unwanted characters and unnecessary whitespace
         *
         * @param $string
         * @return string
         */
        public static function getXmlReadyString($string)
        {
            return StringParser::getXmlReadyString($string);
        }

        /**
         * Posts a user registration to Pricerunner
         *
         * @param $name
         * @param $phone
         * @param $email
         * @param $domain
         * @param $feedUrl
         * @return string
         * @throws \Exception
         */
        public static function postRegistration($name, $phone, $email, $domain, $feedUrl)
        {
            return PricerunnerService::postRegistration($name, $phone, $email, $domain, $feedUrl);
        }
    }
