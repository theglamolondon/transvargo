<?php

namespace App\Listeners;

use App\Events\AcceptExpedition;
use App\Expedition;
use App\Mail\ExpeditionAccepted;
use App\Services\Firebase\Linked;
use App\Services\IpGeolocalisation;
use App\Services\Sms\Textlocal;
use App\Transporteur;
use App\TypeTransporteur;
use Carbon\Carbon;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExpeditionAcceptListener
{
    use Linked;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AcceptExpedition  $event
     * @return void
     */
    public function handle(AcceptExpedition $event)
    {
        Log::info('Expedition '.$event->expedition->reference.' acceptée');

        $this->notifyChauffeur($event);

        $this->sendSMS($event);

        $this->sendMailToClient($event);
    }

    private function sendSMS(AcceptExpedition $event)
    {
        try{
            $sms = new Textlocal(null,null);

            //Envoi de SMS
            $number = [ "number" => "+225".$event->expedition->client->contact ];
            $text = "Votre expédition {$event->expedition->reference} a été acceptée. Le transporteur vous contactera. Veuillez confirmer votre expédition.";

            $response = $sms->sendSms($number, $text, "Transvargo");

            //dd($response);
            /*
            {#285 ▼
              +"balance": 7.6
              +"batch_id": 445984089
              +"cost": 1.2
              +"num_messages": 1
              +"message": {#284 ▼
                +"num_parts": 1
                +"sender": "Transvargo"
                +"content": "Votre expédition EXP05062017-E958F9 a été acceptée. Le transporteur vous contactera. Veuillez confirmer votre expédition."
              }
              +"receipt_url": ""
              +"custom": ""
              +"messages": array:1 [▼
                0 => {#287 ▼
                  +"id": "1601023109"
                  +"recipient": 22508379052.0
                }
              ]
              +"status": "success"
            }
            */
            Log::info("Statut du message : ".$response->status);
        }catch (\Exception $e){
            $e->getMessage();
            $e->getTraceAsString();
        }
    }

    private function sendMailToClient(AcceptExpedition $event)
    {
        try{
            Mail::to($event->expedition->client->identiteAccess->email)
                ->send(new ExpeditionAccepted($event->expedition));
        }catch (\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }finally{
            Log::info("Email envoyé à l'expéditeur + Facture");
        }
    }

    private function notifyChauffeur(AcceptExpedition $event)
    {
        try{
            $this->notifyTransporteurAccount($event->expedition, $event->expedition->chargement->vehicule->transporteur);
        }catch (\Exception $e){
            Log::error($e->getMessage());
            Log::error($e->getTraceAsString());
        }
        logger("Notification android envoyée");
    }
}