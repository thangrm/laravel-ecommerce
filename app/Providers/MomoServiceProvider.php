<?php

namespace App\Providers;

use Illuminate\Http\Request;
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

//        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
//        $signature = hash_hmac("sha256", $rawHash, $secretKey);
//
//        $response = Http::post($endPoint, [
//                'partnerCode' => $partnerCode,
//                'requestId' => $requestId,
//                'amount' => $amount,
//                'orderId' => $orderId,
//                'orderInfo' => $orderInfo,
//                'redirectUrl' => $redirectUrl,
//                'ipnUrl' => $ipnUrl,
//                'requestType' => $requestType,
//                'extraData' => $extraData,
//                'lang' => 'vi',
//                'signature' => $signature,
//        ]);
        $endPoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $rawHash = "partnerCode=$partnerCode&accessKey=$accessKey&requestId=$requestId&amount=$amount&orderId=$orderId&orderInfo=$orderInfo&returnUrl=$redirectUrl&notifyUrl=$ipnUrl&extraData=$extraData";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $requestType = "captureMoMoWallet";
        $response = Http::post($endPoint, [
                'accessKey' => $accessKey,
                'partnerCode' => $partnerCode,
                'requestType' => $requestType,
                'notifyUrl' => $ipnUrl,
                'returnUrl' => $redirectUrl,
                'orderId' => $orderId,
                'amount' => $amount,
                'orderInfo' => $orderInfo,
                'requestId' => $requestId,
                'extraData' => $extraData,
                'signature' => $signature,
        ]);
        return $response;
    }

    public static function completePurchase(Request $request){
        $accessKey   = env('MOMO_ACCESS_KEY');
        $partnerCode = env('MOMO_PARTNER_CODE');
        $secretKey   = env('MOMO_SECRET_KEY');

        $orderId = $request->orderId;
        $localMessage = $request->localMessage;
        $message = $request->message;
        $transId = $request->transId;
        $orderInfo = $request->orderInfo;
        $amount = $request->amount;
        $errorCode = $request->errorCode;
        $responseTime = $request->responseTime;
        $requestId = $request->requestId;
        $payType = $request->payType;
        $orderType = $request->orderType;
        $extraData = $request->extraData;
        $m2signature = $request->signature;

        $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
                "&orderType=" . $orderType . "&transId=" . $transId . "&message=" . $message . "&localMessage=" . $localMessage . "&responseTime=" . $responseTime . "&errorCode=" . $errorCode .
                "&payType=" . $payType . "&extraData=" . $extraData;

        $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);

        $success = false;
        if ($m2signature == $partnerSignature) {
            if ($errorCode == '0') {
                $resultMessage = array('Payment Success');
                $success = true;
            } else {
                $resultMessage = $message;
            }
        } else {
            $resultMessage = 'This transaction could be hacked, please check your signature and returned signature';
        }
        return array('success'=>$success, 'message'=>$resultMessage);
    }
}


