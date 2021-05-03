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

$arg1 = new withdrawToEcurrencyRequest();
$arg1->amount = 100.00;
//$arg1->cryptoCurrencyAmount = 0.01;
$arg1->currency = "USD";
$arg1->ecurrency = "BITCOIN";
$arg1->receiver = "32NDe1HXrYauSUFpXPHuXnBihx1PXKunMW";
$arg1->destinationTag = "123456";
$arg1->note = "note";
$arg1->orderId = "order_id";

$createCryptoCurrencyWithdrawalInvoice = new createCryptoCurrencyWithdrawalInvoice();
$createCryptoCurrencyWithdrawalInvoice->arg0 = $arg0;
$createCryptoCurrencyWithdrawalInvoice->arg1 = $arg1;

try {
    $invoice = $merchantWebService->createCryptoCurrencyWithdrawalInvoice($createCryptoCurrencyWithdrawalInvoice);
    echo print_r($invoice->return, true)."<br/><br/>";

    $findCryptoCurrencyWithdrawalInvoiceById = new findCryptoCurrencyWithdrawalInvoiceById();
    $findCryptoCurrencyWithdrawalInvoiceById->arg0 = $arg0;
    $findCryptoCurrencyWithdrawalInvoiceById->arg1 = $invoice->return->id;
    $invoice = $merchantWebService->findCryptoCurrencyWithdrawalInvoiceById($findCryptoCurrencyWithdrawalInvoiceById);
    echo print_r($invoice->return, true)."<br/><br/>";

    $findCryptoCurrencyWithdrawalInvoiceByOrderId = new findCryptoCurrencyWithdrawalInvoiceByOrderId();
    $findCryptoCurrencyWithdrawalInvoiceByOrderId->arg0 = $arg0;
    $findCryptoCurrencyWithdrawalInvoiceByOrderId->arg1 = $invoice->return->orderId;
    $invoice = $merchantWebService->findCryptoCurrencyWithdrawalInvoiceByOrderId($findCryptoCurrencyWithdrawalInvoiceByOrderId);
    echo print_r($invoice->return, true)."<br/><br/>";

    $confirmCryptoCurrencyWithdrawalInvoiceRequest = new confirmCryptoCurrencyWithdrawalInvoiceRequest();
    $confirmCryptoCurrencyWithdrawalInvoiceRequest->invoiceId = $invoice->return->id;

    $confirmCryptoCurrencyWithdrawalInvoice = new confirmCryptoCurrencyWithdrawalInvoice();
    $confirmCryptoCurrencyWithdrawalInvoice->arg0 = $arg0;
    $confirmCryptoCurrencyWithdrawalInvoice->arg1 = $confirmCryptoCurrencyWithdrawalInvoiceRequest;

    //$transactionId = $merchantWebService->confirmCryptoCurrencyWithdrawalInvoice($confirmCryptoCurrencyWithdrawalInvoice);
    //echo print_r($transactionId, true)."<br/><br/>";
} catch (Exception $e) {
    echo "ERROR MESSAGE => " . $e->getMessage() . "<br/>";
    echo $e->getTraceAsString();
}
?>