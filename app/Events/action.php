<?php

namespace App\Events;

use App\Emergency;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ServerCreated implements ShouldBroadcast
{
    use SerializesModels;

    public $emergency;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Emergency $emergency)
    {
        $this->emergency = $emergency;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()

    {
        $UserID = \DB::table('patient_assign')->where('patient_id', $emergency->patient_id)->get();

        return new PrivateChannel('user.'.$userID->user_id);
    }

}