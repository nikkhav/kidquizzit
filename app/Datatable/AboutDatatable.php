<?php

namespace App\Datatable;

use App\Models\About;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class AboutDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(About::class, [
            'id' => 'ID',
            'title' => 'Title',
            'subtitle' => 'Subtitle',
            'description' => 'Description',
            'image' => 'Image',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.about.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope();
        // if (Auth::user()->type == 'worker') {
        //     $query->where('user_id',auth()->user()->id);
        // }

        if ($this->getSearchInput()) {
            $query->where('name', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
