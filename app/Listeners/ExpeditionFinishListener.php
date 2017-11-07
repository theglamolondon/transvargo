<?php

namespace App\Listeners;

use App\Events\ExpeditionFinish;
use App\Mail\ExpeditionFinishAdmin;
use App\Mail\ExpeditionFinishClient;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExpeditionFinishListener
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
     * @param  ExpeditionFinish  $event
     * @return void
     */
    public function handle(ExpeditionFinish $event)
    {
        $event->expedition;
        $this->sendEmailToClient($event);
        $this->sendEmailToAdmin($event);
    }

    private function sendEmailToClient(ExpeditionFinish $event)
    {
        try{
            Mail::to($event->expedition->client->identiteAccess->email)
                ->send(new ExpeditionFinishClient($event->expedition));
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }finally{
            Log::info("Email envoyé à l'expéditeur + Bon de Livraison");
        }
    }

    private function sendEmailToAdmin(ExpeditionFinish $event)
    {
        try{
            Mail::to(env("APP_EMAIL"))
                ->send(new ExpeditionFinishAdmin($event->expedition));
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }finally{
            Log::info("Email envoyé à l'expéditeur + Bon de Livraison");
        }
    }
}