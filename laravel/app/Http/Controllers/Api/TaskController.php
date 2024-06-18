<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();

        return response()->json([
            'success' => true,
            'code' => 200,
            'tasks' => $tasks,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $data = $request->validated();

        try {
            $newTask = Task::create($data);

            return response()->json([
                'success' => true,
                'code' => 200,
                'task' => $newTask,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'code' => 200,
            'task' => $task,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, string $id)
    {
        $data = $request->validated();

        try {
            $task = Task::where('id', $id)->first();

            $task->update($data);

            return response()->json([
                'success' => true,
                'code' => 200,
                'task' => $task,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $task = Task::where('id', $id)->first();

            $task->delete();

            return response()->json([
                'success' => true,
                'code' => 200,
                'task' => $task,
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ]);
        }
    }
}
