<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Task;

class TaskRepository implements TaskRepositoryInterface 
{
    public function all(User $user) 
    {
        return $user->tasks;
    }

    public function find($id, User $user) 
    {
        return $user->tasks()->findOrFail($id);
    }

    public function create(array $data, User $user) 
    {
        return $user->tasks()->create($data);
    }

    public function update($id, array $data, User $user) 
    {
        $task = $this->find($id, $user);
        $task->update($data);
        return $task;
    }

    public function delete($id, User $user) 
    {
        $task = $this->find($id, $user);
        $task->delete();
    }
}
