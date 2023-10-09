<?php

namespace App\Datatable;

use App\Models\Department;
use Illuminate\Database\Eloquent\Builder;

class DepartamentDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Department::class, [
            'id' => 'ID',
            'name' => 'Department adı',
        ], [
            'actions' => [
                'title' => 'Əməliyyat',
                'view' => 'admin.pages.department.table_actions'
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
            $query->where('test', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
