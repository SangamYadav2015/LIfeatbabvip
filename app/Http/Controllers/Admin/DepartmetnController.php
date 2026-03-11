<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class DepartmetnController extends Controller
{
    use ValidatesRequests;
    protected $departmentService;

    public function __construct(
        DepartmentService $departmentService,
    ) {
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Department List';
            $data['pageDescription'] = 'BabVip CMS Admin Department List';
            $departments = $this->departmentService->list()->with('UserRole')->where('id', '!=', 1)->paginate(10);
            return view('admin.department.index', compact('data', 'departments'));
        } catch (Exception $e) {
            Log::channel('database')->error('Department retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editDepartment($id)
    {
        try {
            $data['pageTitle'] = 'Admin User Role Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Department Edit';
            $department = $this->departmentService->singleDataFindId($id);
            return view('admin.department.edit', compact('data', 'department'));
        } catch (Exception $e) {
            Log::channel('database')->error('Department retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateDepartment(Request $request, $id)
    {
        try {
            $data = $request->all();
            $storeData = [
                "role_title" => $request->department_name,
            ];
            $this->departmentService->update($data, $id);
            return redirect('admin/departmentlist')->with('success', 'Department updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Department update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    

}
