<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 01/07/2017
 * Time: 11:49
 */

namespace App\Http\Controllers\Finance;


use App\Http\Controllers\Controller;
use App\Metier\ExpeditionProcessing;
use App\Work\Money\Partner\OmPay;
use App\Work\Money\Payement;
use App\Work\Money\PayementException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    use ExpeditionProcessing;

    public function showChoosePayment($reference)
    {
        $expedition = $this->getExpeditionByReference($reference);

        try{
            $OM = new OmPay($expedition);
        }catch (PayementException $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
            return back()->withErrors($e->getMessage());
        }

        return view("money.payment-option", compact("expedition","OM"));
    }

    private function payment(Payement $payement )
    {
        $payement->boot();

        $payement->showPartnerPage();
    }

    private function validateRules(){
        return [
            "reference" => "required|exists:expedition"
        ];
    }

    public function performPurchaseSuccess()
    {

    }

    public function performPurchaseError()
    {

    }
}