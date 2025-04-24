<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Contact\ContactService;


class ContactUsController extends Controller
{
    protected $contactService;

    public function __construct(ContactService $contactService) {
        $this->contactService = $contactService;
    }

    public function sendContactEmail(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:5',
            'message' => 'required',
        ]);

        $this->contactService->sendContactEmail($validatedData);

        return response()->json([
            'message' => 'Email sent successfully'
        ]);
    }

}
