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

    }

    public function destroy($id)
    {

    }
}
