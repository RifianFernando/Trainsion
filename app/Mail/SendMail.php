<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
 {
     use Queueable, SerializesModels;

     public $contactData;  // This will hold the validated contact form data.

     /**
      * Create a new message instance.
      *
      * @param array $contactData The validated contact form data.
      */
     public function __construct($contactData)
     {
         $this->contactData = $contactData;

     }

     /**
      * Build the message.
      *
      * @return $this
      */
     public function build(){
         return $this->from($this->contactData['email'])
         ->subject('New Contact Us Email')
         ->view('mail')
         ->with('contactData', $this->contactData);
     }

 }
