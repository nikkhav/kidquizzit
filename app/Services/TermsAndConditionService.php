<?php

namespace App\Services;

use App\Models\TermsAndCondition;

class TermsAndConditionService
{
    public function updateTermsAndCondition(TermsAndCondition $termsandcondition, array $data)
    {
        $termsandcondition->update($data);
    }
}
