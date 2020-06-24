<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Http\Services\ApiService;
use App\Http\Services\ValidatorService;

class StudentController extends Controller
{
    private $order = ['name', 'email'];
    private $by = ['asc', 'desc'];
    private $apiService;
    private $validatorService;

    public function __construct(ApiService $apiService, ValidatorService $validatorService){
        $this->apiService = $apiService;
        $this->validatorService = $validatorService;
    }

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

        $this->apiService->setResult($result);
        $this->apiService->setStatus(true);
        return $this->apiService->response();
    }

    public function show($id)
    {
        $result = Student::find($id);
        if($result instanceof Student){
            $this->apiService->setResult($result);
            $this->apiService->setStatus(true);
            return $this->apiService->response(201);
        }
        return $this->apiService->response(404);
    }

    public function store(Request $request)
    {
        $request = $request->all();

        if($this->validatorService->fails($request, 'store')) {
            $this->apiService->setErrors($this->validatorService->getErrors());
            return $this->apiService->response(422);
        };

        try {
            $this->apiService->setResult(Student::create($request));
            $this->apiService->setStatus(true);
            return $this->apiService->response(201);

        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $student = Student::find($id);
            if(!$student instanceof Student){
                return $this->apiService->response(404);
            }

            $inputs = $request->only(['name', 'email']);
            $student->update($inputs);
            $this->apiService->setStatus(true);
            $this->apiService->setResult($student);
            return $this->apiService->response(201);

        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    public function destroy($id)
    {
        try {
            $student = Student::find($id);
            if(!$student instanceof Student){
                return $this->apiService->response(404);
            }

            $student->delete();
            return $this->apiService->response(204);

        } catch (\Exception $e) {
            return $this->error($e);
        }
    }

    private function error($e)
    {
        \Log::error($e->getMessage());
        $this->apiService->setErrors([
            'message' => '( ＾皿＾)っ Something went wrong!',
            'description' => $e->getMessage()
        ]);
        return $this->apiService->response(500);
    }
}
