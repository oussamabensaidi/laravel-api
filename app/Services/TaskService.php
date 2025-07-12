<?php 
namespace App\Services;

use App\Repositories\TaskRepositoryInterface;

class TaskService {
    protected $taskRepo;

    public function __construct(TaskRepositoryInterface $taskRepo) {
        $this->taskRepo = $taskRepo;
    }

    public function getAll() {
        return $this->taskRepo->all();
    }

    public function create(array $data) {
        return $this->taskRepo->create($data);
    }

    public function update($id, array $data) {
        return $this->taskRepo->update($id, $data);
    }

    public function delete($id) {
        return $this->taskRepo->delete($id);
    }
}
