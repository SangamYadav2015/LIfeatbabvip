<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSection;
use Illuminate\Http\Request;
use App\Services\PageSectionService;
use App\Services\SectionService;
use App\Services\PageService;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Traits\ValidatesRequests;
use App\Models\SectionStyle;
use App\Services\SectionStyleService;
use Illuminate\Support\Facades\Validator;

class PageSectionController extends Controller
{
    use ValidatesRequests;

    protected $pageSectionService;
    protected $sectionService;
    protected $pageService;

    protected $sectionStyleService;

    public function __construct(
        PageSectionService $pageSectionService,
        SectionService $sectionService,
        PageService $pageService,
        SectionStyleService $sectionStyleService,
    ) {
        $this->pageSectionService = $pageSectionService;
        $this->sectionService = $sectionService;
        $this->pageService = $pageService;
        $this->sectionStyleService = $sectionStyleService;
    }


    public function index($pageId)
    {
        try {
            $data['pageTitle'] = 'Admin Page Section List';
            $data['pageDescription'] = 'BabVip CMS Admin Page Section List';
            $pageData = $this->pageService->list()->with(['menu'])->where('id', $pageId)->first();
            $pageSectionData = $this->pageSectionService->list()
                ->with(['page', 'section', 'sectionStyle', 'page.menu']) // Ensure nested relationship for menu
                ->where('page_id', $pageId)->orderBy('sort_id', 'ASC')
                ->get();


            return view('admin.pagesection.index', compact('data', 'pageSectionData', 'pageData'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page Section retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function addPageSection($pageId,)
    {
        try {
            $sortingId = 1;
            $data['pageTitle'] = 'Admin Create Page Section';
            $data['pageDescription'] = 'BabVip CMS Admin Create Page Section';
            $SectionDataPage = $this->pageSectionService->list()->where('page_id', $pageId)->orderBy('sort_id', 'DESC')->first();
            if ($SectionDataPage) {
                $sortingId = $SectionDataPage->sort_id  + 1;
            }
            $pageData = $this->pageService->list()->with(['menu'])->where('id', $pageId)->first();
            $sections = $this->sectionService->sectionList()->where('status', '1')->get();
            return view('admin.pagesection.add', compact('data', 'sections', 'pageData', 'sortingId'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page Section Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function dynamicSectionStyle(Request $request)
    {
        try {
            $sectionId = $request->section_id;
            $sectionsStyle = $this->sectionStyleService->sectionStyleList()
                ->where('section_id', $sectionId)
                ->where('status', '1')
                ->get(['id as style_id', 'section_style_name as style_name']) // Fetch first
                ->sortBy(function ($item) {
                    return preg_replace('/[^0-9]/', '', $item->style_name); // Extract numeric part
                });
            if ($sectionsStyle->isEmpty()) {
                return response()->json(['message' => 'No section styles found for the selected section']);
            }
            return response()->json($sectionsStyle);
        } catch (Exception $e) {
            Log::channel('database')->error('Page Section Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function secionDynamicForm(Request $request)
    {
        try {
            $sectionId = $request->section_id;
            $sectionsStyleId = $request->section_style_id;
            $sectionsStyle = $this->sectionStyleService->sectionStyleList()
                ->where('section_id', $sectionId)->where('id', $sectionsStyleId)->where('status', '1');
            $countStyle = $sectionsStyle->count();
            if ($countStyle === 0) {
                return response()->json(['message' => 'No section styles found for the selected section']);
            }
            $sectionsStyle = $sectionsStyle->first();
            $content = getFileContentStyleAdmin($sectionsStyle->file_path);
            return response()->json(['file_content' => $content, 'image_preview' => $sectionsStyle->preview_image],);
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function styleImagePreview(Request $request)
    {
        try {
            $sectionId = $request->section_id;
            $sectionsStyleId = $request->section_style_id;

            $sectionsStyle = $this->sectionStyleService->sectionStyleList()
                ->where('section_id', $sectionId)
                ->where('id', $sectionsStyleId)
                ->where('status', '1')
                ->first();

            if (empty($sectionsStyle) || empty($sectionsStyle->preview_image)) {
                return response()->json(['message' => 'No Image Exist']);
            }

            return response()->json([
                'image_preview' => $sectionsStyle->preview_image
            ]);
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function pageSectionChangeStatus(Request $request)
    {
        try {
            $id = $request->id;
            $data = array(
                'status' => $request->status,
            );
            $this->pageSectionService->update($data, $id);
            return response()->json(['message' => 'Page section status updated successfully', 'status' => 200]);
        } catch (Exception $e) {
            Log::channel('database')->error('Page section status change failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function savePageSectionSorting(Request $request)
    {
        $data = $request->all();
        foreach ($data['sortInformation'] as $key => $sortInformationId) {
            $subinformation = PageSection::find($sortInformationId);
            $subinformation->sort_id = $key;
            $subinformation->save();
        }
    }

    public function editPageSection($id)
    {
        try {
            $sortingId = 1;
            $data['pageTitle'] = 'Admin Edit Page Section';
            $data['pageDescription'] = 'BabVip CMS Admin Edit Page Section';
            $SectionDataPage = $this->pageSectionService->list()->where('id', $id)->orderBy('sort_id', 'DESC')->first();
            $pageData = $this->pageService->list()->with(['menu'])->where('id', $SectionDataPage->page_id)->first();
            $sections = $this->sectionService->sectionList()->where('status', '1')->get();
            return view('admin.pagesection.edit', compact('data', 'sections', 'pageData', 'SectionDataPage'));
        } catch (Exception $e) {
            Log::channel('database')->error('Page Section Add', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function pageSectionStore(Request $request, $id = null)
    {

        try {
            $this->validateRequest($request, PageSection::validateRules(), PageSection::validateMessages());

            $data = $request->all();
            $sectionId = $request->section_id;
            $sectionStyleId = $request->section_style_id;
            $pageId = $request->page_id;
            $sectionsStyledata = $this->sectionStyleService->sectionStyleList()->where('section_id', $sectionId)->where('id', $sectionStyleId)->first();
            //for hero section//
            if ($sectionId === '1') {
                $storeData =  $this->heroSectionDataSet($sectionsStyledata, $request, $id);
            }
            //for hero section//
            //for Testimonial section//
            if ($sectionId === '2') {
                $storeData =  $this->testimoniSectionDataSet($sectionsStyledata, $request, $id);
            }
            //for Testimonial section//

            //for call to action section//
            if ($sectionId === '3') {
                $storeData =  $this->calltoactionSectionDataSet($sectionsStyledata, $request, $id);
            }
            //for call to action section//

            //for tab section//
            if ($sectionId === '4') {
                $storeData =  $this->tabSectionDataSet($sectionsStyledata, $request, $id);
            }
            //for service  section//
            if ($sectionId === '5') {
                $storeData =  $this->serviceSectionDataSet($sectionsStyledata, $request, $id);
            }
            //for work Process  section//
            if ($sectionId === '6') {
                $storeData =  $this->workProcessDataSet($sectionsStyledata, $request, $id);
            }

            //for Pricing  section//
            if ($sectionId === '7') {
                $storeData =  $this->pricingDataSet($sectionsStyledata, $request, $id);
            }
            //for Faq  section//
            if ($sectionId === '8') {
                $storeData =  $this->faqDataSet($sectionsStyledata, $request, $id);
            }
            //for Feature  section//
            if ($sectionId === '9') {
                $storeData =  $this->featureDataSet($sectionsStyledata, $request, $id);
            }

            //for Feature  section//
            if ($sectionId === '10') {
                $storeData =  $this->intigrationDataSet($sectionsStyledata, $request, $id);
            }
            //for Our Team  section//
            if ($sectionId === '11') {
                $storeData =  $this->teamDataSet($sectionsStyledata, $request, $id);
            }

            //for Our Blog  section//            
            if ($sectionId === '12') {
                $storeData =  $this->blogDataSet($sectionsStyledata, $request, $id);
            }

            if ($sectionId === '13') {
                $storeData =  $this->contactDataSet($sectionsStyledata, $request, $id);
            }

            if ($sectionId === '14') {
                $storeData =  $this->helpcenterDataSet($sectionsStyledata, $request, $id);
            }

            if ($sectionId === '15') {
                $storeData =  $this->carrieSsetData($sectionsStyledata, $request, $id);
            }

            if ($sectionId === '16') {
                $storeData =  $this->departmentDataSet($sectionsStyledata, $request, $id);
            }
           if ($sectionId === '18') {
                $storeData =  $this->portflioDataSet($sectionsStyledata, $request, $id);
            }
              if ($sectionId === '19') {
                $storeData =  $this->privacyTermsDataSet($sectionsStyledata, $request, $id);
            }




            //for validation error section//
            if ($storeData instanceof \Illuminate\Http\RedirectResponse) {
                return $storeData;
            }
            //for validation error section//



            if ($id === null) {
                $this->pageSectionService->insert($storeData);
                return redirect('admin/pagesectionlist/' . $pageId)->with('success', 'Page section created successfully');
            } else {
                $this->pageSectionService->updateSave($id, $storeData);
                return redirect('admin/pagesectionlist/' . $pageId)->with('success', 'Page section updated successfully');
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

  public function heroSectionDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            // Define validation and preparation methods for each hero section style
            $heroSectionStyles = [
                'Style 1' => ['validate' => 'validateHeroStyle1', 'prepare' => 'prepareHeroSectionstyle1'],
                'Style 2' => ['validate' => 'validateHeroStyle2', 'prepare' => 'prepareHeroSectionstyle2'],
                'Style 3' => ['validate' => 'validateHeroStyle3', 'prepare' => 'prepareHeroSectionstyle3'],
                'Style 4' => ['validate' => 'validateHeroStyle4', 'prepare' => 'prepareHeroSectionstyle4'],
                'Style 5' => ['validate' => 'validateHeroStyle5', 'prepare' => 'prepareHeroSectionstyle5'],
                'Style 6' => ['validate' => 'validateHeroStyle6', 'prepare' => 'prepareHeroSectionstyle6'],
                'Style 7' => ['validate' => 'validateHeroStyle7', 'prepare' => 'prepareHeroSectionstyle7'],
                'Style 8' => ['validate' => 'validateHeroStyle8', 'prepare' => 'prepareHeroSectionstyle8'],
                'Style 9' => ['validate' => 'validateHeroStyle9', 'prepare' => 'prepareHeroSectionstyle9'],
                'Style 10' => ['validate' => 'validateHeroStyle10', 'prepare' => 'prepareHeroSectionstyle10'],
                'Style 11' => ['validate' => 'validateHeroStyle11', 'prepare' => 'prepareHeroSectionstyle11'],
                'Style 12' => ['validate' => 'validateHeroStyle12', 'prepare' => 'prepareHeroSectionstyle12'],
                'Style 13' => ['validate' => 'validateHeroStyle13', 'prepare' => 'prepareHeroSectionstyle13'],
                'Style 14' => ['validate' => 'validateHeroStyle14', 'prepare' => 'prepareHeroSectionstyle13'],
                'Style 15' => ['validate' => 'validateHeroStyle15', 'prepare' => 'prepareHeroSectionstyle15'],
                'Style 16' => ['validate' => 'validateHeroStyle16', 'prepare' => 'prepareHeroSectionstyle16'],
                'Style 17' => ['validate' => 'validateHeroStyle17', 'prepare' => 'prepareHeroSectionstyle17'],
                'Style 18' => ['validate' => 'validateHeroStyle18', 'prepare' => 'prepareHeroSectionstyle18'],
                'Style 19' => ['validate' => 'validateHeroStyle19', 'prepare' => 'prepareHeroSectionstyle19'],
                'Style 20' => ['validate' => 'validateHeroStyle20', 'prepare' => 'prepareHeroSectionstyle20'],
                'Style 21' => ['validate' => 'validateHeroStyle21', 'prepare' => 'prepareHeroSectionstyle21'],
                'Style 22' => ['validate' => 'validateHeroStyle22', 'prepare' => 'prepareHeroSectionstyle22'],
                'Style 23' => ['validate' => 'validateHeroStyle23', 'prepare' => 'prepareHeroSectionstyle23'],
                'Style 24' => ['validate' => 'validateHeroStyle24', 'prepare' => 'prepareHeroSectionstyle24'],
                'Style 25' => ['validate' => 'validateHeroStyle25', 'prepare' => 'prepareHeroSectionstyle25'],
                'Style 26' => ['validate' => 'validateHeroStyle26', 'prepare' => 'prepareHeroSectionstyle26'],
                'Style 27' => ['validate' => 'validateHeroStyle27', 'prepare' => 'prepareHeroSectionstyle27'],
                'Style 28' => ['validate' => 'validateHeroStyle28', 'prepare' => 'prepareHeroSectionstyle28'],
                'Style 29' => ['validate' => 'validateHeroStyle29', 'prepare' => 'prepareHeroSectionstyle29'],
                'Style 30' => ['validate' => 'validateHeroStyle30', 'prepare' => 'prepareHeroSectionstyle30'],
                'Style 31' => ['validate' => 'validateHeroStyle31', 'prepare' => 'prepareHeroSectionstyle30'],
                'Style 32' => ['validate' => 'validateHeroStyle32', 'prepare' => 'prepareHeroSectionstyle30'],
                'Style 33' => ['validate' => 'validateHeroStyle33', 'prepare' => 'prepareHeroSectionstyle33'],
                'Style 34' => ['validate' => 'validateHeroStyle34', 'prepare' => 'prepareHeroSectionstyle34'],
                'Style 35' => ['validate' => 'validateHeroStyle35', 'prepare' => 'prepareHeroSectionstyle35'],
                'Style 36' => ['validate' => 'validateHeroStyle36', 'prepare' => 'prepareHeroSectionstyle36'],
                'Style 37' => ['validate' => 'validateHeroStyle37', 'prepare' => 'prepareHeroSectionstyle37'],
                'Style 38' => ['validate' => 'validateHeroStyle38', 'prepare' => 'prepareHeroSectionstyle38'],
                'Style 39' => ['validate' => 'validateHeroStyle39', 'prepare' => 'prepareHeroSectionstyle39'],
                'Style 40' => ['validate' => 'validateHeroStyle40', 'prepare' => 'prepareHeroSectionstyle40'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            // Check if it's a hero section
            if ($sectionId === '1' && isset($heroSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $heroSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput(); // Preserve the input data
                }
                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function testimoniSectionDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            // Define validation and preparation methods for each hero section style
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validatetestimoniStyle1', 'prepare' => 'preparTestimoniSectionstyle1'],
                'Style 2' => ['validate' => 'validatetestimoniStyle2', 'prepare' => 'preparTestimoniSectionstyle2'],
                'Style 3' => ['validate' => 'validatetestimoniStyle3', 'prepare' => 'preparTestimoniSectionstyle3'],
                'Style 4' => ['validate' => 'validatetestimoniStyle4', 'prepare' => 'preparTestimoniSectionstyle4'],
                'Style 5' => ['validate' => 'validatetestimoniStyle5', 'prepare' => 'preparTestimoniSectionstyle5'],
                'Style 6' => ['validate' => 'validatetestimoniStyle6', 'prepare' => 'preparTestimoniSectionstyle6'],
                'Style 7' => ['validate' => 'validatetestimoniStyle7', 'prepare' => 'preparTestimoniSectionstyle1'],
                'Style 8' => ['validate' => 'validatetestimoniStyle7', 'prepare' => 'preparTestimoniSectionstyle1'],
                'Style 9' => ['validate' => 'validatetestimoniStyle9', 'prepare' => 'preparTestimoniSectionstyle5'],
                'Style 10' => ['validate' => 'validatetestimoniStyle7', 'prepare' => 'preparTestimoniSectionstyle1'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            // Check if it's a hero section
            if ($sectionId === '2' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }




    public function calltoactionSectionDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            // Define validation and preparation methods for each hero section style
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validatecalltoactionStyle1', 'prepare' => 'preparCalltoActionSectionstyle1'],
                'Style 2' => ['validate' => 'validatecalltoactionStyle2', 'prepare' => 'preparCalltoActionSectionstyle2'],
                'Style 3' => ['validate' => 'validatecalltoactionStyle3', 'prepare' => 'preparCalltoActionSectionstyle3'],
                'Style 4' => ['validate' => 'validatecalltoactionStyle4', 'prepare' => 'preparCalltoActionSectionstyle4'],
                'Style 5' => ['validate' => 'validatecalltoactionStyle5', 'prepare' => 'preparCalltoActionSectionstyle5'],
                'Style 6' => ['validate' => 'validatecalltoactionStyle6', 'prepare' => 'preparCalltoActionSectionstyle6'],
                'Style 7' => ['validate' => 'validatecalltoactionStyle7', 'prepare' => 'preparCalltoActionSectionstyle7'],
                'Style 8' => ['validate' => 'validatecalltoactionStyle8', 'prepare' => 'preparCalltoActionSectionstyle8'],
                'Style 9' => ['validate' => 'validatecalltoactionStyle9', 'prepare' => 'preparCalltoActionSectionstyle8'],
                'Style 10' => ['validate' => 'validatecalltoactionStyle8', 'prepare' => 'preparCalltoActionSectionstyle8'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            // Check if it's a hero section
            if ($sectionId === '3' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function tabSectionDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validatetabStyle1', 'prepare' => 'preparetabstyle1'],
                'Style 2' => ['validate' => 'validatetabStyle2', 'prepare' => 'preparetabstyle2'],
                'Style 3' => ['validate' => 'validatetabStyle3', 'prepare' => 'preparetabstyle3'],
                'Style 4' => ['validate' => 'validatetabStyle4', 'prepare' => 'preparetabstyle4'],
                'Style 5' => ['validate' => 'validatetabStyle5', 'prepare' => 'preparetabstyle5'],
                'Style 6' => ['validate' => 'validatetabStyle6', 'prepare' => 'preparetabstyle6'],
                'Style 7' => ['validate' => 'validatetabStyle7', 'prepare' => 'preparetabstyle7'],
                'Style 8' => ['validate' => 'validatetabStyle8', 'prepare' => 'preparetabstyle7'],
                'Style 9' => ['validate' => 'validatetabStyle8', 'prepare' => 'preparetabstyle7'],
                'Style 10' => ['validate' => 'validatetabStyle10', 'prepare' => 'preparetabstyle10'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '4' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function serviceSectionDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validateserviceStyle1', 'prepare' => 'prepareservicestyle1'],
                'Style 2' => ['validate' => 'validateserviceStyle1', 'prepare' => 'prepareservicestyle1'],
                'Style 3' => ['validate' => 'validateserviceStyle1', 'prepare' => 'prepareservicestyle3'],
                'Style 4' => ['validate' => 'validateserviceStyle4', 'prepare' => 'prepareservicestyle4'],
                'Style 5' => ['validate' => 'validateserviceStyle5', 'prepare' => 'prepareservicestyle5'],
                'Style 6' => ['validate' => 'validateserviceStyle6', 'prepare' => 'prepareservicestyle6'],
                'Style 7' => ['validate' => 'validateserviceStyle7', 'prepare' => 'prepareservicestyle7'],
                'Style 8' => ['validate' => 'validateserviceStyle8', 'prepare' => 'prepareservicestyle8'],
                'Style 9' => ['validate' => 'validateserviceStyle9', 'prepare' => 'prepareservicestyle9'],
                'Style 10' => ['validate' => 'validateserviceStyle9', 'prepare' => 'prepareservicestyle9'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '5' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function workProcessDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validateworktyle1', 'prepare' => 'prepareworkstyle1'],
                'Style 2' => ['validate' => 'validateworktyle2', 'prepare' => 'prepareworkstyle2'],
                'Style 3' => ['validate' => 'validateworktyle2', 'prepare' => 'prepareworkstyle2'],
                'Style 4' => ['validate' => 'validateworktyle4', 'prepare' => 'prepareworkstyle4'],
                'Style 5' => ['validate' => 'validateworktyle5', 'prepare' => 'prepareworkstyle5'],
                'Style 6' => ['validate' => 'validateworktyle6', 'prepare' => 'prepareworkstyle6'],
                'Style 7' => ['validate' => 'validateworktyle7', 'prepare' => 'prepareworkstyle7'],
                'Style 8' => ['validate' => 'validateworktyle8', 'prepare' => 'prepareworkstyle8'],
                'Style 9' => ['validate' => 'validateworktyle9', 'prepare' => 'prepareworkstyle9'],
                'Style 10' => ['validate' => 'validateworktyle10', 'prepare' => 'prepareworkstyle10'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '6' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function pricingDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validatepricestyle1', 'prepare' => 'prepareplanstyle1'],
                'Style 2' => ['validate' => 'validatepricestyle2', 'prepare' => 'prepareplanstyle2'],
                'Style 3' => ['validate' => 'validatepricestyle1', 'prepare' => 'prepareplanstyle1'],
                'Style 4' => ['validate' => 'validatepricestyle4', 'prepare' => 'prepareplanstyle4'],
                'Style 5' => ['validate' => 'validatepricestyle5', 'prepare' => 'prepareplanstyle5'],
                'Style 6' => ['validate' => 'validatepricestyle6', 'prepare' => 'prepareplanstyle6'],
                'Style 7' => ['validate' => 'validatepricestyle7', 'prepare' => 'prepareplanstyle7'],
                'Style 8' => ['validate' => 'validatepricestyle8', 'prepare' => 'prepareplanstyle8'],
                'Style 9' => ['validate' => 'validatepricestyle9', 'prepare' => 'prepareplanstyle9'],
                'Style 10' => ['validate' => 'validatepricestyle10', 'prepare' => 'prepareplanstyle10'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '7' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];
                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function faqDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validatefaqstyle1', 'prepare' => 'preparefaqstyle1'],
                'Style 2' => ['validate' => 'validatefaqstyle2', 'prepare' => 'preparefaqstyle2'],
                'Style 3' => ['validate' => 'validatefaqstyle3', 'prepare' => 'preparefaqstyle3'],
                'Style 4' => ['validate' => 'validatefaqstyle4', 'prepare' => 'preparefaqstyle4'],
                'Style 5' => ['validate' => 'validatefaqstyle5', 'prepare' => 'preparefaqstyle1'],
                'Style 6' => ['validate' => 'validatefaqstyle6', 'prepare' => 'preparefaqstyle6'],
                'Style 7' => ['validate' => 'validatefaqstyle7', 'prepare' => 'preparefaqstyle7'],
                'Style 8' => ['validate' => 'validatefaqstyle8', 'prepare' => 'preparefaqstyle7'],
                'Style 9' => ['validate' => 'validatefaqstyle9', 'prepare' => 'preparefaqstyle9'],
                'Style 10' => ['validate' => 'validatefaqstyle10', 'prepare' => 'preparefaqstyle10'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '8' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function featureDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validatefeaturetyle1', 'prepare' => 'prepareFeaturestyle1'],
                'Style 2' => ['validate' => 'validatefeaturetyle2', 'prepare' => 'prepareFeaturestyle1'],
                'Style 3' => ['validate' => 'validatefeaturetyle3', 'prepare' => 'prepareFeaturestyle3'],
                'Style 4' => ['validate' => 'validatefeaturetyle4', 'prepare' => 'prepareFeaturestyle4'],
                'Style 5' => ['validate' => 'validatefeaturetyle5', 'prepare' => 'prepareFeaturestyle5'],
                'Style 6' => ['validate' => 'validatefeaturetyle6', 'prepare' => 'prepareFeaturestyle1'],
                'Style 7' => ['validate' => 'validatefeaturetyle5', 'prepare' => 'prepareFeaturestyle5'],
                'Style 8' => ['validate' => 'validatefeaturetyle5', 'prepare' => 'prepareFeaturestyle5'],
                'Style 9' => ['validate' => 'validatefeaturetyle9', 'prepare' => 'prepareFeaturestyle9'],
                'Style 10' => ['validate' => 'validatefeaturetyle9', 'prepare' => 'prepareFeaturestyle9'],
                'Style 11' => ['validate' => 'validatefeaturetyle11', 'prepare' => 'prepareFeaturestyle11'],
                'Style 12' => ['validate' => 'validatefeaturetyle12', 'prepare' => 'prepareFeaturestyle12'],
                'Style 13' => ['validate' => 'validatefeaturetyle13', 'prepare' => 'prepareFeaturestyle13'],
                'Style 14' => ['validate' => 'validatefeaturetyle14', 'prepare' => 'prepareFeaturestyle14'],
                'Style 15' => ['validate' => 'validatefeaturetyle15', 'prepare' => 'prepareFeaturestyle15'],
                'Style 16' => ['validate' => 'validatefeaturetyle16', 'prepare' => 'prepareFeaturestyle16'],
                'Style 17' => ['validate' => 'validatefeaturetyle17', 'prepare' => 'prepareFeaturestyle17'],
                'Style 18' => ['validate' => 'validatefeaturetyle18', 'prepare' => 'prepareFeaturestyle18'],
                'Style 19' => ['validate' => 'validatefeaturetyle19', 'prepare' => 'prepareFeaturestyle19'],
                'Style 20' => ['validate' => 'validatefeaturetyle20', 'prepare' => 'prepareFeaturestyle20'],
                'Style 21' => ['validate' => 'validatefeaturetyle21', 'prepare' => 'prepareFeaturestyle21'],
                'Style 22' => ['validate' => 'validatefeaturetyle22', 'prepare' => 'prepareFeaturestyle22'],
                'Style 23' => ['validate' => 'validatefeaturetyle23', 'prepare' => 'prepareFeaturestyle23'],
                'Style 24' => ['validate' => 'validatefeaturetyle24', 'prepare' => 'prepareFeaturestyle24'],
                'Style 25' => ['validate' => 'validatefeaturetyle25', 'prepare' => 'prepareFeaturestyle25'],
                'Style 26' => ['validate' => 'validatefeaturetyle26', 'prepare' => 'prepareFeaturestyle26'],
                'Style 27' => ['validate' => 'validatefeaturetyle27', 'prepare' => 'prepareFeaturestyle27'],
                'Style 28' => ['validate' => 'validatefeaturetyle28', 'prepare' => 'prepareFeaturestyle28'],
                'Style 29' => ['validate' => 'validatefeaturetyle29', 'prepare' => 'prepareFeaturestyle29'],
                'Style 30' => ['validate' => 'validatefeaturetyle28', 'prepare' => 'prepareFeaturestyle28'],
                'Style 31' => ['validate' => 'validatefeaturetyle31', 'prepare' => 'prepareFeaturestyle31'],
                'Style 32' => ['validate' => 'validatefeaturetyle32', 'prepare' => 'prepareFeaturestyle32'],
                'Style 33' => ['validate' => 'validatefeaturetyle33', 'prepare' => 'prepareFeaturestyle33'],
                'Style 34' => ['validate' => 'validatefeaturetyle34', 'prepare' => 'prepareFeaturestyle34'],
                'Style 35' => ['validate' => 'validatefeaturetyle35', 'prepare' => 'prepareFeaturestyle35'],
                'Style 36' => ['validate' => 'validatefeaturetyle36', 'prepare' => 'prepareFeaturestyle36'],
                'Style 37' => ['validate' => 'validatefeaturetyle37', 'prepare' => 'prepareFeaturestyle37'],
                'Style 38' => ['validate' => 'validatefeaturetyle38', 'prepare' => 'prepareFeaturestyle38'],
                'Style 39' => ['validate' => 'validatefeaturetyle39', 'prepare' => 'prepareFeaturestyle39'],
                'Style 40' => ['validate' => 'validatefeaturetyle40', 'prepare' => 'prepareFeaturestyle40'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '9' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }



    public function intigrationDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validateintigrationstyle1', 'prepare' => 'prepareIntigrationstyle1'],
                'Style 2' => ['validate' => 'validateintigrationstyle2', 'prepare' => 'prepareIntigrationstyle2'],
                'Style 3' => ['validate' => 'validateintigrationstyle3', 'prepare' => 'prepareIntigrationstyle3'],
                'Style 4' => ['validate' => 'validateintigrationstyle4', 'prepare' => 'prepareIntigrationstyle3'],
                'Style 5' => ['validate' => 'validateintigrationstyle5', 'prepare' => 'prepareIntigrationstyle3'],
                'Style 6' => ['validate' => 'validateintigrationstyle6', 'prepare' => 'prepareIntigrationstyle6'],
                'Style 7' => ['validate' => 'validateintigrationstyle7', 'prepare' => 'prepareIntigrationstyle7'],
                'Style 8' => ['validate' => 'validateintigrationstyle8', 'prepare' => 'prepareIntigrationstyle8'],
                'Style 9' => ['validate' => 'validateintigrationstyle9', 'prepare' => 'prepareIntigrationstyle9'],
                'Style 10' => ['validate' => 'validateintigrationstyle10', 'prepare' => 'prepareIntigrationstyle10'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '10' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function blogDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validateblogstyle1', 'prepare' => 'prepareblogstyle1'],
                'Style 2' => ['validate' => 'validateblogstyle2', 'prepare' => 'prepareblogstyle1'],
                'Style 3' => ['validate' => 'validateblogstyle3', 'prepare' => 'prepareblogstyle1'],
                'Style 4' => ['validate' => 'validateblogstyle4', 'prepare' => 'prepareblogstyle1'],
                'Style 5' => ['validate' => 'validateblogstyle1', 'prepare' => 'prepareblogstyle1'],
                'Style 6' => ['validate' => 'validateblogstyle6', 'prepare' => 'prepareblogstyle1'],
                'Style 7' => ['validate' => 'validateblogstyle7', 'prepare' => 'prepareblogstyle1'],
                'Style 8' => ['validate' => 'validateblogstyle8', 'prepare' => 'prepareblogstyle1'],
                'Style 9' => ['validate' => 'validateblogstyle9', 'prepare' => 'prepareblogstyle1'],
                'Style 10' => ['validate' => 'validateblogstyle2', 'prepare' => 'prepareblogstyle1'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '12' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function teamDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'validateteamstyle1', 'prepare' => 'prepareteamstyle1'],
                'Style 2' => ['validate' => 'validateteamstyle1', 'prepare' => 'prepareteamstyle1'],
                'Style 3' => ['validate' => 'validateteamstyle3', 'prepare' => 'prepareteamstyle1'],
                'Style 4' => ['validate' => 'validateteamstyle3', 'prepare' => 'prepareteamstyle1'],
                'Style 5' => ['validate' => 'validateteamstyle3', 'prepare' => 'prepareteamstyle1'],
                'Style 6' => ['validate' => 'validateteamstyle3', 'prepare' => 'prepareteamstyle1'],
                'Style 7' => ['validate' => 'validateteamstyle7', 'prepare' => 'prepareteamstyle7'],
                'Style 8' => ['validate' => 'validateteamstyle3', 'prepare' => 'prepareteamstyle1'],
                'Style 9' => ['validate' => 'validateteamstyle9', 'prepare' => 'prepareteamstyle7'],
                'Style 10' => ['validate' => 'validateteamstyle10', 'prepare' => 'prepareteamstyle1'],

            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '11' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function contactDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'contactstyle1', 'prepare' => 'preparecontacttyle1'],
                'Style 2' => ['validate' => 'contactstyle2', 'prepare' => 'preparecontacttyle2'],
                'Style 3' => ['validate' => 'contactstyle3', 'prepare' => 'preparecontacttyle3'],
                'Style 4' => ['validate' => 'contactstyle4', 'prepare' => 'preparecontacttyle4'],
                'Style 5' => ['validate' => 'contactstyle5', 'prepare' => 'preparecontacttyle5'],
                'Style 6' => ['validate' => 'contactstyle6', 'prepare' => 'preparecontacttyle5'],
                'Style 7' => ['validate' => 'contactstyle7', 'prepare' => 'preparecontacttyle5'],
                'Style 8' => ['validate' => 'contactstyle8', 'prepare' => 'preparecontacttyle5'],
                'Style 9' => ['validate' => 'contactstyle9', 'prepare' => 'preparecontacttyle5'],
                'Style 10' => ['validate' => 'contactstyle10', 'prepare' => 'preparecontacttyle5'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '13' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }


    public function helpcenterDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'helpCenterstyle1', 'prepare' => 'preparehelpcenterstyle1'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '14' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function portflioDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'portfoliostyle1', 'prepare' => 'preparePortfoliostyle1'],
                'Style 2' => ['validate' => 'portfoliostyle2', 'prepare' => 'preparePortfoliostyle2'],
                'Style 3' => ['validate' => 'portfoliostyle3', 'prepare' => 'preparePortfoliostyle3'],
                'Style 4' => ['validate' => 'portfoliostyle4', 'prepare' => 'preparePortfoliostyle4'],
                'Style 5' => ['validate' => 'portfoliostyle4', 'prepare' => 'preparePortfoliostyle4'],
                'Style 6' => ['validate' => 'portfoliostyle6', 'prepare' => 'preparePortfoliostyle4'],
                'Style 7' => ['validate' => 'portfoliostyle7', 'prepare' => 'preparePortfoliostyle7'],
                'Style 8' => ['validate' => 'portfoliostyle4', 'prepare' => 'preparePortfoliostyle4'],
                'Style 9' => ['validate' => 'portfoliostyle9', 'prepare' => 'preparePortfoliostyle9'],
                'Style 10' => ['validate' => 'portfoliostyle10', 'prepare' => 'preparePortfoliostyle9'],
                'Style 11' => ['validate' => 'portfoliostyle4', 'prepare' => 'preparePortfoliostyle9'],
                'Style 12' => ['validate' => 'portfoliostyle12', 'prepare' => 'preparePortfoliostyle12'],
                'Style 13' => ['validate' => 'portfoliostyle13', 'prepare' => 'preparePortfoliostyle13'],
                'Style 14' => ['validate' => 'portfoliostyle14', 'prepare' => 'preparePortfoliostyle14'],
                'Style 15' => ['validate' => 'portfoliostyle15', 'prepare' => 'preparePortfoliostyle15'],
                'Style 16' => ['validate' => 'portfoliostyle16', 'prepare' => 'preparePortfoliostyle16'],
                'Style 17' => ['validate' => 'portfoliostyle17', 'prepare' => 'preparePortfoliostyle17'],
                'Style 18' => ['validate' => 'portfoliostyle18', 'prepare' => 'preparePortfoliostyle1'],
                'Style 19' => ['validate' => 'portfoliostyle18', 'prepare' => 'preparePortfoliostyle1'],
                'Style 20' => ['validate' => 'portfoliostyle18', 'prepare' => 'preparePortfoliostyle1'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '15' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function privacyTermsDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'privacyTermsstyle1', 'prepare' => 'privacyTermsstyle1'],
                'Style 2' => ['validate' => 'privacyTermsstyle2', 'prepare' => 'privacyTermsstyle1'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '16' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
    public function carrieSsetData($sectionsStyleData, $request, $id = null)
    {
        try {
            $testimoniSectionStyles = [
                'Style 1' => ['validate' => 'careerstyle1', 'prepare' => 'preparecareerstyle1'],
                'Style 2' => ['validate' => 'careerstyle1', 'prepare' => 'preparecareerstyle1'],
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '15' && isset($testimoniSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $testimoniSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function departmentDataSet($sectionsStyleData, $request, $id = null)
    {
        try {
            $departmentSectionStyles = [
                'Style 1' => ['validate' => 'validatedepartmentstyle1', 'prepare' => 'prepareDepartmentstyle1'],
            
            ];
            $sectionId = $request->section_id;
            $data = $request->all();
            if ($sectionId === '16' && isset($departmentSectionStyles[$sectionsStyleData->section_style_name])) {
                $style = $departmentSectionStyles[$sectionsStyleData->section_style_name];

                $validator = Validator::make($request->all(), PageSection::{$style['validate']}($id));
                if ($validator->fails()) {

                    return redirect()->back()->withErrors($validator)->withInput();
                }

                return  $this->pageSectionService->{$style['prepare']}($data);
            }
        } catch (Exception $e) {
            Log::channel('database')->error('Page File Content Get', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    public function deletePageSection($id, $pageId)
    {
        try {
            $this->pageSectionService->delete($id);
            return redirect('admin/pagesectionlist/'.$pageId)->with('success', 'Page section deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('page delete', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
    
}
