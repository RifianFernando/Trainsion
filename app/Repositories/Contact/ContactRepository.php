<?php

namespace App\Repositories\Contact;

use LaravelEasyRepository\Repository;

interface ContactRepository extends Repository{
    public function store(array $data);
}
