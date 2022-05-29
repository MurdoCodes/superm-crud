<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Models\Services\StudentService;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Section;
use App\Models\Status;
use Exception;

class StudentController extends Controller
{
    public static function apiRoutes()
    {
        Route::get('/students', [StudentController::class, 'getCollection']);
        Route::get('/students/{student}', [StudentController::class, 'show']);
        Route::get('/students/search/{student}', [StudentController::class, 'search']);
        Route::post('/students', [StudentController::class, 'create']);
        Route::put('/students/{student}', [StudentController::class, 'update']);
        Route::delete('/students/{student}', [StudentController::class, 'destroy']);
        Route::delete('/students/delete', [StudentController::class, 'bulkDelete']);
    }

    public function getCollection()
    {
        return StudentService::collection();
    }

    public function show($student)
    {
        return StudentService::show($student);
    }

    public function search($student)
    {
        return StudentResource::collection(StudentService::search($student));
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

    public function update(CreateStudentRequest $request, Student $student)
    {
        return $student->Service()->update(
            $request->validated()['fullname'],
            $request->validated()['contact'],
            $request->validated()['region'],
            Course::findOrFail($request->validated()['course_id']),
            Section::findorFail($request->validated()['section_id']),
            Status::findOrFail($request->validated()['status_id'])
        );
    }

    public function destroy(Student $student)
    {
        return $student->delete();
    }

    public function bulkDelete(Request $request)
    {
        return StudentService::bulkDelete($request['ids']);
    }
}
