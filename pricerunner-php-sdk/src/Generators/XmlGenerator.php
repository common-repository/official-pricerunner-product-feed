<?php

    namespace PricerunnerSDK\Generators;

    use DOMDocument;
    use DOMCdataSection;
    use PricerunnerSDK\Models\Product;
    use PricerunnerSDK\Validators\ProductCollectionValidator;
    use PricerunnerSDK\Models\GeneratedDataContainer;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    /**
     * Class XmlGenerator
     * @package PricerunnerSDK\Generators
     */
    class XmlGenerator
    {
        /**
         * @param Product[] $productArray
         * @param bool $withCData
         * @param ProductCollectionValidator $productCollectionValidator
         * @return GeneratedDataContainer
         */
        public static function getGeneratedData(
            $productArray,
            $withCData = false,
            ProductCollectionValidator $productCollectionValidator = null
        )
        {
            $errors = array();

            $domTree = new DOMDocument('1.0', 'UTF-8');

            $domTree->preserveWhiteSpace = false;
            $domTree->formatOutput = true;

            $xmlRoot = $domTree->createElement("products");
            $xmlRoot = $domTree->appendChild($xmlRoot);

            if($productCollectionValidator == null) {
                $productCollectionValidator = new ProductCollectionValidator();
            }

            foreach ($productArray as $product) {

                $productValidator = $productCollectionValidator->addAndValidateProduct($product);

                if(!$productValidator->getErrorCount()) {

                    if($productValidator->getWarningCount()) {
                        $errors[] = $productValidator->getErrors();
                    }

                    $currentProduct = $domTree->createElement("product");
                    $currentProduct = $xmlRoot->appendChild($currentProduct);

                    $productVars = $product->toArray();

                    foreach ($productVars as $productVarKey => $productVarVal) {
                        if($withCData) {
                            $productElement = $domTree->createElement($productVarKey);
                            $productElement->appendChild(new DOMCdataSection($productVarVal));

                            $currentProduct->appendChild($productElement);
                        } else {
                            $currentProduct->appendChild(
                                $domTree->createElement(
                                    $productVarKey,
                                    $productVarVal
                                )
                            );
                        }
                    }

                } else {
                    $errors[] = $productValidator->getErrors();
                }
            }

            $xmlString = $domTree->saveXml($domTree, LIBXML_NOEMPTYTAG);

            return new GeneratedDataContainer(
                $xmlString,
                $errors
            );
        }
    }
