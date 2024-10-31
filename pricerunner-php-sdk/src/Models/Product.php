<?php

    namespace PricerunnerSDK\Models;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class Product
     * @package PricerunnerSDK\Models
     */
    class Product extends \stdClass
    {
        /**
         * @var string
         */
        private $categoryName;

        /**
         * @var string
         */
        private $productName;

        /**
         * @var string
         */
        private $sku;

        /**
         * @var string
         */
        private $price;

        /**
         * @var string
         */
        private $shippingCost;

        /**
         * @var string
         */
        private $productUrl;

        /**
         * @var string
         */
        private $manufacturerSku;

        /**
         * @var string
         */
        private $manufacturer;

        /**
         * @var string
         */
        private $ean;

        /**
         * @var string
         */
        private $description;

        /**
         * @var string
         */
        private $imageUrl;

        /**
         * @var string
         */
        private $stockStatus;

        /**
         * @var string
         */
        private $deliveryTime;

        /**
         * These properties are outcommented because they are optional in the product feed.
         * Meaning they will be set when the setMethod is called e.g. $this->setRetailerMessage($message);
         */
        /*    
        private $upc;
        private $retailerMessage;
        private $productState;
        private $isbn;
        private $catalogId;
        private $warranty;
        */

        /**
         * @return array
         */
        public function toArray()
        {
            return get_object_vars($this);
        }

        /**
         * @return string
         */
        public function getCategoryName()
        {
            return !empty($this->categoryName) ? $this->categoryName : '';
        }

        /**
         * @param string $categoryName
         * @return $this
         */
        public function setCategoryName($categoryName)
        {
            $this->categoryName = $categoryName;

            return $this;
        }

        /**
         * @return string
         */
        public function getProductName()
        {
            return !empty($this->productName) ? $this->productName : '';
        }

        /**
         * @param string $productName
         * @return $this
         */
        public function setProductName($productName)
        {
            $this->productName = $productName;

            return $this;
        }

        /**
         * @return string
         */
        public function getSku()
        {
            return !empty($this->sku) ? $this->sku : '';
        }

        /**
         * @param string $sku
         * @return $this
         */
        public function setSku($sku)
        {
            $this->sku = $sku;

            return $this;
        }

        /**
         * @return string
         */
        public function getPrice()
        {
            return !empty($this->price) ? $this->price : '';
        }

        /**
         * @param string $price
         * @return $this
         */
        public function setPrice($price)
        {
            $this->price = $price;

            return $this;
        }

        /**
         * @return string
         */
        public function getShippingCost()
        {
            return !empty($this->shippingCost) ? $this->shippingCost : '';
        }

        /**
         * @param string $shippingCost
         * @return $this
         */
        public function setShippingCost($shippingCost)
        {
            $this->shippingCost = $shippingCost;

            return $this;
        }

        /**
         * @return string
         */
        public function getProductUrl()
        {
            return !empty($this->productUrl) ? $this->productUrl : '';
        }

        /**
         * @param string $productUrl
         * @return $this
         */
        public function setProductUrl($productUrl)
        {
            $this->productUrl = $productUrl;

            return $this;
        }

        /**
         * @return string
         */
        public function getManufacturerSku()
        {
            return !empty($this->manufacturerSku) ? $this->manufacturerSku : '';
        }

        /**
         * @param string $manufacturerSku
         * @return $this
         */
        public function setManufacturerSku($manufacturerSku)
        {
            $this->manufacturerSku = $manufacturerSku;

            return $this;
        }

        /**
         * @return string
         */
        public function getManufacturer()
        {
            return !empty($this->manufacturer) ? $this->manufacturer : '';
        }

        /**
         * @param string $manufacturer
         * @return $this
         */
        public function setManufacturer($manufacturer)
        {
            $this->manufacturer = $manufacturer;

            return $this;
        }

        /**
         * @return string
         */
        public function getEan()
        {
            return !empty($this->ean) ? $this->ean : '';
        }

        /**
         * @param string $ean
         * @return $this
         */
        public function setEan($ean)
        {
            $this->ean = $ean;

            return $this;
        }

        /**
         * @return string
         */
        public function getUpc()
        {
            return !empty($this->upc) ? $this->upc : '';
        }

        /**
         * @param string $upc
         * @return $this
         */
        public function setUpc($upc)
        {
            $this->upc = $upc;

            return $this;
        }

        /**
         * @return string
         */
        public function getDescription()
        {
            return !empty($this->description) ? $this->description : '';
        }

        /**
         * @param string $description
         * @return $this
         */
        public function setDescription($description)
        {
            $this->description = $description;

            return $this;
        }

        /**
         * @return string
         */
        public function getImageUrl()
        {
            return !empty($this->imageUrl) ? $this->imageUrl : '';
        }

        /**
         * @param string $imageUrl
         * @return $this
         */
        public function setImageUrl($imageUrl)
        {
            $this->imageUrl = $imageUrl;

            return $this;
        }

        /**
         * @return string
         */
        public function getStockStatus()
        {
            return !empty($this->stockStatus) ? $this->stockStatus : '';
        }

        /**
         * @param string $stockStatus
         * @return $this
         */
        public function setStockStatus($stockStatus)
        {
            $this->stockStatus = $stockStatus;

            return $this;
        }

        /**
         * @return string
         */
        public function getDeliveryTime()
        {
            return !empty($this->deliveryTime) ? $this->deliveryTime : '';
        }

        /**
         * @param string $deliveryTime
         * @return $this
         */
        public function setDeliveryTime($deliveryTime)
        {
            $this->deliveryTime = $deliveryTime;

            return $this;
        }

        /**
         * @return string
         */
        public function getRetailerMessage()
        {
            return !empty($this->retailerMessage) ? $this->retailerMessage : '';
        }

        /**
         * @param string $retailerMessage
         * @return $this
         */
        public function setRetailerMessage($retailerMessage)
        {
            $this->retailerMessage = $retailerMessage;

            return $this;
        }

        /**
         * @return string
         */
        public function getProductState()
        {
            return !empty($this->productState) ? $this->productState : '';
        }

        /**
         * @param string $productState
         * @return $this
         */
        public function setProductState($productState)
        {
            $this->productState = $productState;

            return $this;
        }

        /**
         * @return string
         */
        public function getIsbn()
        {
            return !empty($this->isbn) ? $this->isbn : '';
        }

        /**
         * @param string $isbn
         * @return $this
         */
        public function setIsbn($isbn)
        {
            $this->isbn = $isbn;

            return $this;
        }

        /**
         * @return string
         */
        public function getCatalogId()
        {
            return !empty($this->catalogId) ? $this->catalogId : '';
        }

        /**
         * @param string $catalogId
         * @return $this
         */
        public function setCatalogId($catalogId)
        {
            $this->catalogId = $catalogId;

            return $this;
        }

        /**
         * @return string
         */
        public function getWarranty()
        {
            return !empty($this->warranty) ? $this->warranty : '';
        }

        /**
         * @param string $warranty
         * @return $this
         */
        public function setWarranty($warranty)
        {
            $this->warranty = $warranty;

            return $this;
        }
    }
