<?php


namespace App\Paypal;


use http\Env\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

class CreatePayment extends Paypal
{

    public function create()
    {
        $plan = request()->plan;
        if($plan == 1){
            $plan_name = 'Plan-1 (Startup)';
            $payable_amount = 125;
        }elseif($plan == 2){
            $plan_name = 'Plan-2 (Grow Big)';
            $payable_amount = 250;
        }else{
            $plan_name = 'Plan-3 (Enterprise)';
            $payable_amount = 500;
        }

        $website = request()->website;


        $item1 = new Item();
        $item1->setName($plan_name)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setSku("123123") // Similar to `item_number` in Classic API
            ->setPrice($payable_amount);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $payment = $this->Payment($itemList,$website, $plan_name,$payable_amount);

        $payment->create($this->apiContext);
        return redirect($payment->getApprovalLink());
    }

    /**
     * @return Payer
     */
    protected function Payer()
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        return $payer;
    }


    /**
     * @param Amount $amount
     * @param ItemList $itemList
     * @param $plan_name
     * @return Transaction
     */
    protected function Transaction($itemList,$plan_name,$payable_amount)
    {

        $transaction = new Transaction();
        $transaction->setAmount($this->Amount($payable_amount))
            ->setItemList($itemList)
            ->setDescription("Subscription for :" . $plan_name)
            ->setInvoiceNumber(uniqid());
        return $transaction;
    }

    /**
     * @param $website
     * @return RedirectUrls
     */
    protected function RedirectUrls($website)
    {

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl('http://127.0.0.1:8000/execute-payment?website=' . $website)
            ->setCancelUrl('http://127.0.0.1:8000/cancel-payment');
        return $redirectUrls;
    }

    /**
     * @param Payer $payer
     * @param RedirectUrls $redirectUrls
     * @param Transaction $transaction
     * @return Payment
     */
    protected function Payment( $itemList,$website,$plan_name,$payable_amount)
    {
        $payment = new Payment($itemList, $plan_name,$payable_amount,$website);
        $payment->setIntent("sale")
            ->setPayer($this->Payer())
            ->setRedirectUrls($this->RedirectUrls($website))
            ->setTransactions(array($this->Transaction($itemList, $plan_name,$payable_amount)));
        return $payment;
    }
}
