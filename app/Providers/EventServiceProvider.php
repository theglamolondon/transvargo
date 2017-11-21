<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\ExpediteurCreate' => [
            'App\Listeners\ExpediteurListener'
        ],
        'App\Events\TransporteurCreate' => [
            'App\Listeners\TransporteurListener'
        ],
        'App\Events\NewExpedition' => [
            'App\Listeners\ExpeditionListener'
        ],
        'App\Events\AcceptExpedition' => [
            'App\Listeners\ExpeditionAcceptListener'
        ],
        /*
        'App\Events\AcceptTransporteur' => [
            'App\Listeners\AcceptTransporteurListener'
        ], */
        'App\Events\DelivryChargement' => [
            'App\Listeners\DelivryTransporteurListener'
        ],
        'App\Events\ExpeditionFinish' => [
            'App\Listeners\ExpeditionFinishListener'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
