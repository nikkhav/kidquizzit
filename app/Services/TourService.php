<?php

namespace App\Services;

use App\Models\Tour;
use Illuminate\Support\Facades\Storage;

class TourService
{
    public function createTour($data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('tour', 'public');
            $data['image'] = $imagePath;
        }

        $tour = Tour::create($data);

        return $tour;
    }

    public function getTourById($id)
    {
        return Tour::find($id);
    }

    public function updateTour($id, $data)
    {
        $tour = Tour::find($id);

        if (isset($data['image'])) {
            $imagePath = $data['image']->store('tour', 'public');

            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }

            $data['image'] = $imagePath;
        }

        Tour::where('id', $id)->update($data);
    }

    public function deleteTour($id)
    {
        $tour = Tour::find($id);

        if ($tour) {
            if ($tour->image && Storage::disk('public')->exists($tour->image)) {
                Storage::disk('public')->delete($tour->image);
            }

            $tour->delete();
        }
    }
}
