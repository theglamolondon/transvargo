<?php

namespace App\Listeners;

use App\Events\AcceptTransporteur;
use App\Mail\ExpeditionAccepted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AcceptTransporteurListener
{
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
     * @param  AcceptTransporteur  $event
     * @return void
     */
    public function handle(AcceptTransporteur $event)
    {
        //$event->expedition->bonlivraison = sprintf("EXP%s-%04d", date('Ym'), $event->expedition->id);
        //$event->expedition->save();

        //Envoie de SMS
        Log::info("SMS envoyé au client pour l'acceptation de l'expédition ".$event->expedition->reference);

        //Email
        $this->sendMailToClient($event);
    }

    private function sendMailToClient(AcceptTransporteur $event)
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
}
