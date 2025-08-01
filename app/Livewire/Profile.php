<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    #[Validate('nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120')] 
    public $newAvatar = "";

    #[Validate('required|string|max:255')] 
    public $name = "";

    #[Validate('required|numeric')] 
    public $phone = "";
    
    #[Validate('required|string')] 
    public $address = "";

    public $avatar;
    public $user;

    public function mount(){
        $this->user = Auth::user();
        $this->setUser($this->user);
    }

    public function setUser(User $user){
        $this->avatar = $user->avatar;
        $this->name = $user->name;
        $this->phone = $user->phone;
        $this->address = $user->address;
    }

    public function update()
    {
        $validated = $this->validate();
        $user = $this->user;

        if ($this->newAvatar) {
            if ($user->avatar) {
                Storage::disk(config('filesystems.default_public_disk'))->delete(str_replace('storage/', '', $user->avatar));
                logger('Deleting old avatar: ' . str_replace('storage/', '', $user->avatar));
            }
            $validated['avatar'] = 'storage/'.$this->newAvatar->store('user-images', config('filesystems.default_public_disk'));
            // $this->avatar = $validated['avatar'];
            // $this->newAvatar = null;
        }
        $user->update($validated);
        
        $this->dispatch('success', 'Profil berhasil diperbarui.');
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
