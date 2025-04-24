<?php

namespace App\Services\Contact;

use LaravelEasyRepository\BaseService;

interface ContactService extends BaseService{

    public function sendContactEmail(array $data);

}
