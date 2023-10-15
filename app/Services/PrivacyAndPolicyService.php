<?php

namespace App\Services;

use App\Models\PrivacyAndPolicy;

class PrivacyAndPolicyService
{
    public function updatePrivacyAndPolicy(PrivacyAndPolicy $privacyandpolicy, array $data)
    {
        $privacyandpolicy->update($data);
    }
}
