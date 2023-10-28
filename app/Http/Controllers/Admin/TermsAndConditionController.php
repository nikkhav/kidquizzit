<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermsAndConditionUpdate;
use App\Services\TermsAndConditionService;

use App\Models\TermsAndCondition;

class TermsAndConditionController extends Controller
{
    private $termsandconditionservice;

    public function __construct(TermsAndConditionService $termsandconditionservice)
    {
        $this->termsandconditionservice = $termsandconditionservice;
    }

    public function edit()
    {
        $item = TermsAndCondition::first();
        return view('admin.pages.termsandcondition.edit', compact('item'));
    }

    public function update(TermsAndConditionUpdate $request)
    {
        $data = $request->validated();
        $termsandcondition = TermsAndCondition::find($data['id']);
        $this->termsandconditionservice->updateTermsAndCondition($termsandcondition, $data);

        return redirect()->route('termsandcondition.edit')->with('success', 'Terms and Conditions information has been updated successfully.');
    }

    public function getAll()
    {
        $termsandcondition = TermsAndCondition::all();
        return response()->json($termsandcondition);
    }
}
