<?php

namespace App\Repositories\Contact;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\UserMessage;
use App\Repositories\Contact\ContactRepository;

class ContactRepositoryImplement extends Eloquent implements ContactRepository{

    protected $model;

    public function __construct(UserMessage $model) {
        $this->model = $model;
    }

    public function store(array $data) {
        return $this->model->create($data);
    }
}
