<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class LocationController extends Controller
{
    use ValidatesRequests;

    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Location List';
            $data['pageDescription'] = 'Manage Locations';
            $locations = $this->locationService->list()->paginate(10);
            return view('admin.location.show', compact('data', 'locations'));
        } catch (Exception $e) {
            Log::channel('database')->error('Location retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function create()
    {
        try {
            $data['pageTitle'] = 'Add Location';
            $data['pageDescription'] = 'Add a new location';
            return view('admin.location.create', compact('data'));
        } catch (Exception $e) {
            Log::channel('database')->error('Location create view failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $this->validateRequest($request, Location::validateRules(), Location::validateMessages());
    
            // Initialize the image path variable
            $locationImage = null;
    
            // Handle the image upload
            if (!empty($request->location_image)) {
                $locationImage = $this->upload($request->location_image); // Make sure you have this method defined
            }
    
            // Prepare data for storage
            $storeData = [
                "location_name" => $request->location_name,
                "location_slug" => $request->location_slug,
                "short_description" => $request->short_description,
                "location_image" => $locationImage,
                "status" => $request->status,
            ];
    
            // Create the location
            $this->locationService->create($storeData);
    
            return redirect('admin/locations')->with('success', 'Location created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Location store failed', [
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

    public function edit($id)
    {
        try {
            $data['pageTitle'] = 'Edit Location';
            $data['pageDescription'] = 'Edit the location details';
            $location = $this->locationService->find($id);
            return view('admin.location.edit', compact('data', 'location'));
        } catch (Exception $e) {
            Log::channel('database')->error('Location edit view failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function update(Request $request, $id)
{
    try {
        // Validate the request
        $this->validateRequest($request, Location::validateRules(), Location::validateMessages());
        
        // Retrieve the existing location data
        $location = $this->locationService->find($id);
        
        $data = $request->all();
        $data['updated_by'] = Auth::user()->id;

        // Handle location image upload if a new image is provided
        if ($request->hasFile('location_image')) {
            // Upload the new image and store the path
            $locationImage = $this->upload($request->file('location_image'));
            $data['location_image'] = $locationImage;
        } else {
            // If no new image is uploaded, retain the old image
            $data['location_image'] = $request->input('location_image_old', $location->location_image);
        }

        // Update the location
        $this->locationService->update($data, $id);
        
        return redirect('admin/locations')->with('success', 'Location updated successfully');
    } catch (Exception $e) {
        Log::channel('database')->error('Location update failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}


    public function destroy($id)
    {
        try {
            $this->locationService->delete($id);
            return redirect('admin/locations')->with('success', 'Location deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Location delete failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $id = $request->id;
            $data = ['status' => $request->status];
            $this->locationService->update($data, $id);
            return response()->json(['message' => 'Location status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Location status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
}
