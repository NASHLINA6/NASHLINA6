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

$arg1 = new createCryptoCurrencyInvoiceRequest();
$arg1->amount = 100.00;
$arg1->coinName = "BTC";
$arg1->currency = "USD";
// optional
$arg1->sciName = "sci_name";
$arg1->orderId = "12345";
$arg1->note = "note";

$createCryptoCurrencyInvoice = new createCryptoCurrencyInvoice();
$createCryptoCurrencyInvoice->arg0 = $arg0;
$createCryptoCurrencyInvoice->arg1 = $arg1;

try {
    echo print_r($merchantWebService->createCryptoCurrencyInvoice($createCryptoCurrencyInvoice));
} catch (Exception $e) {
    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
    echo $e->getTraceAsString();
}
?>