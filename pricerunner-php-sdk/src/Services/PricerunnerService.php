<?php

    namespace PricerunnerSDK\Services;

    use Exception;
    use stdClass;

    if (!defined('PRICRUNNER_OFFICIAL_PLUGIN_VERSION')) exit;
    
    class PricerunnerService
    {
        const BASE_URL = "http://pricerunnerapi.dk/v1";

        private static function post($url, $body, $headers)
        {
            $ch = curl_init();

            $curlOptions = array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => false, // Disabled due to some hosts not allowing POST requests with this flag on.
                // CURLOPT_MAXREDIRS => 10,
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $body,
                CURLOPT_ENCODING => '',
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_HEADER => false,
            );

            curl_setopt_array($ch, $curlOptions);

            $response   = curl_exec($ch);
            $error      = curl_error($ch);
            $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($error) {
                throw new Exception($error);
            }

            $toReturn = new stdClass();
            $toReturn->code = $httpStatusCode;
            $toReturn->body = json_decode($response);

            return $toReturn;
        }

        /**
         * Posts a Pricerunner shop registration
         *
         * @param $name
         * @param $phone
         * @param $email
         * @param $domain
         * @param $feedUrl
         * @return mixed
         * @throws Exception
         */
        public static function postRegistration($name, $phone, $email, $domain, $feedUrl)
        {
            $headers = array(
                'user-agent: pricerunner-sdk 1.0'
            );

            $query = array(
                'name' => $name,
                'phone' => $phone,
                'email' => $email,
                'domain' => $domain,
                'feedUrl' => $feedUrl
            );

            $response = static::post(PricerunnerService::BASE_URL . "/registration", $query, $headers);

            if ($response->code == 200) {
                return $response->body;
            } else {
                throw new Exception($response->body->statusText, $response->code);
            }
        }
    }
