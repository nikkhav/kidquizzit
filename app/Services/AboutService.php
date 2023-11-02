<?php

namespace App\Services;

use App\Models\About;
use Illuminate\Support\Facades\Storage;

class AboutService
{
    public function updateAbout(About $about, $data)
    {

        if (isset($data['image'])) {
            $imagePath = $data['image']->store('about', 'public');
            if ($about->image && Storage::disk('public')->exists($about->image)) {
                Storage::disk('public')->delete($about->image);
            }

            $data['image'] = $imagePath;
        }
        $about->update($data);
    }
}
