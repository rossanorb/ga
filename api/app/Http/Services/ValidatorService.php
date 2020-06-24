<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use \App\Student;

class ValidatorService {

    private $errors;

    private function setError($errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function fails($request, $action)
    {
        $rules = [];

        switch($action){
            case 'store' :
                $student = Student::where('cpf', $request['cpf'])->first();
                if($student instanceof Student){
                    $this->setError(['cpf' => 'CPF já existe']);
                    return true;
                }
                $rules = [
                    'name' => 'required',
                    'email' => 'required',
                    'ra' =>   "required",
                    'cpf' => 'required',
                ];
                break;
            case 'update' :
                break;
        }

        $validator = \Validator::make($request, $rules );

        if ($validator->fails()) {
            $this->setError($validator->errors());
            return true;
        }

        return false;
    }

}