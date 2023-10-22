<?php

namespace App\Services;

use App\Models\Difference;
use Illuminate\Support\Facades\Storage;

class DifferenceService
{
    public function createDifference($data)
    {
        if (isset($data['image1']) && $data['image1']->isValid()) {
            $imagePath = $data['image1']->store('difference', 'public');
            $data['image1'] = $imagePath;
        }
        if (isset($data['image2']) && $data['image2']->isValid()) {
            $imagePath = $data['image2']->store('difference', 'public');
            $data['image2'] = $imagePath;
        }

        $difference = Difference::create($data);

        return $difference;
    }

    public function getDifferenceById($id)
    {
        return Difference::find($id);
    }

    public function updateDifference($id, $data)
    {
        if (isset($data['image1'])) {
            // Upload the new image and get its path
            $imagePath = $data['image1']->store('difference', 'public');

            // Delete the old image if it exists
            $oldDifference = Difference::find($id);
            if ($oldDifference->image && Storage::disk('public')->exists($oldDifference->image)) {
                Storage::disk('public')->delete($oldDifference->image);
            }

            // Update the data array with the new image path
            $data['image1'] = $imagePath;
        }

        if (isset($data['image2'])) {
            // Upload the new image and get its path
            $imagePath = $data['image2']->store('difference', 'public');

            // Delete the old image if it exists
            $oldDifference = Difference::find($id);
            if ($oldDifference->image && Storage::disk('public')->exists($oldDifference->image)) {
                Storage::disk('public')->delete($oldDifference->image);
            }

            // Update the data array with the new image path
            $data['image2'] = $imagePath;
        }

        // Update the Difference record with the updated data
        Difference::where('id', $id)->update($data);
    }

    public function deleteDifference($id)
    {
        $difference = Difference::find($id);

        if ($difference) {
            // Delete the associated image file if it exists
            if ($difference->image1 && Storage::disk('public')->exists($difference->image1)) {
                Storage::disk('public')->delete($difference->image1);
            }
            if ($difference->image2 && Storage::disk('public')->exists($difference->image2)) {
                Storage::disk('public')->delete($difference->image2);
            }
            // Delete the Difference record from the database
            $difference->delete();
        }
    }
}
