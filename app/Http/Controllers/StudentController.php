<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\StoreFormValidation;
use App\Http\Requests\Student\UpdateFormValidation;
use App\Models\Student;
use App\Services\StudentService;
use App\Traits\FileHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    use FileHelper;
    private $student;

    public function __construct(StudentService $student)
    {
        $this->student = $student;
    }

    public function index() : JsonResponse
    {
        $students = $this->student->get();
        return response()->json(['success' => true, 'data' => $students], 200);
    }

    public function show($id) : JsonResponse
    {
        $student = $this->student->find($id);
        if (!$student) {
            return response()->json(['error' => true, 'message' => 'Student not found.'], 404);
        }
        return response()->json(['success' => true, 'data' => $student], 200);
    }

    public function store(StoreFormValidation $request): JsonResponse
    {
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $path = 'images/students';
            $fileName = $this->fileUpload($request->file('image'), $path);
            $data['image'] = $fileName;
        }
        $this->student->create($data);
        return response()->json(['success' => true, 'message' => 'Student created Successfully.'], 201);
    }

    public function update(UpdateFormValidation $request, $id): JsonResponse
    {
        $student = $this->student->find($id);
        if (!$student) {
            return response()->json(['error' => true, 'message' => 'Student not found.'], 404);
        }
        $data = $request->except('image');
        if ($request->hasFile('image')) {
            $path = 'images/students';
            $fileName = $this->fileUpload($request->file('image'), $path, $student->image);
            $data['image'] = $fileName;
        }
        $this->student->update($student, $data);
        return response()->json(['success' => true, 'message' => 'Student updated Successfully.'], 201);
    }

    public function delete($id)
    {
        $student = $this->student->find($id);
        if (!$student) {
            return response()->json(['error' => true, 'message' => 'Student not found.'], 404);
        }
        if ($student->image) {
            $path = 'images/students';
            $this->fileDelete($path, $student->image);
        }
        $this->student->delete($student);
        return response()->json(['success' => true, 'message' => 'Students deleted successfully.'], 200);
    }
}
