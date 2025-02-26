<?php

namespace App\Services;

use App\Models\ArtsAndCraft;
use Illuminate\Support\Facades\Storage;

class ArtsAndCraftService
{
    public function createArtsAndCraft($data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('arts_and_crafts', 'public');
            $data['image'] = $imagePath;
        }
        return ArtsAndCraft::create($data);
    }

    public function getArtsAndCraftById($id)
    {
        return ArtsAndCraft::find($id);
    }

    public function updateArtsAndCraft($id, $data)
    {
        if (isset($data['image'])) {
            $imagePath = $data['image']->store('arts_and_crafts', 'public');
            $oldItem = ArtsAndCraft::find($id);
            if ($oldItem->image && Storage::disk('public')->exists($oldItem->image)) {
                Storage::disk('public')->delete($oldItem->image);
            }
            $data['image'] = $imagePath;
        }
        ArtsAndCraft::where('id', $id)->update($data);
    }

    public function deleteArtsAndCraft($id)
    {
        $item = ArtsAndCraft::find($id);
        if ($item) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
        }
    }
}
