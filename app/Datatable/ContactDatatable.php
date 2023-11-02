<?php

namespace App\Datatable;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Builder;

class ContactDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(Contact::class, [
            'id' => '№',
            'name' => 'Name',
            'surname' => 'Surname',
            'email' => 'Email',
            'phone' => 'Phone',
            'read_status' => 'Read/Unread',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.contact.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->select(
                'contacts.id',
                'contacts.name',
                'contacts.surname',
                'contacts.email',
                'contacts.phone',
                'contacts.read',
                \DB::raw('CASE WHEN contacts.read = 0 THEN "Unread" ELSE "Read" END as read_status')
            )
            ->orderBy('id', 'asc');
        if ($this->getSearchInput()) {
            $searchTerm = $this->getSearchInput();
            $query->where(function ($query) use ($searchTerm) {
                $query->where('name', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('surname', 'LIKE', '%' . $searchTerm . '%');
            });
        }
        return $query;
    }
}
