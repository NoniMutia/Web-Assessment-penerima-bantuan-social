<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Login extends Component
{
    #[Layout('components.layouts.auth')]
    #[Title('Auth')]

    public $email;
    public $password;
    public function render()
    {
        return view('livewire.auth.login');
    }

    /** LOGIN SECTION */
    public function login()
    {
        $this->validate(
            rules:[
                'email' => 'required|email',
                'password' => 'required'
            ],
            messages: [
                'email.required' => 'Email is required',
                'email.email' => 'Email is not valid',
                'password.required' => 'Password is required'
            ]
        );
        $data_check = [
          'email' => $this->email,
          'password' => $this->password
        ];
        if (Auth::attempt(credentials:$data_check)) {
            return redirect()->route('dashboard');
        }else{
            return session()->flash('error', 'Email or Password is incorrect');
        }
    }
    
}
