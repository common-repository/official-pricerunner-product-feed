<?php

    namespace PricerunnerSDK\Validators;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class ProductValidator
     * @package PricerunnerSDK\Validators
     */
    class ProductValidator extends BaseProductValidator
    {
        /**
         * Validates the injected product and populates an array with errors, which can later be fetched from the class
         * @return void
         */
        public function validate()
        {
            $this->validateCategoryName();
            $this->validateProductName();
            $this->validateSku();
            $this->validatePrice();
            $this->validateProductUrl();
            $this->validateIsbn();
            $this->validateManufacturer();
            $this->validateManufacturerSku();
            // TODO
            //$this->validateProductState();
            $this->validateShippingCost();
            $this->validateEan();
            $this->validateUpc();
            $this->validateDescription();
            $this->validateImageUrl();
            $this->validateStockStatus();
            $this->validateDeliveryTime();
            $this->validateRetailerMessage();
            $this->validateCatalogId();
            $this->validateWarranty();
        }
    }
