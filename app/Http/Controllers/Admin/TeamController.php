<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\Team;
use App\Services\TeamService;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

    use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    use ValidatesRequests;

    protected $teamService;
    public function __construct(
        TeamService $teamService,
    ) {
        $this->teamService = $teamService;
    }

    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Menu List';
            $data['pageDescription'] = 'BabVip CMS Admin Menu List';
            $teamData = $this->teamService->list()->paginate(10);
            return view('admin.team.index', compact('data', 'teamData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Menu retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function addTeam()
    {
        try {
            
            $data['pageTitle'] = 'Admin Menu Add';
            $data['pageDescription'] = 'BabVip CMS Admin Menu Add';
            return view('admin.team.add', compact('data'));
        } catch (Exception $e) {
            Log::channel('database')->error('Menu retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }



public function storeTeam(Request $request)
{
    try {

        $validator = Validator::make($request->all(), [

            'name'        => ['required','regex:/^[A-Za-z\s]+$/'],
            'lastname'    => ['required','regex:/^[A-Za-z\s]+$/'],
            'designation' => ['required','regex:/^[A-Za-z\s]+$/'],
            'about'       => ['nullable','regex:/^[A-Za-z\s]+$/'],

            'linkedin_url'  => 'nullable|url',
            'facebook_url'  => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'team_image'    => 'nullable|image',
            'status'        => 'required',

        ], [
            'name.regex' => 'Name must contain only letters.',
            'lastname.regex' => 'Last name must contain only letters.',
            'designation.regex' => 'Designation must contain only letters.',
            'about.regex' => 'About field must contain only letters.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $teamImage = null;

        if ($request->hasFile('team_image')) {
            $teamImage = $this->upload($request->team_image);
        }

        $storeData = [
            "name" => $request->name,
            "lastname" => $request->lastname,
            "designation" => $request->designation,
            "about" => $request->about,
            "linkedin_url" => $request->linkedin_url,
            "facebook_url" => $request->facebook_url,
            "instagram_url" => $request->instagram_url,
            "team_image" => $teamImage,
            "status" => $request->status,
        ];

        $this->teamService->create($storeData);

        return redirect('admin/teamlist')->with('success', 'Team created successfully');

    } catch (Exception $e) {

        Log::channel('database')->error('Team Style Add', [
            'error' => $e->getMessage(),
        ]);

        return response()->view('errors.500', [], 500);
    }
}


    public function editTeam($id)
    {
        try {
            $data['pageTitle'] = 'Admin Menu Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Menu Edit';
            $teamData = $this->teamService->list()->where('status', 'active')->get();
            $teamRecord = $this->teamService->list()->where('id', $id)->first();

            return view('admin.team.edit', compact('data', 'teamData','teamRecord'));
        } catch (Exception $e) {
            Log::channel('database')->error('team data retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateTeam(Request $request, $id){
        try {
            $this->validateRequest($request, Team::validateRules($id), Team::validateMessages());
            $teamImage=null;
            if (!empty($request->team_image)) {
                $teamImage = $this->upload($request->team_image);
                $this->deleteImage($request->team_old_image);
            }else{
                $teamImage =$request->team_old_image;
            }

            $storeData = [
                "name" => $request->name,
                "lastname" => $request->lastname,
                "designation" => $request->designation,
                "about" => $request->about,
                "linkedin_url" => $request->linkedin_url,
                "facebook_url" => $request->facebook_url,
                "instagram_url" => $request->instagram_url,
                "team_image" => $teamImage,
                "status" => $request->status,
            ];
            $this->teamService->update($storeData, $id);
            
            return redirect('admin/teamlist')->with('success', 'Team updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Page Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function deleteTeam($id)
    {
        try {
            $this->teamService->delete($id);
            return redirect('admin/teamlist')->with('success', 'Team deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('team delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function upload(UploadedFile $file)
    {
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploads', $filename, 'public');
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
