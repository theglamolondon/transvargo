<?php

namespace App\Listeners;

use App\Events\ExpediteurCreate;
use App\Mail\NouveauExpediteurMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExpediteurListener
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
     * @param  ExpediteurCreate  $event
     * @return void
     */
    public function handle(ExpediteurCreate $event)
    {
        try{
            Mail::to($event->client->identiteAccess->email)
                ->send(new NouveauExpediteurMailer($event->client));
        }catch (\Exception $e){
            Log::error($e->getMessage());
        }finally{
            Log::error('Expéditeur créé');
        }
    }
}