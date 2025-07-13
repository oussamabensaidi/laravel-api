<?php 
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserService
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'prenom' => $data['prenom'],
            'email'     => $data['email'],
            'phone'     => $data['phone'],
            // 'address'   => $data['address'],
            //image here 
            'password'  => Hash::make($data['password']),
        ]);
    }
}
