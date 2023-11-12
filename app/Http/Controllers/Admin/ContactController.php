<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactStore;
use App\Models\Contact;
use App\Services\ContactService;

class ContactController extends Controller
{
    private $contactService;

    public function __construct(ContactService $contactService)
    {
        $this->middleware('auth', ['except' => ['store']]);
        $this->contactService = $contactService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.pages.contact.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactStore $request)
    {
        try {
            $validatedData = $request->validated();
            $contact = $this->contactService->createContact($validatedData);

            return response()->json([
                'code' => 201,
                'item' => $contact,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed to store contact.',
                'errors' => $e->getMessage(),
            ], 400);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->contactService->getContactById($id);
        $view = view('admin.pages.contact.detail', compact('item'))->render();
        return response()->json([
            'code' => 200,
            'view' => $view,
        ]);
    }
    public function status($id)
    {
        $item = Contact::find($id);

        if ($item) {
            $item->update([
                'read' => 1
            ]);
            $view = view('admin.pages.contact.detail', compact('item'))->render();
            return response()->json([
                'code' => 200,
                'view' => $view,
            ]);
        } else {
            return response()->json([
                'code' => 404,
                'message' => 'Contact not found'
            ]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete the category
        $this->contactService->deleteContact($id);

        return response()->json([
            'code' => 200,
        ]);
    }
}
