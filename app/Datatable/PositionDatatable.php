<?php

namespace App\Datatable;

use App\Models\Position;
use Illuminate\Database\Eloquent\Builder;

class PositionDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Position::class, [
            'id' => 'ID',
            'name' => 'Vəzifə',
            'created_at' => 'Yaradılma tarixi'
        ], [
            'actions' => [
                'title' => 'Əməliyyat',
                'view' => 'admin.pages.position.table_actions'
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
            $query->where('name', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
