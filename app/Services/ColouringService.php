<?php

namespace App\Services;

use App\Models\Colouring;
use Illuminate\Support\Facades\Storage;

class ColouringService
{
    public function createColouring($data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('colouring', 'public');
            $data['image'] = $imagePath;
        }

        $colouring = Colouring::create($data);

        return $colouring;
    }

    public function getColouringById($id)
    {
        return Colouring::find($id);
    }

    public function updateColouring($id, $data)
    {
        if (isset($data['image'])) {
            // Upload the new image and get its path
            $imagePath = $data['image']->store('colouring', 'public');

            // Delete the old image if it exists
            $oldColouring = Colouring::find($id);
            if ($oldColouring->image && Storage::disk('public')->exists($oldColouring->image)) {
                Storage::disk('public')->delete($oldColouring->image);
            }

            // Update the data array with the new image path
            $data['image'] = $imagePath;
        }

        // Update the Colouring record with the updated data
        Colouring::where('id', $id)->update($data);
    }

    public function deleteColouring($id)
    {
        $colouring = Colouring::find($id);

        if ($colouring) {
            // Delete the associated image file if it exists
            if ($colouring->image && Storage::disk('public')->exists($colouring->image)) {
                Storage::disk('public')->delete($colouring->image);
            }

            // Delete the Colouring record from the database
            $colouring->delete();
        }
    }
}
