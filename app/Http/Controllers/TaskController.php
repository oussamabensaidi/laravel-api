<?php

namespace App\Http\Controllers;
use App\Services\TaskService;
use App\Events\TaskCreated;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class TaskController extends Controller
{
    protected $taskService;
    
    public function __construct(TaskService $taskService) {
        // $this->middleware('jwt.verify');  
        $this->taskService = $taskService;
    }

    public function index()
{
    // The user is already authenticated by `auth:api` middleware
    $user = auth()->user(); // Instead of JWTAuth::parseToken()
    return response()->json($user->tasks);
}

 public function store(Request $request) {
    $user = JWTAuth::parseToken()->authenticate();

    $task = $this->taskService->create($request->all(), $user);

    // broadcast(new TaskCreated($task))->toOthers();

    return response()->json($task);
}

public function show($id) {
    $user = JWTAuth::parseToken()->authenticate();

    return response()->json($this->taskService->get($id, $user));
}

public function update(Request $request, $id) {
    $user = JWTAuth::parseToken()->authenticate();

    $validated = $request->validate([
        'titre' => 'sometimes|string|max:255',
        'description' => 'sometimes|string|nullable',
        'terminer' => 'sometimes|boolean',
    ]);
 
    $updatedTask = $this->taskService->update($id, $validated, $user);

    return response()->json(['data' => $updatedTask]);
}


public function destroy($id) {
    $user = JWTAuth::parseToken()->authenticate();

    $this->taskService->delete($id, $user);

    return response()->json(['message' => 'Supprimée']);
}

}
