<?php

namespace App\Events;

use App\Expedition;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DelivryChargement
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $expedition;
    public $otp;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Expedition $expedition, $otp = null)
    {
        $this->expedition = $expedition;
        $this->otp = $otp;
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
