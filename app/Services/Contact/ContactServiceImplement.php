<?php

namespace App\Services\Contact;

use LaravelEasyRepository\ServiceApi;
use App\Repositories\Contact\ContactRepository;
use App\Models\UserMessage;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;


class ContactServiceImplement extends ServiceApi implements ContactService {

  protected $contactRepository;

  public function __construct(ContactRepository $contactRepository) {
      $this->contactRepository = $contactRepository;
  }

  public function sendContactEmail(array $data) {
      $this->contactRepository->store($data);
      Mail::to(env('MAIL_FROM_ADDRESS'))->send(new SendMail($data));
  }
}