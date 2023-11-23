<?php

namespace App\Datatable;

use App\Models\Game;
use Illuminate\Database\Eloquent\Builder;

class GameDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Game::class, [
            'id' => '№',
            'category_title' => 'Category',
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created at',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.game.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'games.category_id', '=', 'categories.id')
            ->select('games.*', 'categories.title as category_title')
            ->where('categories.parent_id', 41)
            ->orderBy('created_at', 'asc');

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('games.title', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
