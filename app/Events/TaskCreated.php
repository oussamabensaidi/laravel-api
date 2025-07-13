<?php

namespace App\Events;

use App\Models\Task;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;  // add this at the top of your PHP file (optional but good practice)

class TaskCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function broadcastOn()
    {
            Log::info('📢 Broadcasting task.created for user ID: ' . $this->task->user_id);

        return new PrivateChannel('tasks.' . $this->task->user_id);
    }

    public function broadcastWith()
    {
        return [
            'id' => $this->task->id,
            'titre' => $this->task->titre,
            'created_at' => $this->task->created_at->toDateTimeString(),
        ];
    }

    public function broadcastAs()
    {
        return 'task.created';
    }
}
