<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    public function index()
    {

    }

    public function store(Request $request)
    {
        $request = $request->all();

        try {
            $this->response['result'] = Student::create($request);
            $this->response['status'] = true;
            return $this->response(201);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            array_push($this->response['errors'], [
                'message' => '( ＾皿＾)っ Something went wrong!',
                'description' => $e->getMessage()
            ]);
            return $this->response(500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::find($id);
            if(!$student instanceof Student){
                return $this->response(404);
            }

            $inputs = $request->only(['name', 'email']);
            $student->update($inputs);
            $this->response['status'] = true;
            $this->response['result'] = $student;

            return $this->response(201);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            array_push($this->response['errors'], [
                'message' => 'Something went wrong!',
                'description' => $e->getMessage()
            ]);
            return $this->response(500);
        }
    }

    public function destroy($id)
    {

    }
}
