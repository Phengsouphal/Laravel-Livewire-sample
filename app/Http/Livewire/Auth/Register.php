<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public $email = '';
    public $name = '';
    public $password = '';
    public $passwordConfirmation = '';

    protected $rules = [
        'email' => 'required|email|unique:users',
        'name' => 'required',
        'password' => 'required|min:6|same:passwordConfirmation',
    ];

    public function updatedEmail()
    {
        $this->validate(['email' => 'unique:users']);
    }


    public function register()
    {

        $this->validate();
        User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
        ]);

        return redirect('/');
    }


    public function render()
    {
        return view('livewire.auth.register')->layout('layouts.auth');
    }
}
