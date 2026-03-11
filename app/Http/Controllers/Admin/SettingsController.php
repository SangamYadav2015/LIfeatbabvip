<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Services\SettingService;
use App\Services\MenuService;
use App\Services\PageService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    use ValidatesRequests;
    protected $settingService;
    protected $menuService;
    protected $pageService;
    public function __construct(
        SettingService $settingService,
        MenuService $menuService,
        PageService $pageService,
    ) {
        $this->settingService = $settingService;
        $this->menuService = $menuService;
        $this->pageService = $pageService;
    }

    public function siteSetting()
    {
        try {
            $data['pageTitle'] = 'Admin Site Setting';
            $data['pageDescription'] = 'BabVip CMS Admin Admin Site Setting';
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->first();
            $pageList = $this->pageService->list()->with('menu')->where('status', 'active')->get();
            return view('admin.setting.siteSetting', compact('data', 'siteSetting', 'pageList'));

        } catch (Exception $e) {
            Log::channel('database')->error('Page Site Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function saveSiteSetting(Request $request)
    {
        try {

            $data = $request->all();

            if (!empty($data['site_logo'])) {
                $image = $this->upload($data['site_logo']);
                $data['site_logo'] = $image;
            } else {
                $data['site_logo'] = $data['site_logo_old'];
                unset($data['site_logo_old']);
            }

            if (!empty($data['site_favicon'])) {
                $image = $this->upload($data['site_favicon']);
                $data['site_favicon'] = $image;
            } else {
                $data['site_favicon'] = $data['site_favicon_old'];
                unset($data['site_favicon_old']);
            }

            $storeData = [
                'setting_type' => $data['setting_type'],
                'setting_data' => json_encode($data, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $siteSetting = $this->settingService->list()->where('setting_type', 'site_setting')->count();
            if($siteSetting === 0){
              Settings::insert($storeData);
            }else{
                Settings::where('setting_type', 'site_setting')->update($storeData);
            }
            if($data['page_is_home'] !== null){
                $this->updateHomePage($data['page_is_home']);
            }
            return redirect('admin/site-setting')->with('success', 'Setting updated successfully');

        } catch (Exception $e) {
            Log::channel('database')->error('Page Site Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function footerSetting()
    {
        try {
            $data['pageTitle'] = 'Admin Footer Setting';
            $data['pageDescription'] = 'BabVip CMS Admin Admin Footer Setting';

            $footerSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->first();
            $footerMenu=$this->menuService->list()->where('status','active')->where('show_footer','1')->get();

            return view('admin.setting.footerSetting', compact('data', 'footerSetting','footerMenu'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page Site Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function saveFooterSetting(Request $request)
    {
        try {

            $data = $request->all();

            if (!empty($data['footer_logo'])) {
                $image = $this->upload($data['footer_logo']);
                $data['footer_logo'] = $image;
            } else {
                $data['footer_logo'] = $data['footer_logo_old'];
                unset($data['footer_logo_old']);
            }

            $storeData = [
                'setting_type' => $data['setting_type'],
                'setting_data' => json_encode($data, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $siteSetting = $this->settingService->list()->where('setting_type', 'footer_setting')->count();
            if($siteSetting === 0){
              Settings::insert($storeData);
            }else{
                Settings::where('setting_type', 'footer_setting')->update($storeData);
            }
            return redirect('admin/footer-setting')->with('success', 'Setting updated successfully');

        } catch (Exception $e) {
            Log::channel('database')->error('Page Site Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function thirdPartySetting()
    {
        try {
            $data['pageTitle'] = 'Admin Third party Setting';
            $data['pageDescription'] = 'BabVip CMS Admin Admin Third party Setting';
            $thirdParty = $this->settingService->list()->where('setting_type', 'third_party')->first();
            return view('admin.setting.third-party', compact('data', 'thirdParty'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page Site Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    

    public function saveSetting(Request $request)
    {
        try {

            $data = $request->all();
            $storeData = [
                'setting_type' => $data['setting_type'],
                'setting_data' => json_encode($data, true),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $siteSetting = $this->settingService->list()->where('setting_type', $data['setting_type'])->count();
            if($siteSetting === 0){
              Settings::insert($storeData);
            }else{
                Settings::where('setting_type', $data['setting_type'])->update($storeData);
            }
            return redirect('admin/third-party-setting')->with('success', 'Setting updated successfully');

        } catch (Exception $e) {
            Log::channel('database')->error('Page Third Party Setting Retrived failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateHomePage($pageId){
     $this->pageService->updateHomePage($pageId);
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
