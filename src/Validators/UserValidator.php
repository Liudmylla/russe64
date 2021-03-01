<?php

namespace App\Validators;

use App\Table\UserTable;



class UserValidator extends AbstractValidator
{

    public function __construct(array $data,UserTable $table, ?int $id = null )
    {
        parent::__construct($data);
        $this->validator->rule('required', ['username', 'password']);
        $this->validator->rule('lengthBetween', ['username', 'password'], 3, 200);
        $this->validator->rule(function($field,$value) use ($table,$id) {
            return !$table->exists($field,$value,$id);
        }, ['slug','name'],'Cette valeur ets deja utilisé');
    
    }       

}
