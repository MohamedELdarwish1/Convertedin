<?php

namespace App\Http\Controllers;

use App\Events\Statistics as EventsStatistics;
use App\Http\Resources\TasksResource;
use App\Models\Statistics;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Task::paginate(10);

        $tasks = TasksResource::collection($data);
        // dd($tasks);
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Check if the user list is already cached
        if (Cache::has('user_list')) {
            $users = Cache::get('user_list');
        } else {
            $users = User::where('role_id', 2)->get();
            Cache::put('user_list', $users, now()->addHours(1));
        }
        $admins = User::where('role_id', 1)->get();
        return view('tasks.create', ['users' => $users, 'admins' => $admins]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'assigned_to_id' => $request->assigned_to_id,
            'assigned_by_id' => $request->assigned_by_id,

        ]);
        //we can do it like that

        /*   $statistics = Statistics::firstOrNew(['user_id' => $task->assigned_to_id]);
        if (!$statistics->exists) {
            $statistics->user_id =  $task->assigned_to_id;
            $statistics->num_of_tasks = 1;
            $statistics->save();
        } else {
            $statistics->increment('num_of_tasks');
        }  */

        // or we can use event and listener

        event(new EventsStatistics($task->assigned_to_id));

        return redirect()->route('index')->with('success', 'Task successfully stored.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
