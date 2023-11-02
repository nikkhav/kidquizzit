<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AboutUpdate;
use App\Services\AboutService;
use App\Models\About;

class AboutController extends Controller
{
    private $aboutService;

    public function __construct(AboutService $aboutService)
    {
        $this->aboutService = $aboutService;
    }

    public function edit()
    {
        $item = About::firstOrFail();
        return view('admin.pages.about.edit', compact('item'));
    }

    public function update(AboutUpdate $request)
    {
        $about = About::find($request['id']);
        $this->aboutService->updateAbout($about, $request);
        return redirect()->route('about.edit')->with('success', 'About information has been updated successfully.');
    }

    public function getAll()
    {
        $about = About::all();
        return response()->json($about);
    }
}
