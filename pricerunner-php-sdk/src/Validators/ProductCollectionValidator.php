<?php

    namespace PricerunnerSDK\Validators;

    use PricerunnerSDK\Models\Product;
    use PricerunnerSDK\Errors\ProductErrorLevels;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class ProductCollectionValidator
     * @package PricerunnerSDK\Validators
     */
    class ProductCollectionValidator
    {
        /**
         * Contains an array of unique properties values
         *
         * @var array
         */
        private $uniquePropertiesContainer = array(
            'sku' => array(),
            'ean' => array()
        );

        /**
         * Contains an array of which properties should be unique
         *
         * @var array
         */
        private $uniqueProperties = array(
            'sku',
            'ean'
        );

        /**
         * @param Product $product
         * @return ProductValidator
         */
        public function addAndValidateProduct(Product $product)
        {
            $productValidator = $this->createProductValidator($product);
            $productValidator->validate();

            $this->validateProductAgainstProductCollection($product, $productValidator);

            $this->uniquePropertiesContainer['sku'][] = $product->getSku();
            $this->uniquePropertiesContainer['ean'][] = $product->getEan();

            return $productValidator;
        }

        /**
         * @param Product $product
         * @return bool
         */
        private function checkIfEanExists(Product $product)
        {
            $ean = $product->getEan();
            if(empty($ean)) {
                return false;
            }

            return in_array($ean, $this->uniquePropertiesContainer['ean']);
        }

        protected function validateEan(Product $product, ProductValidator $productValidator)
        {
            if($this->checkIfEanExists($product)) {
                $productValidator->addError(
                    'ean',
                    'Ean value already exists, please check your products',
                    ProductErrorLevels::ERROR_TYPE_FATAL
                );
            }
        }

        /**
         * @param Product $product
         * @return bool
         */
        private function checkIfSkuExists(Product $product)
        {
            $sku = $product->getSku();
            if(empty($sku)) {
                return false;
            }

            return in_array($sku, $this->uniquePropertiesContainer['sku']);
        }

        protected function validateSku(Product $product, ProductValidator $productValidator)
        {
            if($this->checkIfSkuExists($product)) {
                $productValidator->addError(
                    'sku',
                    'Sku value already exists, please check your products',
                    ProductErrorLevels::ERROR_TYPE_FATAL
                );
            }
        }

        protected function createProductValidator($product)
        {
            return new ProductValidator($product);
        }

        protected function validateProductAgainstProductCollection(Product $product, ProductValidator $productValidator)
        {
            $this->validateEan($product, $productValidator);
            $this->validateSku($product, $productValidator);
        }

    }
