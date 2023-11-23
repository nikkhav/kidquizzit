<?php

namespace App\Datatable;

use App\Models\Difference;
use Illuminate\Database\Eloquent\Builder;

class DifferenceDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Difference::class, [
            'id' => '№',
            'category_title' => 'Category',
            'image1' => 'Image1',
            'image2' => 'Image2',
            'title' => 'Title',
            'description' => 'Description',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.difference.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'differences.category_id', '=', 'categories.id')
            ->select('differences.*', 'categories.title as category_title')
            ->where('categories.parent_id', 4)
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
