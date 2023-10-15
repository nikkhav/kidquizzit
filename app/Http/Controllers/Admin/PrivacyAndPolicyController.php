<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrivacyAndPolicyUpdate;
use App\Services\PrivacyAndPolicyService;

use App\Models\PrivacyAndPolicy;

class PrivacyAndPolicyController extends Controller
{
    private $privacyandpolicyservice;

    public function __construct(PrivacyAndPolicyService $privacyandpolicyservice)
    {
        $this->privacyandpolicyservice = $privacyandpolicyservice;
    }

    public function edit()
    {
        $item = PrivacyAndPolicy::first();
        return view('admin.pages.privacyandpolicy.edit', compact('item'));
    }

    public function update(PrivacyAndPolicyUpdate $request)
    {
        $data = $request->validated();
        $privacyandpolicy = PrivacyAndPolicy::first();
        $this->privacyandpolicyservice->updatePrivacyAndPolicy($privacyandpolicy, $data);

        return redirect()->route('privacyandpolicy.edit')->with('success', 'Privacy and Policy information has been updated successfully.');
    }

    public function getAll()
    {
        $privacyandpolicy = PrivacyAndPolicy::all();
        return response()->json($privacyandpolicy);
    }
}
