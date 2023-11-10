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
        $data = $request->validated();
        $about = About::find($data['id']);
        $this->aboutService->updateAbout($about, $data);
        return redirect()->route('about.edit')->with('success', 'About information has been updated successfully.');
    }
    public function getAll()
    {
        $about = About::all();

        $about = $about->map(function ($item) {
            $item->image = config('app.url') . '/storage/' . $item->image;
            return $item;
        });

        $about = $about->makeHidden(['created_at', 'updated_at']);

        return response()->json($about);
    }
}
