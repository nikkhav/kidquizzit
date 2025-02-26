<?php

namespace App\Datatable;

use App\Models\ArtsAndCraft;
use Illuminate\Database\Eloquent\Builder;

class ArtsAndCraftsDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(ArtsAndCraft::class, [
            'id'             => '№',
            'category_title' => 'Category',
            'image'          => 'Image',
            'title'          => 'Title',
            'description'    => 'Description',
            'created_at'     => 'Created at',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view'  => 'admin.pages.arts_and_crafts.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'arts_and_crafts.category_id', '=', 'categories.id')
            ->select('arts_and_crafts.*', 'categories.title as category_title')
            ->where('categories.parent_id', 58)
            ->orderBy('created_at', 'asc');

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('arts_and_crafts.title', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
