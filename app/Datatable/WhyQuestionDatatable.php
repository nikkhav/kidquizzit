<?php

namespace App\Datatable;

use App\Models\WhyQuestion;
use Illuminate\Database\Eloquent\Builder;

class WhyQuestionDatatable extends BaseDatatable
{

    public function __construct()
    {
        parent::__construct(WhyQuestion::class, [
            'id' => '№',
            'category_title' => 'Category',
            'image' => 'Image',
            'title' => 'Title',
            'description' => 'Description',
            'created_at' => 'Created at',
            'updated_at' => 'Updated at'
        ], [
            'actions' => [
                'title' => 'Actions',
                'view' => 'admin.pages.whyquestion.table_actions'
            ]
        ]);
    }

    protected function query(): Builder
    {
        $query = $this->baseQueryScope()
            ->leftJoin('categories', 'why_questions.category_id', '=', 'categories.id')
            ->select('why_questions.*', 'categories.title as category_title')
            ->where('categories.parent_id', 3)
            ->orderBy('created_at', 'asc');

        if (isset($_GET['filters'])) {
            $filters = $_GET['filters'];
            foreach ($filters as $filter) {
                $filter = explode('--', $filter);
                $query->where($filter[0], $filter[1]);
            }
        }

        if ($this->getSearchInput()) {
            $query->where('categories.title', 'LIKE', '%' . $this->getSearchInput() . '%');
        }

        return $query;
    }



    protected function format(): array
    {
        // Custom formatting for specific columns (if necessary)
        return [
            'image' => function ($value, $row) {
                return '<img src="' . asset('storage/' . '/'  . $value) . '" alt="Image" width="50" height="50">';
            }
        ];
    }
}
