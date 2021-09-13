<?php


namespace App\Paypal;
use App\Models\PaypalPlan;
use PayPal\Api\ChargeModel;
use PayPal\Api\Currency;
use PayPal\Api\MerchantPreferences;
use PayPal\Api\Patch;
use PayPal\Api\PatchRequest;
use PayPal\Api\PaymentDefinition;
use PayPal\Api\Plan;
use PayPal\Common\PayPalModel;
use PHPUnit\Util\TestDox\ResultPrinter;


class SubscriptionPlan extends Paypal
{

    public function create()
    {
//        dd(request()->price);
        $plan = $this->Plan();

        $paymentDefinition = $this->PaymentDefinition();

        $chargeModel = $this->ChargeModel();

        $paymentDefinition->setChargeModels(array($chargeModel));

        $merchantPreferences = new MerchantPreferences();

        $this->MerchantPreferences($merchantPreferences);

        $plan->setPaymentDefinitions(array($paymentDefinition));
        $plan->setMerchantPreferences($merchantPreferences);

        $output = $plan->create($this->apiContext);
//        dd($output);

        $paypal_plan = new PaypalPlan();
        $paypal_plan->plan_id = $output->id;
        $paypal_plan->name = $output->name;
        $paypal_plan->description = $output->description;
        $paypal_plan->price = request()->price;
        $paypal_plan->frequency_month = request()->frequency;
        $paypal_plan->status = $output->state;
        $paypal_plan->save();

        return redirect(route('paypal-plan.index'));

    }

    /**
     * @return Plan
     */
    protected function Plan()
    {
        $plan = new Plan();
        $plan->setName(request()->plan_name)
            ->setDescription(request()->description)
            ->setType('fixed');
        return $plan;
    }

    /**
     * @return PaymentDefinition
     */
    protected function PaymentDefinition()
    {
        $plan_price = (int)request()->price;
        $paymentDefinition = new PaymentDefinition();
        $paymentDefinition->setName('Regular Payments')
            ->setType('REGULAR')
            ->setFrequency('Month')
            ->setFrequencyInterval("1")
            ->setCycles(request()->frequency)
            ->setAmount(new Currency(array('value' => $plan_price, 'currency' => 'USD')));
        return $paymentDefinition;
    }

    /**
     * @return ChargeModel
     */
    protected function ChargeModel()
    {
        $chargeModel = new ChargeModel();
        $chargeModel->setType('SHIPPING')
            ->setAmount(new Currency(array('value' => 0, 'currency' => 'USD')));
        return $chargeModel;
    }

    /**
     * @param MerchantPreferences $merchantPreferences
     */
    protected function MerchantPreferences(MerchantPreferences $merchantPreferences)
    {
        $merchantPreferences->setReturnUrl('http://127.0.0.1:8000/execute-agreement/true')
            ->setCancelUrl('http://127.0.0.1:8000/execute-agreement/false')
            ->setAutoBillAmount("yes")
            ->setInitialFailAmountAction("CONTINUE")
            ->setMaxFailAttempts("0")
            ->setSetupFee(new Currency(array('value' => 1, 'currency' => 'USD')));
    }

    public function listPlan(){
        $params = array('page_size' => '10');
        $planList = Plan::all($params, $this->apiContext);

        return $planList;

    }

    public function PlanDetails($id)
    {
        $plan = Plan::get($id, $this->apiContext);

        return $plan;

    }

    public function activate($id)
    {
        $get_plan = PaypalPlan::findOrFail($id);
        $createdPlan = $this->PlanDetails($get_plan->plan_id);
        $patch = new Patch();

        $value = new PayPalModel('{
	       "state":"ACTIVE"
	     }');

        $patch->setOp('replace')
            ->setPath('/')
            ->setValue($value);
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);

        $createdPlan->update($patchRequest, $this->apiContext);

        $plan = Plan::get($createdPlan->getId(), $this->apiContext);

        $get_plan->status = 'ACTIVE';
        $get_plan->update();
        return redirect(route('paypal-plan.index'))->with('alert-success', 'Plan Activated Successfully');
    }

    public function delete($id)
    {
        $get_plan = PaypalPlan::findOrFail($id);

        $createdPlan = Plan::get($get_plan->plan_id, $this->apiContext);

        $result = $createdPlan->delete($this->apiContext);

        $get_plan->delete();

        return redirect(route('paypal-plan.index'))->with('alert-success', 'Plan Deleted Successfully');
    }

    public function update($id)
    {

//            $get_plan = PaypalPlan::findOrFail($id);
//            $createdPlan = $this->PlanDetails($get_plan->plan_id);
//            $patch = new Patch();
//
//            $paymentDefinitions = $createdPlan->getPaymentDefinitions();
//            $paymentDefinitionId = $paymentDefinitions[0]->getId();
//            $patch->setOp('replace')
//                ->setPath('/payment-definitions/' . $paymentDefinitionId)
//                ->setValue( "state"=> "ACTIVE");
//            $patchRequest = new PatchRequest();
//            $patchRequest->addPatch($patch);
//
//            $createdPlan->update($patchRequest, $this->apiContext);
//
//            $plan = Plan::get($createdPlan->getId(), $this->apiContext);

        $get_plan = PaypalPlan::findOrFail($id);
        $createdPlan = $this->PlanDetails($get_plan->plan_id);
        $paymentDefinitions = $createdPlan->payment_definitions;
        $paymentDefinitionId = $paymentDefinitions[0]->getId();
//        dd($paymentDefinitionId);
        $patch = new Patch();
        $path = '/payment-definitions';
        $patch->setOp('replace')
        ->setPath($path)
        ->setValue('{
	       "value":"50"
	     }'
        );
        $patchRequest = new PatchRequest();
        $patchRequest->addPatch($patch);

        $createdPlan->update($patchRequest, $this->apiContext);

        $plan = Plan::get($createdPlan->getId(), $this->apiContext);

        $get_plan->price = '50';
        $get_plan->update();
        return redirect(route('paypal-plan.index'))->with('alert-success', 'Plan Activated Successfully');

    }
}
