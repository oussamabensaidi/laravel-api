<?php 
namespace App\Services;

use App\Repositories\TaskRepositoryInterface;
use App\Models\User;
use App\Events\TaskCreated;
use Illuminate\Support\Facades\Log;  

class TaskService
{
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

 public function create(array $data, User $user)
{
    $task = $this->taskRepository->create($data, $user);

    Log::info('🟢 Created task ID: ' . $task->id);
    event(new TaskCreated($task)); 


    return $task;
}
//    public function create(array $data, User $user)
//     {

//         return $this->taskRepository->create($data, $user);
//     }

    public function get($id, User $user)
    {
        return $this->taskRepository->find($id, $user);
    }

    public function update($id, array $data, User $user)
    {
        return $this->taskRepository->update($id, $data, $user);
    }

    public function delete($id, User $user)
    {
        $this->taskRepository->delete($id, $user);
    }
}

