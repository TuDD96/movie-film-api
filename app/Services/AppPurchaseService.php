<?php

namespace App\Services;

use ReceiptValidator\GooglePlay\Validator as PlayValidator;
use ReceiptValidator\iTunes\AbstractResponse;
use ReceiptValidator\iTunes\Validator as iTunesValidator;
use App\Enums\Constant;
use Exception;
use Log;

class AppPurchaseService
{
    private $googleJsonConfig = '';
    private $googleAppName = ''; 
    private $appleShareName = '';

    const GOOGLE_SCOPE = ['https://www.googleapis.com/auth/androidpublisher'];

    public function __construct()
    {
        $this->googleJsonConfig = env('GOOGLE_JSON_CONFIG');
        $this->googleAppName = env('GOOGLE_APP_NAME');
        $this->appleShareName = env('APPLE_SHARE_SECRET');
    }

    public function getGoogleInfo(array $receiptData)
    {
        if (!isset($receiptData['packageName']) || !isset($receiptData['productId']) || !isset($receiptData['purchaseToken'])) {
            return null;
        }

        // receipt data
        $packageName = $receiptData['packageName'];
        $productId = $receiptData['productId'];
        $purchaseToken = $receiptData['purchaseToken'];

        $client = new \Google_Client();
        $client->setApplicationName($this->googleAppName);
        $client->setAuthConfig($this->googleJsonConfig);
        $client->setScopes(self::GOOGLE_SCOPE);

        $validator = new PlayValidator(new \Google_Service_AndroidPublisher($client));

        try {
            $response = $validator
                ->setPackageName($packageName)
                ->setProductId($productId)
                ->setPurchaseToken($purchaseToken)
                ->validatePurchase();

            return $response;
        } catch (Exception $e) {
            Log::error('Google App Purchase Error: receipt error ' . $e->getMessage());
            return null;
        }
    }

    public function validateGoogle($data)
    {
        return $data->getPurchaseState() === Constant::GOOGLE_APP_PURCHASE_SUCCESS;
    }

    public function getAppleInfo($receiptBase64Data)
    {
        $validator = new iTunesValidator(iTunesValidator::ENDPOINT_PRODUCTION);

        $response = null;

        try {
            $response = $validator
                ->setSharedSecret($this->appleShareName)
                ->setReceiptData($receiptBase64Data)
                ->setExcludeOldTransactions(true)
                ->validate();

        } catch (\Exception $e) {
            Log::error('Apple App Purchase Error: receipt error ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }

        return $response;
    }

    public function validateApple($appleObj)
    {
        return $appleObj instanceof AbstractResponse && $appleObj->isValid();
    }
}