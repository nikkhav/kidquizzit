<?php

namespace App\Datatable;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class CustomerDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Customer::class, [
            'id' => 'ID',
            'customer_number' => 'Müştəri Nömrəsi',
            'fullname' => 'Müştəri',
            'voen' => 'VÖEN',
            'phone' => 'Telefon',
            'email' => 'İmeyl Ünvanı',
        ], [
            
            'status' => [
                'title' => 'Status',
                'view' => 'admin.inc.status_toggle'
            ],
            'actions' => [
                'title' => 'Əməliyyatlar',
                'view' => 'admin.pages.customer.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope();
        // if (Auth::user()->type == 'worker') {
        //     $query->where('user_id',auth()->user()->id);
        // }

        if ($this->getSearchInput()) {
            $query->where('name', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }
}
