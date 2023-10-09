<?php

namespace App\Datatable;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(User::class, [
            'id' => 'ID',
            'full_name' => 'Ad və Soyad',
            'email' => 'İmeyl',
            'created_at' => 'Qeydiyyat tarixi'
        ], [
            'actions' => [
                'title' => 'Əməliyyat',
                'view' => 'admin.pages.user.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
                ->with(['roles']);
                
        $query->where('type', 'admin');

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
