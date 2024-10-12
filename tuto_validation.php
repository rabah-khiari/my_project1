
validator using request manager 
    on terminal : php artisan make:request BlogFilterRequest 
    will be created under /App/http/Resquests/BlogFilterRequest.php

    one th  rules() function 
    add :
        return [
            'title'=> ['required','min:4']
        ];

validation in the controller is: 

<?php
use Illuminate\Support\Facades\Validator;

        $Validator= Validator::make([
            'titre'=>'eaaee'
        ],[
            'titre'=>'required|min:5|max:12'
        ]);
        dd($Validator->errors()); #if any error it return the error
        dd($Validator->validated());# if there is invalide input , u will redirect to the precedent page 