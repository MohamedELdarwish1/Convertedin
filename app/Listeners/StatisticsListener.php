<?php

namespace App\Listeners;

use App\Events\Statistics;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Statistics as Stat;

class StatisticsListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Statistics $event): void
    {
        $userId = $event->data;
        $statistics = Stat::firstOrNew(['user_id' => $userId]);

        if (!$statistics->exists) {
            $statistics->user_id = $userId;
            $statistics->num_of_tasks = 1;
            $statistics->save();
        } else {
            $statistics->increment('num_of_tasks');
        }
    }
}
