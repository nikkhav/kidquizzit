<?php

namespace App\Datatable;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PersonalDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(User::class, [
            'id' => 'ID',
            'full_name' => 'Ad və Soyad',
            'email' => 'İmeyl Ünvanı',
            'department.name' => 'Departament',
            'position.name' => 'Vəzifə',
        ], [
            'actions' => [
                'title' => 'Əməliyyat',
                'view' => 'admin.pages.personal.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope();
        $query->where('type', 'worker');
        // if (isset($_GET['filters'])) {
        //     $filters = $_GET['filters'];
        //     foreach ($filters as $filter) {
        //         $filter = explode('--', $filter);
        //         $query->where($filter[0], $filter[1]);
        //     }
        // }

        if ($this->getSearchInput()) {
            $query->where('name', 'LIKE', '%' . $this->getSearchInput() . '%')
                  ->orWhere('surname', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
