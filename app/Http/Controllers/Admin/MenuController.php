<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\Menu;
use App\Services\MenuService;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    use ValidatesRequests;

    protected $menuService;
    public function __construct(
        MenuService $menuService,
    ) {
        $this->menuService = $menuService;
    }
    public function index()
    {
        try {
            $data['pageTitle'] = 'Admin Menu List';
            $data['pageDescription'] = 'BabVip CMS Admin Menu List';
            $menuData = $this->menuService->list()->with('childrenRecursive')->whereNull('parent_id')->orderBy('id','ASC')->get();
            return view('admin.menu.index', compact('data', 'menuData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Menu retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function addMenu()
    {
        try {
            $menuSortinID = 1;
            $data['pageTitle'] = 'Admin Menu Add';
            $data['pageDescription'] = 'BabVip CMS Admin Menu Add';
            $menuData = $this->menuService->list()->with('childrenRecursive')->whereNull('parent_id')->get();

            $menuSorting = $this->menuService->list()->whereNull('parent_id')->orderby('sort_id', 'DESC')->first();

            if ($menuSorting) {
                $menuSortinID = $menuSorting->sort_id + 1;
            }
            return view('admin.menu.add', compact('data', 'menuData', 'menuSortinID'));
        } catch (Exception $e) {
            Log::channel('database')->error('Menu retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function storeMenu(Request $request)
    {
        try {

            $this->validateRequest($request, Menu::validateRules(), Menu::validateMessages());

            $data = $request->all();
            $data['show_header'] = $data['show_header'] ?? 0;
            $data['show_footer'] = $data['show_footer'] ?? 0;
            $data['is_horizontal'] = $data['is_horizontal'] ?? 0;

            if (!empty($data['menu_image'])) {
                $menu_image = $this->upload($data['menu_image']);
                $data['menu_image']=$menu_image;
            }else{
                $data['menu_image']=null;

            }

            $this->menuService->create($data);
            return redirect('admin/menulist')->with('success', 'Section style created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function childMenuSortNumber(Request $request)
    {
        try {
            $data = $request->all();
            $sortId = 1;
            if ($data['parent_id'] !== 0) {
                $menuSorting = $this->menuService->list()->where('parent_id', $data['parent_id'])->orderby('sort_id', 'DESC')->first();
                if ($menuSorting) {
                    $sortId = $menuSorting->sort_id + 1;
                }
            } else {
                $menuSorting = $this->menuService->list()->where('parent_id', '0')->orderby('sort_id', 'DESC')->first();
                if ($menuSorting) {
                    $sortId = $menuSorting->sort_id + 1;
                }
            }

            $data = ['sortId' =>  $sortId];
            return response()->json($data);
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function editMenu($id)
    {
        try {
            $data['pageTitle'] = 'Admin Menu Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Menu Edit';
            $menuData = $this->menuService->list()->with('childrenRecursive')->whereNull('parent_id')->get();
            $menuRecord = $this->menuService->list()->where('id', $id)->first();

            return view('admin.menu.edit', compact('data', 'menuData', 'menuRecord'));
        } catch (Exception $e) {
            Log::channel('database')->error('Menu retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function menuNameExistance(Request $request)
    {
        try {
            $menuName = $request->menu_title;
            $exists = $this->menuService->checkmenuNameExistence($menuName);
            if ($exists) {
                return response()->json(['exists' => true], 200);
            } else {
                return response()->json(['exists' => false], 200);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    public function updataMenu($id, Request $request)
    {
        try {

            $this->validateRequest($request, Menu::validateRules(), Menu::validateMessages());
            $data = $request->all();
            $data['show_header'] = $data['show_header'] ?? 0;
            $data['show_footer'] = $data['show_footer'] ?? 0;
            $data['is_horizontal'] = $data['is_horizontal'] ?? 0;


            if (!empty($data['menu_image'])) {
                $menu_image = $this->upload($data['menu_image']);
                $data['menu_image']=$menu_image;
                $this->deleteImage($data['menu_image_old']);
            }else{
                $data['menu_image']=$data['menu_image_old'];
               }

            $this->menuService->updateSectionStyle($id, $data);
            return redirect('admin/menulist')->with('success', 'Menu updated successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Section Style Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function deleteMenu($id)
    {
        try {
            $this->menuService->delete($id);
            return redirect('admin/menulist')->with('success', 'Menu deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('menu delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function menuSorting()
    {
        try {
            $data['pageTitle'] = 'Admin Menu Sorting';
            $data['pageDescription'] = 'BabVip CMS Admin Menu Sorting';
            $menuList = $this->menuService->list()->whereNull('parent_id')->orderBy('sort_id', 'ASC')->get();
            return view('admin.menu.sorting', compact('data', 'menuList'));
        } catch (Exception $e) {
            Log::channel('database')->error('Menu Sorting retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function updateSortMenu(Request $request)
    {
        try {
            $items = $request->input('items');
            $this->updateMenuOrder($items);
            return response()->json(['message' => 'Menu order updated successfully.']);
        } catch (Exception $e) {
            Log::channel('database')->error('Menu Sorting retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    private function updateMenuOrder($items, $parentId = null)
    {
        try {
            foreach ($items as $index => $item) {
                $menu = Menu::find($item['id']);
                if ($menu) {

                    $menu->parent_id = $parentId;
                    $menu->sort_id = $index + 1;
                    $menu->save();
                    if (!empty($item['children'])) {
                        $this->updateMenuOrder($item['children'], $menu->id);
                    }
                }
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Menu Sorting retrieval failed', [
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
