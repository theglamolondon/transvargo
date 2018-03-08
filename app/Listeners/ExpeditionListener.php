<?php

namespace App\Listeners;

use App\Events\NewExpedition;
use App\Mail\NotifTransvargoTeam;
use App\Services\Firebase\Linked;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ExpeditionListener
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
     * @param  NewExpedition  $event
     * @return void
     */
   public function handle(NewExpedition $event)
  {
       //$this->sendNotificationToAndoidDriverApp($event->expedition);
      //env('MAIL_USERNAME');
      try{
          Mail::to("glamolondon@gmail.com")
              ->send(new NotifTransvargoTeam($event->expedition));
      }catch (\Exception $e){
          Log::error($e->getMessage());
          Log::error($e->getTraceAsString());
      }
       Log::info("Nouvelle expédition de transport de marchandise créée");
  }

}
