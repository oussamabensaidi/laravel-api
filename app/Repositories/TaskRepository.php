<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class TaskRepository implements TaskRepositoryInterface {
    public function all() {
        return Auth::user()->tasks;
    }

    public function find($id) {
        return Auth::user()->tasks()->findOrFail($id);
    }

    public function create(array $data) {
        return Auth::user()->tasks()->create($data);
    }

    public function update($id, array $data) {
        $task = $this->find($id);
        $task->update($data);
        return $task;
    }

    public function delete($id) {
        $task = $this->find($id);
        $task->delete();
    }
}
