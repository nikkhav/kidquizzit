<?php

namespace App\Datatable;

use App\Models\Tale;
use Illuminate\Database\Eloquent\Builder;

class TaleDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Tale::class, [
            'id' => '№',
            'category_title' => 'Category',
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created at',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.tale.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'tales.category_id', '=', 'categories.id')
            ->select('tales.*', 'categories.title as category_title')
            ->where('categories.parent_id', 35)
            ->orderBy('created_at', 'asc');

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('tales.title', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
