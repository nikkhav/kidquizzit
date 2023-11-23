<?php

namespace App\Datatable;

use App\Models\Colouring;
use Illuminate\Database\Eloquent\Builder;

class ColouringDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Colouring::class, [
            'id' => '№',
            'category_title' => 'Category',
            'title' => 'Title',
            'image' => 'Image',
            'created_at' => 'Created at',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.colouring.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'colourings.category_id', '=', 'categories.id')
            ->select('colourings.*', 'categories.title as category_title')
            ->where('categories.parent_id', 2)
            ->orderBy('created_at', 'asc');

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('categories.title', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }



    protected function format(): array
    {
        // Custom formatting for specific columns (if necessary)
        return [
            'image' => function ($value, $row) {
                return '<img src="' . asset('storage/' . '/'  . $value) . '" alt="Image" width="50" height="50">';
            }
        ];
    }
}
