<?php

namespace App\Datatable;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Builder;

class TourDatatable extends BaseDatatable
{
    public function __construct()
    {
        parent::__construct(Tour::class, [
            'id' => '№',
            'category_title' => 'Category',
            'city_name' => 'City',
            'country_name' => 'Country',
            'image' => 'Image',
            'title' => 'Title',
            'description1' => 'Description 1',
            'description2' => 'Description 2',
            'created_at' => 'Created at',
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.tour.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'tours.category_id', '=', 'categories.id')
            ->leftJoin('cities', 'tours.city_id', '=', 'cities.id')
            ->leftJoin('countries', 'cities.country_id', '=', 'countries.id')
            ->select('tours.*', 'categories.title as category_title', 'cities.name as city_name', 'countries.name as country_name');


        $parent_id = 52;
        $query->where('categories.parent_id', $parent_id);

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('tours.title', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query->orderBy('created_at', 'asc');
    }
}
