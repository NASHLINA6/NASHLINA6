<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('max_execution_time', 0);
require_once("MerchantWebService.php");
$merchantWebService = new MerchantWebService();

$arg0 = new authDTO();
$arg0->apiName = "api_name";
$arg0->accountEmail = "account_email";
$arg0->authenticationToken = $merchantWebService->getAuthenticationToken("api_password");

$arg1 = new paymentOrderRequest();
$arg1->sciName = "sci_name";
$arg1->orderId = "order_id";

$findPaymentByOrderId = new findPaymentByOrderId();
$findPaymentByOrderId->arg0 = $arg0;
$findPaymentByOrderId->arg1 = $arg1;

try {
    $findPaymentByOrderIdResponse = $merchantWebService->findPaymentByOrderId($findPaymentByOrderId);

    echo print_r($findPaymentByOrderIdResponse->return, true)."<br/><br/>";
} catch (Exception $e) {
    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
    echo $e->getTraceAsString();
}
?>