<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Services\UserRoleService;
use App\Services\DepartmentService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{

    use ValidatesRequests;
    protected $userRoleService;
    protected $departmentService;

    public function __construct(
        UserRoleService $userRoleService,
        DepartmentService $departmentService,
    ) {
        $this->userRoleService = $userRoleService;
        $this->departmentService = $departmentService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin User Role List';
            $data['pageDescription'] = 'BabVip CMS Admin User Role List';
            $userRole = $this->userRoleService->list()->with('department')->where('department_id', '!=', '1')->paginate(10);
            return view('admin.user-role.index', compact('data', 'userRole'));
        } catch (Exception $e) {
            Log::channel('database')->error('User Role retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    

    
    public function addRole()
    {
        try {

            $data['pageTitle'] = 'Admin Create Create Role';
            $data['pageDescription'] = 'BabVip CMS Admin Create Role';
            $departments = $this->departmentService->list()->where('id' ,'!=', 1)->get();
            return view('admin.user-role.add', compact('data', 'departments'));
        } catch (Exception $e) {
            Log::channel('database')->error('User Role Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function checkRole(Request $request)
    {
        try {
            $roleTitle = $request->role_title;
            $departmentId = $request->department_id;
            $exists = $this->userRoleService->list()->where('role_title', $roleTitle)->where('department_id', $departmentId)->exists();
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function roleStore(Request $request)
    {
        try {
            $this->validateRequest($request, UserRole::validateRules(), UserRole::validateMessages());
       
            $data = $request->all();
            $storeData = [
                "department_id" => $request->department_id,
                "role_title" => $request->role_title,
                "role" => $request->role,
            ];
            $this->userRoleService->create($storeData);
            return redirect('admin/rolelist')->with('success', 'Role created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Role Store Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editRole($id)
    {
        try {
            $data['pageTitle'] = 'Admin User Role Edit';
            $data['pageDescription'] = 'BabVip CMS Admin User Role Edit';
            $roleData = $this->userRoleService->singleDataFindId($id);
            $departments = $this->departmentService->list()->where('id' ,'!=', 1)->get();
            return view('admin.user-role.edit', compact('data', 'roleData', 'departments'));
        } catch (Exception $e) {
            Log::channel('database')->error('User Role retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateRole(Request $request, $id)
    {
        try {
            $data = $request->all();
            $storeData = [
                "role_title" => $request->role_title,
                "role" => $request->role,
            ];
            $this->userRoleService->update($data, $id);
            return redirect('admin/rolelist')->with('success', 'Role updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Role update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function deleteRole($id){
        try {
            $this->userRoleService->delete($id);
            return redirect('admin/rolelist')->with('success', 'Role deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Role delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
}
