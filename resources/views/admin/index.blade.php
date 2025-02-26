@extends('admin.layouts.main')

@section('heading_title', 'Kidquizzit Admin Panel')

@section('content')
    <div class="row mb-3 pb-1">
        <div class="col-12">
            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-16 mb-1">Hello, {{ Auth::user()->name }}</h4>
                    <p class="text-muted mb-0">Create children's entertainment content with Kidquizzit Admin Panel</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xxl-12">
            <div class="d-flex flex-column h-100">
                <div class="row">
                    @php
                        $categories = [
                            'category' => ['label' => 'Categories', 'count' => $counts['category_count'], 'route' => 'category.index'],
                            'quiz' => ['label' => 'Quizes', 'count' => $counts['quiz_count'], 'route' => 'quiz.index'],
                            'colouring' => ['label' => 'Colourings', 'count' => $counts['colouring_count'], 'route' => 'colouring.index'],
                            'whyquestion' => ['label' => 'Why Questions', 'count' => $counts['whyquestion_count'], 'route' => 'whyquestion.index'],
                            'tales' => ['label' => 'Tales', 'count' => $counts['tales_count'], 'route' => 'tale.index'],
                            'games' => ['label' => 'Games', 'count' => $counts['games_count'], 'route' => 'game.index'],
                            'tours' => ['label' => 'Tours', 'count' => $counts['tours_count'], 'route' => 'tour.index'],
                            'artsandcrafts' => ['label' => 'Arts and Crafts', 'count' => $counts['artsandcrafts_count'], 'route' => 'arts_and_crafts.index']
                        ];
                    @endphp
                    @foreach ($categories as $key => $category)
                        <div class="col-md-6 col-xl-3">
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <p class="fw-medium font-size-department text-muted mb-0">{{ $category['label'] }}</p>
                                            <h2 class="mt-3 mb-0 ff-secondary fw-semibold">
                                                <span class="counter-value" data-target="{{ $category['count'] }}">0</span>
                                            </h2>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route($category['route']) }}" class="text-decoration-un">All {{ $category['label'] }}</a>
                                        <div class="avatar-sm flex-shrink-0">
                                            <span class="avatar-title bg-soft-info border-icon-department fs-2">
                                                <i data-feather="external-link" class="text-info"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
