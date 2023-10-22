<?php

namespace App\Services;

use App\Models\WhyQuestion;
use Illuminate\Support\Facades\Storage;

class WhyQuestionService
{
    public function createWhyQuestion($data)
    {
        if (isset($data['image']) && $data['image']->isValid()) {
            $imagePath = $data['image']->store('whyquestion', 'public');
            $data['image'] = $imagePath;
        }

        $whyquestion = WhyQuestion::create($data);

        return $whyquestion;
    }

    public function getWhyQuestionById($id)
    {
        return WhyQuestion::find($id);
    }

    public function updateWhyQuestion($id, $data)
    {
        if (isset($data['image'])) {
            // Upload the new image and get its path
            $imagePath = $data['image']->store('whyquestion', 'public');

            // Delete the old image if it exists
            $oldWhyQuestion = WhyQuestion::find($id);
            if ($oldWhyQuestion->image && Storage::disk('public')->exists($oldWhyQuestion->image)) {
                Storage::disk('public')->delete($oldWhyQuestion->image);
            }

            // Update the data array with the new image path
            $data['image'] = $imagePath;
        }

        // Update the Why Question record with the updated data
        WhyQuestion::where('id', $id)->update($data);
    }

    public function deleteWhyQuestion($id)
    {
        $whyquestion = WhyQuestion::find($id);

        if ($whyquestion) {
            // Delete the associated image file if it exists
            if ($whyquestion->image && Storage::disk('public')->exists($whyquestion->image)) {
                Storage::disk('public')->delete($whyquestion->image);
            }

            // Delete the Why Question record from the database
            $whyquestion->delete();
        }
    }
}
