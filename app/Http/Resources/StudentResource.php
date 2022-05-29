<?php

namespace App\Http\Resources;

use App\Models\Course;
use App\Models\Section;
use App\Models\Status;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fullname' => $this->fullname,
            'contact' => $this->contact,
            'region' => $this->region,
            'course' => Course::findOrFail($this->course_id),
            'section' => Section::findOrFail($this->section_id),
            'status' => Status::findOrFail($this->status_id)
        ];
    }
}
