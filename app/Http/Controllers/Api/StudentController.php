<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Services\StudentService;
use App\Http\Requests\CreateStudentRequest;
use App\Models\Course;
use App\Models\Section;
use App\Models\Status;
use Exception;

class StudentController extends Controller
{
    public static function apiRoutes()
    {
        Route::get('/students', [StudentController::class, 'getCollection']);
        Route::get('/students/{id}', [StudentController::class, 'show']);
        Route::post('/students', [StudentController::class, 'create']);
    }

    public function getCollection()
    {
        return Student::all();
    }

    public function show($id)
    {
        return Student::findOrFail($id);
    }

    public function create(CreateStudentRequest $request)
    {
        try{
            return StudentService::create(
                $request->validated()['fullname'],
                $request->validated()['contact'],
                $request->validated()['region'],
                Course::findOrFail($request->validated()['course_id']),
                Section::findorFail($request->validated()['section_id']),
                Status::findOrFail($request->validated()['status_id'])
            );
        }catch(Exception $e){
            return $e;
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
