<?php
namespace App\Repositories;
use App\Models\User;

interface TaskRepositoryInterface {
       public function all(User $user);
    public function find($id, User $user);
    public function create(array $data, User $user);
    public function update($id, array $data, User $user);
    public function delete($id, User $user);
}