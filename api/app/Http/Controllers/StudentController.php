<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    private $order = ['name', 'email'];
    private $by = ['asc', 'desc'];

    public function index(Request $request)
    {
        $request = $request->all();

        $order = $request['order'] ?? 'id';
        $by = $request['by'] ?? 'asc';
        $like = $request['like'] ?? null;
        $limit = $request['limit'] ?? 100;

        if(!\in_array( $order, $this->order)){
            $order = 'id';
        }

        if(!\in_array( $by, $this->by)){
            $by = 'asc';
        }

        if($like){
            $like = '%'.$like.'%';
        }

        $result = Student::orderBy($order, $by)
            ->orWhere(function($query) use ($like){
                if($like){
                    return $query->where('name', 'like', $like);
                }
                return $query;
            })
            ->orWhere(function($query) use ($like){
                if($like){
                    return $query->where('email', 'like', $like);
                }
                return $query;
            })
            ->orWhere(function($query) use ($like){
                if($like){
                    return $query->where('ra', 'like', $like);
                }
                return $query;
            })
            ->orWhere(function($query) use ($like){
                if($like){
                    return $query->where('cpf', 'like', $like);
                }
                return $query;
            })
            ->paginate($limit);

        return response()->json($result);
    }

    public function show($id)
    {
        $result = Student::find($id);
        if($result instanceof Student){
            return response()->json($result);
        }
        return $this->response(404);
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
        try {
            $student = Student::find($id);
            if(!$student instanceof Student){
                return $this->response(404);
            }

            $student->delete();

            return $this->response(204);

        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            array_push($this->response['errors'], [
                'message' => '╰（‵□′）╯  Something went wrong!',
                'description' => $e->getMessage()
            ]);
            return $this->response(500);
        }
    }
}
