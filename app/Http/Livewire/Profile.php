<?php

namespace App\Http\Livewire;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public User $user;

    public $saved = false;
    public $testing = '';
    public $description = '';
    public $count = 0;
    public $upload;

    public $files = [];

    protected $rules = [
        'user.name' => "max:24",
        'user.about' => "max:140",
        'user.birthday' => "sometimes",
        'upload' => "image|max:100"
    ];

    public function mount()
    {

        $this->user = auth()->user();
        // $this->name = auth()->user()->name;
        // $this->about = auth()->user()->about;
        // $this->birthday =  (string)Carbon::createFromTimestamp(auth()->user()->birthday)->format('m/d/y');
    }

    public function updatedNewAvatar()
    {
        $this->validate([
            'upload' => "image|max:100"
        ]);
    }

    public function updated($field)
    {
        if ($field !== 'saved') {
            $this->saved = false;
        }
    }

    public function save()
    {
        $this->validate();

        $this->user->save();

        // $profileData['birthday'] = strtotime($this->birthday);
        $this->upload && $this->user->update([
            'avatar' => $this->upload->store('/', 'avatar')
        ]);


        $this->dispatchBrowserEvent('notify', 'Profile saved!');
        $this->saved = true;
        $this->emitSelf('notify-saved');
    }

    public function render()
    {
        return view('livewire.profile')->layout('layouts.app');
    }
}
