<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdate;
use App\Models\User;
use App\Services\ProfileService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    private $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function edit()
    {
        $item = Auth::user();
        return view('admin.pages.profil.edit', compact('item'));
    }

    public  function update(ProfileUpdate $request)
    {
        $data = $request->validated();
        $user = User::find(Auth::user()->id);
        $this->profileService->updateProfile($user, $data);
        return redirect()->route('profile.edit')->with('success', 'Profile information has been updated successfully.');
    }
}
