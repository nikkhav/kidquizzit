<?php

namespace App\Datatable;

use App\Models\Batch\Batch;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Category;

class CategoryDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Category::class, [
            'id' => '№',
            'parent_title' => 'Parent',
            'title' => 'Title',
            'created_at' => 'Created at',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.category.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope();

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

        // Modify the SELECT statement to display "Main" for null parent_id
        $query->select([
            'categories.id',
            'categories.title',
            'categories.parent_id',
            \DB::raw('IFNULL(parent_categories.title, "Main") as parent_title'),
            'categories.created_at'
        ])
            ->leftJoin('categories as parent_categories', 'categories.parent_id', '=', 'parent_categories.id')
            ->orderBy('categories.id', 'asc');


        return $query;
    }
}
