<?php

namespace App\Datatable;

use App\Models\CustomerType;
use Illuminate\Database\Eloquent\Builder;

class CustomerTypeDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(CustomerType::class, [
            'id' => 'ID',
            'name' => 'Müştəri növü',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.customer_type.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope();
        if ($this->getSearchInput()) {
            $query->where('name', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
