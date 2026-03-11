<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Services\UserService;
use App\Services\UserRoleService;
use App\Services\DepartmentService;
use App\Services\UserLoginAttemptServices;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Mail\RegisterUserMail;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use ValidatesRequests;
    protected $userService;
    protected $userRoleService;
    protected $departmentService;
    protected $userLoginAttemptServices;

    public function __construct(
        UserService $userService,
        UserRoleService $userRoleService,
        DepartmentService $departmentService,
        UserLoginAttemptServices $userLoginAttemptServices,
    ) {
        $this->userService = $userService;
        $this->userRoleService = $userRoleService;
        $this->departmentService = $departmentService;
        $this->userLoginAttemptServices = $userLoginAttemptServices;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin User List';
            $data['pageDescription'] = 'BabVip CMS Admin User List';
            $users = $this->userService->list()->with('userRole', 'department')->where('id', '!=',  Auth::id())->paginate(10);
            return view('admin.user.index', compact('data', 'users'));
        } catch (Exception $e) {
            Log::channel('database')->error('User retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function addUser()
    {
        try {

            $data['pageTitle'] = 'Admin Create Create User';
            $data['pageDescription'] = 'BabVip CMS Admin Create User';
            $departments  = $this->departmentService->list()->where('id', '!=', '1')->get();
            return view('admin.user.add', compact('data', 'departments'));
        } catch (Exception $e) {
            Log::channel('database')->error('User Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function checkEmail(Request $request)
    {
        try {
            $email = $request->email;
            $exists = $this->userService->list()->where('email', $email)->exists();
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('email check retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function userStore(Request $request)
    {
        try {
            $this->validateRequest($request, User::validateRules(), User::validateMessages());
       
            $data = $request->all();
            $hashedPassword = Hash::make($request->password);
            $profileImage=null;

            if (!empty($data['profile_image'])) {
                $profile_image = $this->upload($data['profile_image']);
                $profileImage = $profile_image;               
            } 
    
            $storeData = [
                "name" => $request->name,
                "department_id" => $request->department_id,
                "email" => $request->email,
                "designation" => $request->designation,
                "phone_number" => $request->phone_number,
                "address" => $request->address,
                "status" => $request->status,
                "profile_image" => $profileImage,
                "password" => $hashedPassword,
            ];
            $this->userService->create($storeData);
            $name= $request->name;
                Mail::to($request->email)->send(new RegisterUserMail(
                    $name ,
                    $request->email,
                    $request->input('password'),
                    "USer Account Created",
                ));
        return redirect('admin/userlist')->with('success', 'User created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('User Store Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editUser($id)
    {
        try {
            $data['pageTitle'] = 'Admin Create Create User';
            $data['pageDescription'] = 'BabVip CMS Admin Create User';
            $departments  = $this->departmentService->list()->where('id', '!=', '1')->get();
            $userData = $this->userService->singleDataFindId($id);
            return view('admin.user.edit', compact('data', 'departments', 'userData'));
        } catch (Exception $e) {
            Log::channel('database')->error('User Role retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $data = $request->all();
            $profileImage=$request->old_profile;
            if (!empty($data['profile_image'])) {
                $profile_image = $this->upload($data['profile_image']);
                $profileImage = $profile_image;               
            } 
    
            $storeData = [
                "department_id" => $request->department_id,
                "name" => $request->name,
                "email" => $request->email,
                "designation" => $request->designation,
                "phone_number" => $request->phone_number,
                "address" => $request->address,
                "status" => $request->status,
                "profile_image" => $profileImage,
            ];
            $this->userService->update($storeData, $id);
            return redirect('admin/userlist')->with('success', 'User updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('User update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function deleteUser($id){
        try {
            $this->userService->delete($id);
            return redirect('admin/userlist')->with('success', 'User deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('User delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function userChangeStatus(Request $request)
    {

        try {
            $id = $request->id;
            $data = array(
                'status' => $request->status,
            );
            $this->userService->update($data, $id);
             $dataAttempt=array(
                'status' =>1,
            );
            $this->userLoginAttemptServices->updateAttemptStatus($dataAttempt, $id);
            
            return response()->json(['message' => 'User status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('User status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    
    public function getDynamicRole(Request $request)
    {
        try {
            $departmentId = $request->department_id;
            $departmentRole = $this->userRoleService->list()
                ->where('department_id', $departmentId)
                ->get();
            if ($departmentRole->isEmpty()) {
                return response()->json(['message' => 'No role found for the selected section']);
            }
            return response()->json($departmentRole);
        } catch (Exception $e) {
            Log::channel('database')->error('role found department add user', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

  

    public function userProfile()
    {
        try {
            $id=Auth::id();
            $data['pageTitle'] = 'Admin Create  User Profile';
            $data['pageDescription'] = 'BabVip CMS Admin  User Profile';
            $departments  = $this->departmentService->list()->where('id', '!=', '1')->paginate(10);
            $userData = $this->userService->singleDataFindId($id);
            return view('admin.user.user-profile', compact('data', 'departments', 'userData'));
        } catch (Exception $e) {
            Log::channel('database')->error('User Role retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateProfile(Request $request, $id)
    {
        try {
            $data = $request->all();
            $profileImage=$request->old_profile;
            if (!empty($data['profile_image'])) {
                $profile_image = $this->upload($data['profile_image']);
                $profileImage = $profile_image;     
            } 
            $storeData = [
                "name" => $request->name,
                "phone_number" => $request->phone_number,
                "address" => $request->address,
                "profile_image" => $profileImage,
            ];
            $this->userService->update($storeData, $id);
            return redirect('admin/userprofile')->with('success', 'Profile updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('User update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function changePassword()
    {
        try {
            $data['pageTitle'] = 'Admin Create Change Password';
            $data['pageDescription'] = 'BabVip CMS Admin Change Password';
            return view('admin.user.change-password', compact('data'));
        } catch (Exception $e) {
            Log::channel('database')->error('Change Password retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function checkCurrentPassword(Request $request)
    {
        try {
            $id = Auth::id();
            $user = $this->userService->list()->where('id', $id)->first();
            if (Hash::check($request->current_password, $user->password)) {
                return 0;
            } else {
                return 1;
            }
           } catch (Exception $e) {
            Log::channel('database')->error('checkPassword failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $id = Auth::id();
            $user = $this->userService->list()->where('id', $id)->first();
            if (Hash::check($request->current_password, $user->password)) {
                $hashedPassword = Hash::make($request->password);
                $storeData = [
                    "password" => $hashedPassword,
                ];
              $this->userService->update($storeData, $id);
              return redirect('admin/changepassword')->with('success', 'Password Changed Successfully');
            } else {
              return redirect('admin/changepassword')->with('error', 'Current Password Not Match');
            }
        } catch (Exception $e) {
            Log::channel('database')->error('User update change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function upload(UploadedFile $file)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename, 'public'); // Explicitly use 'public' disk
        return $filename;
    }
    public function deleteImage($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

    
    
}
