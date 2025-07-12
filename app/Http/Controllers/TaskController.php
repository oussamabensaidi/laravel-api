<?php

namespace App\Http\Controllers;
use App\Services\TaskService;
use App\Events\TaskCreated;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    protected $taskService;
    public function __construct(TaskService $taskService) {
        $this->middleware('jwt.verify');
        $this->taskService = $taskService;
    }

    public function index() {
        return $this->taskService->getAll();
    }

    public function store(Request $request) {
        $task = $this->taskService->create($request->all());
        broadcast(new TaskCreated($task))->toOthers();
        return $task;
    }

    public function show($id) {
        return $this->taskService->get($id);
    }

    public function update(Request $request, $id) {
        return $this->taskService->update($id, $request->all());
    }

    public function destroy($id) {
        $this->taskService->delete($id);
        return response()->json(['message' => 'Supprimée']);
    }
}
