<?php

namespace App\Services;

use App\Models\Tale;
use Illuminate\Support\Facades\Storage;

class TaleService
{
    public function createTale($data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('tale', 'public');
            $data['image'] = $imagePath;
        }

        $tale = Tale::create($data);

        return $tale;
    }

    public function getTaleById($id)
    {
        return Tale::find($id);
    }

    public function updateTale($id, $data)
    {
        if (isset($data['image'])) {
            // Upload the new image and get its path
            $imagePath = $data['image']->store('tale', 'public');

            // Delete the old image if it exists
            $oldTale = Tale::find($id);
            if ($oldTale->image && Storage::disk('public')->exists($oldTale->image)) {
                Storage::disk('public')->delete($oldTale->image);
            }

            // Update the data array with the new image path
            $data['image'] = $imagePath;
        }

        // Update the Why Question record with the updated data
        Tale::where('id', $id)->update($data);
    }

    public function deleteTale($id)
    {
        $tale = Tale::find($id);

        if ($tale) {
            // Delete the associated image file if it exists
            if ($tale->image && Storage::disk('public')->exists($tale->image)) {
                Storage::disk('public')->delete($tale->image);
            }

            // Delete the Why Question record from the database
            $tale->delete();
        }
    }
}
