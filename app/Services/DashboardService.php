<?php

namespace App\Services;

use App\Models\Quiz;
use App\Models\Colouring;
use App\Models\Difference;
use App\Models\WhyQuestion;

class DashboardService
{
    public function getCounts()
    {
        $counts = [
            'quiz_count' => Quiz::count(),
            'colouring_count' => Colouring::count(),
            'difference_count' => Difference::count(),
            'whyquestion_count' => WhyQuestion::count(),
        ];

        return $counts;
    }
}
