<?php


namespace App\Paypal;


use PayPal\Api\Amount;
use PayPal\Api\Details;

class Paypal
{

    protected $apiContext;
    public function __construct()
    {
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.id'),
                config('services.paypal.secret')
            )
        );


    }

    /**
     * @param $payable_amount
     * @return Details
     */
    protected function details($payable_amount)
    {
        $details = new Details();
        $details->setSubtotal($payable_amount);
        return $details;
    }

    /**
     * @param $payable_amount
     * @param Details $details
     * @return Amount
     */
    protected function Amount($payable_amount)
    {
        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($payable_amount)
            ->setDetails($this->Details($payable_amount));
        return $amount;
    }
}
