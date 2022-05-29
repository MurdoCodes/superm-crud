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
}
