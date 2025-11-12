<?php

namespace App\Services;

use App\Models\Contact;

class ContactService
{
    public function createContact($contact): Contact
    {
        return Contact::create($contact);
    }

    public function updateContact(Contact $contact, array $data): Contact
    {
        $contact->update($data);
        return $contact;
    }
}
