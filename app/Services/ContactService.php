<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function createContact($data)
    {
        $contact = Contact::create($data);
        return $contact;
    }


    public function deleteContact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
    }
}
