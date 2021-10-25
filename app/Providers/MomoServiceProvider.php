<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
class MomoServiceProvider extends ServiceProvider
{
    public static function purchase(array $options = [])
    {
        $accessKey   = env('MOMO_ACCESS_KEY');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $secretKey   = env('MOMO_SECRET_KEY');
        $endPoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $requestType = "captureWallet";

        $ipnUrl = $options['ipnUrl'] ?? null;
        $redirectUrl = $options['redirectUrl'] ?? null;
        $orderId = $options['orderId'] ?? null;
        $amount = $options['amount'] ?? null;
        $orderInfo = $options['orderInfo'] ?? null;
        $requestId = $options['requestId'] ?? null;
        $extraData = $options['extraData'] ?? "";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $response = Http::post($endPoint, [
                'partnerCode' => $partnerCode,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'requestType' => $requestType,
                'extraData' => $extraData,
                'lang' => 'vi',
                'signature' => $signature,
        ]);
        return $response;
    }

    public function completePurchase(){

    }

}


