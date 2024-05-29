<?php

namespace App\Services;

use App\Models\Student;

class StudentService
{
    private $student;

    public function __construct(Student $student) {
        $this->student = $student;
    }

    public function get()
    {
        $query = $this->student->latest()->get();
        return $query;
    }

    public function find($id)
    {
        return $this->student->find($id);
    }

    public function create(array $details)
    {
        return $this->student->create($details);
    }

    public function update($student, array $details)
    {
        return $student->update($details);
    }

    public function delete($student)
    {
        return $student->delete();
    }
}
