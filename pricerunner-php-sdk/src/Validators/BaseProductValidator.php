<?php

    namespace PricerunnerSDK\Validators;

    use PricerunnerSDK\Errors\ProductErrorLevels;
    use PricerunnerSDK\Models\Product;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    class BaseProductValidator
    {
        /**
         * @var Product
         */
        protected $product;

        /**
         * @var array
         */
        protected $productErrors;

        /**
         * Contains the allowed StockStatuses
         *
         * @var array
         */
        protected $allowedStockStatusArray = array(
            'In Stock',
            'Out of Stock',
            'Preorder'
        );

        /**
         * ProductValidator constructor.
         * @param Product $product
         */
        public function __construct(Product $product)
        {
            $this->product = $product;

            $this->productErrors = array();

            $this->productErrors['product'] = $product->toArray();
            $this->productErrors['errors'] = array();
            $this->productErrors['warnings'] = array();
        }

        /**
         * @return int
         */
        public function getErrorCount()
        {
            return count($this->productErrors['errors']);
        }

        /**
         * @return int
         */
        public function getWarningCount()
        {
            return count($this->productErrors['warnings']);
        }

        /**
         * @return array
         */
        public function getErrors()
        {
            return $this->productErrors;
        }

        /**
         * Checks for a bool and adds to the error array if an error occurred
         *
         * @param bool $errorValue
         * @param string $type
         */
        protected function addErrorIfInvalid($errorValue, $type, $message)
        {
            if($errorValue) {
                return;
            }

            $this->addError($type, $message, ProductErrorLevels::ERROR_TYPE_FATAL);
        }

        /**
         * Checks for a bool and adds to the warnings array if a warning occurred
         *
         * @param bool $errorValue
         * @param string $type
         */
        protected function addWarningIfInvalid($errorValue, $type, $message)
        {
            if($errorValue) {
                return;
            }

            $this->addError($type, $message, ProductErrorLevels::ERROR_TYPE_WARNING);
        }

        /**
         * @param string $type
         * @param int $errorType
         */
        public function addError($type, $message, $errorType)
        {
            if($errorType == ProductErrorLevels::ERROR_TYPE_WARNING) {

                $this->productErrors['warnings'][] = array(
                    'type' => $type,
                    'message' => $message
                );

            } elseif($errorType == ProductErrorLevels::ERROR_TYPE_FATAL) {

                $this->productErrors['errors'][] = array(
                    'type' => $type,
                    'message' => $message
                );
            }
        }


        protected function validateCategoryName($errorMessage = 'Error validating categoryName')
        {
            $this->addErrorIfInvalid($this->isCategoryNameValid(), 'categoryName', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isCategoryNameValid()
        {
            $categoryName = $this->product->getCategoryName();
            return !empty($categoryName);
        }

        /**
         * @return bool
         */
        protected function isProductNameValid()
        {
            $productName = $this->product->getProductName();
            return !empty($productName);
        }

        protected function validateProductName($errorMessage = 'Error validating productName')
        {
            $this->addErrorIfInvalid($this->isProductNameValid(), 'productName', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isSkuValid()
        {
            $sku = $this->product->getSku();
            return !empty($sku);
        }

        protected function validateSku($errorMessage = 'Error validating sku')
        {
            $this->addErrorIfInvalid($this->isSkuValid(), 'sku', $errorMessage);
        }

        /**
         * Price must be set but can't be zero.
         * @return bool
         */
        protected function isPriceValid()
        {
            $price = $this->product->getPrice();
            return isset($price) && (float) $price != 0.0;
        }

        protected function validatePrice($errorMessage = 'Error validating price')
        {
            $this->addErrorIfInvalid($this->isPriceValid(), 'price', $errorMessage);
        }

        /**
         * Shipping cost is allowed to be zero, but must be set.
         * @return bool
         */
        protected function isShippingCostValid()
        {
            $shippingCost = $this->product->getShippingCost();
            return $shippingCost != '';
        }

        protected function validateShippingCost($errorMessage = 'Error validating shippingCost')
        {
            $this->addWarningIfInvalid($this->isShippingCostValid(), 'shippingCost', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isProductUrlValid()
        {
            return preg_match('/^(?:(?:https?):\/\/|www\.)[\S\d]+\.[\S\d]+$/', $this->product->getProductUrl()) === 1;
        }

        protected function validateProductUrl($errorMessage = 'Error validating productUrl')
        {
            $this->addErrorIfInvalid($this->isProductUrlValid(), 'productUrl', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isManufacturerValid()
        {
            $manufacturer = $this->product->getManufacturer();
            return !empty($manufacturer);
        }

        protected function validateManufacturer($errorMessage = 'Error validating manufacturer')
        {
            $this->addWarningIfInvalid($this->isManufacturerValid(), 'manufacturer', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isManufacturerSkuValid()
        {
            $manufacturerSku = $this->product->getManufacturerSku();
            return !empty($manufacturerSku);
        }

        protected function validateManufacturerSku($errorMessage = 'Error validating manufacturerSku')
        {
            $this->addWarningIfInvalid($this->isManufacturerSkuValid(), 'manufacturerSku', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isEanValid()
        {
            $ean = $this->product->getEan();

            return !empty($ean) &&
                is_numeric($ean) &&
                strlen($ean) == 13;
        }

        protected function validateEan($errorMessage = 'Error validating ean, an ean number must be exactly 13 digits')
        {
            $this->addWarningIfInvalid($this->isEanValid(), 'ean', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isUpcValid()
        {
            $upc = $this->product->getUpc();

            if(strlen($upc) == 0) {
                return true;
            }

            return !empty($upc);
        }

        protected function validateUpc($errorMessage = 'Error validating upc')
        {
            $this->addWarningIfInvalid($this->isUpcValid(), 'upc', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isDescriptionValid()
        {
            $description = $this->product->getDescription();
            return !empty($description);
        }

        protected function validateDescription($errorMessage =  'Error validating description')
        {
            $this->addWarningIfInvalid($this->isDescriptionValid(), 'description', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isImageUrlValid()
        {
            $imageUrl = $this->product->getImageUrl();
            return !empty($imageUrl);
        }


        protected function validateImageUrl($errorMessage = 'Error validating imageUrl')
        {
            $this->addWarningIfInvalid($this->isImageUrlValid(), 'imageUrl', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isStockStatusValid()
        {
            return in_array($this->product->getStockStatus(), $this->allowedStockStatusArray);
        }

        protected function validateStockStatus($errorMessage = null)
        {
            if($errorMessage == null) {
                $this->addWarningIfInvalid(
                    $this->isStockStatusValid(),
                    'stockStatus',
                    'Error validating stockStatus, allowed values are: ' . implode(', ', $this->allowedStockStatusArray)
                );
            } else {
                $this->addWarningIfInvalid($this->isStockStatusValid(), 'stockStatus', $errorMessage);
            }
        }

        /**
         * @return bool
         */
        protected function isDeliveryTimeValid()
        {
            $deliveryTime = $this->product->getDeliveryTime();
            return !empty($deliveryTime);
        }

        protected function validateDeliveryTime($errorMessage = 'Error validating deliveryTime')
        {
            $this->addWarningIfInvalid($this->isDeliveryTimeValid(), 'deliveryTime', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isRetailerMessageValid()
        {
            if(strlen($this->product->getRetailerMessage()) == 0) {
                return true;
            }

            return strlen($this->product->getRetailerMessage()) <= 125;
        }

        protected function validateRetailerMessage($errorMessage = 'Error validating retailerMessage')
        {
            $this->addWarningIfInvalid($this->isRetailerMessageValid(), 'retailerMessage', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isIsbnValid()
        {
            if(strlen($this->product->getIsbn()) == 0) {
                return true;
            }

            return is_numeric($this->product->getIsbn()) &&
                (strlen($this->product->getIsbn()) == 13 || strlen($this->product->getIsbn()) == 10);
        }

        protected function validateIsbn($errorMessage = 'Error validating isbn')
        {
            $this->addErrorIfInvalid($this->isIsbnValid(), 'isbn', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isCatalogIdValid()
        {
            if(strlen($this->product->getCatalogId()) == 0) {
                return true;
            }

            $catalogId = $this->product->getCatalogId();

            return !empty($catalogId);
        }

        protected function validateCatalogId($errorMessage = 'Error validating catalogId')
        {
            $this->addWarningIfInvalid($this->isCatalogIdValid(), 'catalogId', $errorMessage);
        }

        /**
         * @return bool
         */
        protected function isWarrantyValid()
        {
            return strlen($this->product->getWarranty()) == 0 || strlen($this->product->getWarranty()) <= 70;
        }

        protected function validateWarranty($errorMessage = 'Error validating warranty')
        {
            $this->addWarningIfInvalid($this->isWarrantyValid(), 'warranty', $errorMessage);
        }
    }
