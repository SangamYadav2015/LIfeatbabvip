<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\PostJob;
use App\Models\JobApplication;

use App\Models\Company;
use App\Models\Location;

use App\Models\Department;

use App\Models\Settings;


use App\Services\PostJobService;
use App\Services\SettingService;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Imports\PostJobImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PersonalInformation;

use App\Models\EducationInformation;

use App\Models\WorkExperience;

use App\Models\Document;
use App\Services\CareerSettingService;
use App\Models\CareerSetting;
use Illuminate\Support\Facades\Validator;


class JobController extends Controller
{
    use ValidatesRequests;

    protected $postJobService;
    protected $settingService;

    protected $careerSettingService;

    public function __construct(
        PostJobService $postJobService,
        SettingService $settingService,
        CareerSettingService $careerSettingService
    ) {
        $this->postJobService = $postJobService;
        $this->settingService = $settingService;
        $this->careerSettingService = $careerSettingService;
    }

   
    public function AllJob()
    {
        try {
            $data['pageTitle'] = 'Admin Job List';
            $data['pageDescription'] = 'BabVip CMS Job List';
            $jobs = $this->postJobService->list()->with('company')->paginate(10);
            return view('admin.job.all_job', compact('data', 'jobs'));
        } catch (Exception $e) {
            Log::channel('database')->error('Job retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function AddJob()
    {
        try {
            $data['pageTitle'] = 'Admin Add Job';
            $data['pageDescription'] = 'BabVip CMS Add Job';
            $company = Company::all();
            $departments=Department::all();
            $countries = Location::all();
                                    return view('admin.job.add_job', compact('data', 'company','departments','countries'));
        } catch (Exception $e) {
            Log::channel('database')->error('Job add failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function StoreJob(Request $request)
{
    try {
        // Validate the request
         $validator = Validator::make(
            $request->all(),
            PostJob::validateRules(),
            PostJob::validateMessages()
        );

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        // Get all request data
        $data = $request->all();

        // Generate job slug
        $jobSlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->title)); // Adjust if necessary
        $data['job_slug'] = $jobSlug;

        // Handle job image upload if exists
        if (!empty($data['job_image'])) {
            $jobImage = $this->upload($data['job_image']);
            $data['job_image'] = $jobImage;
        }

        // Set created_by
        $data['created_by'] = Auth::user()->id;

        // Check if company_id is present
        if (empty($data['company_id'])) {
            throw new Exception('Company ID is required.');
        }

          // Handle salary disclosure
          if (isset($data['salary_disclosed']) && $data['salary_disclosed'] == 1) {
            // Salary is disclosed, ensure min and max salary are valid
            $data['minimum_salary'] = $request->input('minimum_salary');
            $data['maximum_salary'] = $request->input('maximum_salary');
        } else {
            // Salary is not disclosed, set both minimum and maximum salary to null
            $data['minimum_salary'] = null;
            $data['maximum_salary'] = null;
        }

        // Create the job
        $this->postJobService->create($data);

        return redirect()->route('admin.joblist')->with('success', 'Company created successfully');
    } catch (Exception $e) {
        Log::channel('database')->error('Job creation failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}



public function EditJob($id)
{
    try {
        $data['pageTitle'] = 'Admin Edit Job';
        $data['pageDescription'] = 'BabVip CMS Edit Job';
        $companies = Company::all();
        $departments = Department::all();
        $locations = Location::all();

        // Use find instead of list()->where() for a single record
        $job = $this->postJobService->find($id); // Assuming you have a find method

        return view('admin.job.edit_job', compact('data', 'companies', 'job', 'departments', 'locations'));
    } catch (Exception $e) {
        Log::channel('database')->error('Job edit failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}


    public function UpdateJob(Request $request, $id)
    {
        try {
            $this->validateRequest($request, PostJob::validateRules(), PostJob::validateMessages());
            $data = $request->all();
            
        $jobSlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($request->title)); // Adjust if necessary
        $data['job_slug'] = $jobSlug;

            if (!empty($data['job_image'])) {
                $jobImage = $this->upload($data['job_image']);
                $data['job_image'] = $jobImage;
                $this->deleteImage($data['job_image_old']);
            } else {
                $data['job_image'] = $data['job_image_old'];
            }

            $data['created_by'] = Auth::user()->id;
            $this->postJobService->update($data, $id);

            return redirect()->route('admin.joblist')->with('success', 'Company created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Job update failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateJobStatus(Request $request)
    {
        try {
            $id = $request->id;
            $data = [
                'status' => $request->status,
            ];
            $this->postJobService->update($data, $id);
            return response()->json(['message' => 'Job status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Job status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function DeleteJob($id)
    {
        try {
            $this->postJobService->delete($id);
            return redirect()->route('admin.joblist')->with('success', 'Company created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Job delete failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function jobSetting()
    {
        try {
            $data['pageTitle'] = 'Admin Job Setting';
            $data['pageDescription'] = 'BabVip CMS Admin Job Setting';
            $jobSetting = $this->settingService->list()->where('setting_type', 'job_setting')->first();
            return view('admin.job.setting', compact('data', 'jobSetting'));
        } catch (Exception $e) {
            Log::channel('database')->error('Job Setting retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function saveJobSetting(Request $request)
    {
        try {
            $data = $request->all();

            if (!empty($data['job_logo'])) {
                $image = $this->upload($data['job_logo']);
                $data['job_logo'] = $image;
            } else {
                $data['job_logo'] = $data['job_logo_old'];
                unset($data['job_logo_old']);
            }

            if (!empty($data['section1_bg'])) {
                $image = $this->upload($data['section1_bg']);
                $data['section1_bg'] = $image;
            } else {
                $data['section1_bg'] = $data['section1_bg_old'];
                unset($data['section1_bg_old']);
            }

            $storeData = [
                'setting_type' => $data['setting_type'],
                'setting_data' => json_encode($data, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $siteSetting = $this->settingService->list()->where('setting_type', 'job_setting')->count();
            if ($siteSetting === 0) {
                Settings::insert($storeData);
            } else {
                Settings::where('setting_type', 'job_setting')->update($storeData);
            }
            return redirect('admin/jobsetting')->with('success', 'Setting updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Job Setting update failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function upload(UploadedFile $file)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/uploads', $filename);
        return $filename;
    }

    public function deleteImage($filename)
    {
        $filePath = 'public/uploads/' . $filename;
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

   
    public function show($id)
    {
        // Use the service to find the job by ID
        $job = $this->postJobService->find($id);

        // If job not found, show 404 error page
        if (!$job) {
            abort(404, 'Job not found');
        }

        // Return the job detail view with the job data
        return view('applicant.jobs.detail', compact('job'));
    }

    

    public function imports(Request $request)
    {
        try {
            // Validate the request
            // $request->validate([
            //     'file' => 'required|mimes:csv', // Updated for CSV file
            // ]);

            // Import the Excel file
            Excel::import(new PostJobImport, $request->file('file'));
            // dd(vars: $request->toarray());

            return redirect()->route('admin.joblist')->with('success', 'Jobs imported successfully!');
        } catch (\Exception $e) {
            Log::error('Job import failed: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to import jobs.']);
        }
}





public function createSetting()
    {
        try {
            // Prepare the data for the page
            $data['pageTitle'] = 'Admin Add Career Setting';
            $data['pageDescription'] = 'BabVip CMS Add Career Setting';
            
            // You can load other necessary data for the form here if needed (e.g., categories, locations, etc.)
            
            // Return the view and pass the data
            return view('admin.job.carrersetting', compact('data'));
        } catch (Exception $e) {
            // Log the error
            Log::channel('database')->error('Career Setting creation failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            
            // Return an error view if the operation fails
            return response()->view('errors.500', [], 500);
        }
    }

    public function storeCareerSetting(Request $request)
{
    try {
        // Validate form data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'name' => 'required|string',
            'designation' => 'required|string',
            'icon_image' => 'nullable|array',
            'icon_image.*' => 'image',
            'logo' => 'image',
            'base_icon' => 'nullable|array',
            'base_icon.*' => 'image',
            'base_heading' => 'required|string',
            'right_sub_heading' => 'required|string',
            'right_heading' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Save the data
        $careerSetting = new CareerSetting();
        $careerSetting->title = $request->title;
        $careerSetting->subtitle = $request->subtitle;
        $careerSetting->name = $request->name;
        $careerSetting->designation = $request->designation;
        $careerSetting->base_heading = $request->base_heading;
        $careerSetting->right_heading = $request->right_heading;
        $careerSetting->right_sub_heading = $request->right_sub_heading;
        $careerSetting->logo = $request->logo;
        $careerSetting->status = $request->status;

        if ($request->hasFile('icon_image')) {
            foreach ($request->file('icon_image') as $image) {
                $imageName = time().rand(1, 100).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/icon_images'), $imageName);
                $careerSetting->icon_image = $imageName;
            }
        }

        if ($request->hasFile('base_icon')) {
            foreach ($request->file('base_icon') as $image) {
                $imageName = time().rand(1, 100).'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images/base_icons'), $imageName);
                $careerSetting->base_icon = $imageName;
            }
        }

        $careerSetting->save();

        return redirect()->view('admin.job.all_carrer_setting')->with('success', 'Career setting added successfully!');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function AllCareerSetting()
{
    try {
        // Set up page metadata
        $data['pageTitle'] = 'Admin Career Settings';
        $data['pageDescription'] = 'BabVip CMS Career Settings';

        // Fetch all career settings with related data
        $careerSettings = CareerSetting::all();

        // Return the view with the career settings data
        return view('admin.job.all_carrer_setting', compact('data', 'careerSettings'));
    } catch (Exception $e) {
        // Log error to the database channel
        Log::channel('database')->error('Career Setting retrieval failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        // Return a 500 error view
        return response()->view('errors.500', [], 500);
    }
}

// In your CareerSettingController or relevant controller
public function deleteCareerSetting($id)
{
    try {
        // Find the career setting by ID
        $careerSetting = CareerSetting::findOrFail($id);

        // Delete the career setting
        $careerSetting->delete();

        // Redirect back with success message
        return redirect()->view('admin.job.all_carrer_setting')->with('success', 'Career setting deleted successfully.');
    } catch (\Exception $e) {
        // Log the error
        Log::channel('database')->error('Career Setting deletion failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        // Return with error message
        return redirect()->view('admin.job.all_carrer_setting')->with('error', 'Failed to delete the career setting.');
    }
}

public function editCareerSetting($id)
{
    try {
        // Set up page metadata
        $data['pageTitle'] = 'Edit Career Setting';
        $data['pageDescription'] = 'Edit the details of a career setting';

        // Find the CareerSetting by ID, or fail with 404
        $careerSetting = CareerSetting::findOrFail($id);

        // Return the edit view with the data and the specific career setting
        return view('admin.job.edit_career_setting', compact('data', 'careerSetting'));
    } catch (\Exception $e) {
        // Log the error to the database channel
        Log::channel('database')->error('Failed to load Career Setting for editing', [
            'id' => $id,
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);

        // Redirect back with error message or show error page
        return redirect()->back()->withErrors(['error' => 'Failed to load career setting for editing.']);
    }
}

public function updateCareerSetting(Request $request, $id)
{
    try {
        // Validate form data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'subtitle' => 'required|string',
            'name' => 'required|string',
            'designation' => 'required|string',
            'icon_image' => 'nullable|array',
            'icon_image.*' => 'image',
            'logo' => 'nullable|image',
            'base_icon' => 'nullable|array',
            'base_icon.*' => 'image',
            'base_heading' => 'required|string',
            'right_sub_heading' => 'required|string',
            'right_heading' => 'required|string',
            'status' => 'required|in:active,inactive',
        ]);

        // Find the existing career setting
        $careerSetting = CareerSetting::findOrFail($id);

        // Update basic fields
        $careerSetting->title = $request->title;
        $careerSetting->subtitle = $request->subtitle;
        $careerSetting->name = $request->name;
        $careerSetting->designation = $request->designation;
        $careerSetting->base_heading = $request->base_heading;
        $careerSetting->right_heading = $request->right_heading;
        $careerSetting->right_sub_heading = $request->right_sub_heading;
        $careerSetting->status = $request->status;

        // Handle logo upload (single file)
        if ($request->hasFile('logo')) {
            // Optionally delete old logo file if exists
            if ($careerSetting->logo && file_exists(public_path('images/logos/' . $careerSetting->logo))) {
                unlink(public_path('images/logos/' . $careerSetting->logo));
            }
            $logoFile = $request->file('logo');
            $logoName = time() . '_logo.' . $logoFile->getClientOriginalExtension();
            $logoFile->move(public_path('images/logos'), $logoName);
            $careerSetting->logo = $logoName;
        }

        // Handle icon images (multiple files)
        if ($request->hasFile('icon_image')) {
            // If you want to keep old images, consider saving all names in an array (but your model currently supports only one)
            // Here we overwrite with last uploaded image name:
            foreach ($request->file('icon_image') as $image) {
                $imageName = time() . '_icon_' . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/icon_images'), $imageName);
                $careerSetting->icon_image = $imageName;
            }
        }

        // Handle base icons (multiple files)
        if ($request->hasFile('base_icon')) {
            foreach ($request->file('base_icon') as $image) {
                $imageName = time() . '_base_' . rand(1, 100) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/base_icons'), $imageName);
                $careerSetting->base_icon = $imageName;
            }
        }

        $careerSetting->save();

return redirect()->back()->with('error', 'Something went wrong.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}


}
