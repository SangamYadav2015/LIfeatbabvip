<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Services\DepartmentService;
use App\Models\Department;

class DepartmentController extends Controller
{
    protected $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * Display a list of departments.
     */
    public function index()
    {
        try {
            $data['pageTitle'] = 'Department List';
            $data['pageDescription'] = 'List of all departments';
            $departments = $this->departmentService->list()->paginate(10);
            return view('admin.department.index', compact('data', 'departments'));
        } catch (Exception $e) {
            Log::error('Department retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Show the form for creating a new department.
     */
    public function AddDepartment()
    {
        try {
            $data['pageTitle'] = 'Add Department';
            $data['pageDescription'] = 'Create a new department';
            return view('admin.department.create', compact('data'));
        } catch (Exception $e) {
            Log::error('Department creation form retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Store a newly created department.
     */
    public function store(Request $request)
    {
        try {
            // Use Laravel's built-in validation
            $validatedData = $request->validate(Department::validateRules(), Department::validateMessages());
            
            // Handle the image upload
            if ($request->hasFile('department_image')) {
                // Upload the image and get the path
                $validatedData['department_image'] = $this->uploadImage($request->file('department_image'));
            }
    
            // Create the department with the validated data, including the image path
            $this->departmentService->create($validatedData);
            return redirect()->route('admin.departmentList')->with('success', 'Department created successfully');
        } catch (Exception $e) {
            Log::error('Department creation failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function uploadImage($image)
{
    // Define the path where the image will be stored
    $path = 'department_images'; // Adjust this as needed

    // Store the image and return the path
    return $image->store($path, 'public'); // 'public' is the disk you want to use
}


    /**
     * Show the form for editing the specified department.
     */
    public function editDepartment($id)
    {
        try {
            $data['pageTitle'] = 'Edit Department';
            $data['pageDescription'] = 'Edit department details';
            $department = $this->departmentService->singleDataFindId($id);
            return view('admin.department.edit', compact('data', 'department'));
        } catch (Exception $e) {
            Log::error('Department edit retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Update the specified department.
     */
    public function updateDepartment(Request $request, $id)
    {
        try {
            // Use Laravel's built-in validation
            $validatedData = $request->validate(Department::validateRules(), Department::validateMessages());
            if ($request->hasFile('department_image')) {
                // Upload the image and get the path
                $validatedData['department_image'] = $this->uploadImage($request->file('department_image'));
            }
            $this->departmentService->update($validatedData, $id);
            return redirect()->route('admin.departmentList')->with('success', 'Department updated successfully');
        } catch (Exception $e) {
            Log::error('Department update failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Remove the specified department.
     */
    public function destroy($id)
    {
        try {
            $this->departmentService->delete($id);
            return redirect()->route('admin.departmentList')->with('success', 'Department deleted successfully');
        } catch (Exception $e) {
            Log::error('Department deletion failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
