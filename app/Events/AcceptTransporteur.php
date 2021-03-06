<?php

namespace App\Events;

use App\Expedition;
use App\Transporteur;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class AcceptTransporteur
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Transporteur $transporteur
     */
    public $transporteur;
    public $expedition;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    public function __construct(Transporteur $transporteur, Expedition $expedition)
    {
        $this->transporteur = $transporteur;
        $this->expedition = $expedition;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
