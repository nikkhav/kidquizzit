<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfileService
{
    public function updateProfile(User $user, array $data)
    {

        if (isset($data['image'])) {
            $imagePath = $data['image']->store('profile', 'public');
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            $data['image'] = $imagePath;
        }
        $user->update($data);
    }
}
