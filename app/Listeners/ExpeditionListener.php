<?php

namespace App\Listeners;

use App\Events\NewExpedition;
use App\Services\Firebase\Linked;
use Illuminate\Support\Facades\Log;

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
        $this->sendNotificationToAndoidDriverApp($event->expedition);
        Log::info("Nouvelle expédition de transport de marchandise créée");
    }
}
