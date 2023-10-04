<?php

namespace App\Jobs;

use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateStatistics implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $users = User::withCount('task')->where('role_id',2)->get();

        foreach ($users as $user) {

            $statistics = Statistics::where('user_id' , $user->id)->first();
            if ($statistics) {
                $statistics->num_of_tasks = $user->task_count;
                $statistics->save();
            } elseif ($user->task_count > 0) {
                // Create a new statistics record if the user has tasks
                $statistics = new Statistics();
                $statistics->user_id = $user->id;
                $statistics->num_of_tasks = $user->task_count;
                $statistics->save();
            }
        }

    }
}
