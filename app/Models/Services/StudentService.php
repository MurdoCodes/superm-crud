<?php

namespace App\Models\Services;

use App\Http\Resources\StudentResource;
use App\Models\Course;
use App\Models\Section;
use App\Models\Status;
use App\Models\Student;

class StudentService extends ModelService
{
    public function __construct(Student $student)
    {
        $this->student = $student;
        $this->model = $student;
    }

    public static function collection()
    {
        return Student::all();
    }

    public static function show(int $student)
    {
        return Student::findOrFail($student);
    }

    public static function search(string $search)
    {
        return Student::where('fullname', 'like', '%'.$search.'%')
        ->orWhere('contact', 'like', '%'.$search.'%')
        ->orWhere('region', 'like', '%'.$search.'%')
        ->get();
    }

    public static function create(string $fullname, string $contact, string $region, ?Course $course, ?Section $section, ?Status $status)
    {
        $student = new Student();
        $student->fullname = $fullname;
        $student->contact = $contact;
        $student->region = $region;
        $student->course_id = $course->id;
        $student->section_id = $section->id;
        $student->status_id = $status->id;

        if($student->save()){
            return new StudentResource($student);
        }
    }

    public function update(string $fullname, string $contact, string $region, ?Course $course, ?Section $section, ?Status $status)
    {
        $this->student->fullname = $fullname;
        $this->student->contact = $contact;
        $this->student->region = $region;
        $this->student->course_id = $course->id;
        $this->student->section_id = $section->id;
        $this->student->status_id = $status->id;
        $this->student->save();

        return new StudentResource($this->student);
    }

    public static function bulkDelete(array $ids)
    {
        $successDelete = [];
        $failedDelete = [];
        foreach($ids as $id){
            if($student = Student::find($id)){
                $successDelete[] = $student;
                $student->Service()->delete();
            }else{
                $failedDelete[] = $id;
            }
        }
        $response = [
            "message" => "Selected items are succesfully deleted",
            "deleted" => $successDelete,
            "undeleted" => $failedDelete
        ];

        return $response;
    }
}
