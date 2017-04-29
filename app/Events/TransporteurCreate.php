<?php

namespace App\Events;

use App\Transporteur;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TransporteurCreate
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $transporteur;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Transporteur $transporteur)
    {
        $this->transporteur = $transporteur;
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
