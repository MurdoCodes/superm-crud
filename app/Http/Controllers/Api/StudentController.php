<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;

class StudentController extends Controller
{
    public static function apiRoutes()
    {
        Route::get('/students', [StudentController::class, 'getCollection']);
        Route::get('/students/{id}', [StudentController::class, 'show']);
    }

    public function getCollection()
    {
        return Student::all();
    }

    public function show($id)
    {
        return Student::findOrFail($id);
    }
    
    public function create()
    {
        //
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
