<?php

use App\Models\Menu;
use App\Models\Blogs;
use App\Models\Team;
use App\Models\Department;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\HelpCategory;
use App\Models\PostJob;
use App\Models\Location;

if (!function_exists('getFileContentStyleAdmin')) {
  function getFileContentStyleAdmin($fileName)
  {
    $filePath =  resource_path('views/admin/style-form-template/' . $fileName);
    if (file_exists($filePath)) {
      return file_get_contents($filePath);
    }
    return null;
  }
}


if (!function_exists('displayMenu')) {

  function displayMenu($item, $path = '')
  {
    $path .= ($path ? ' --> ' : '') . $item->title;
    echo '<li>';
    echo '<a href="' . route('admin.editMenu', ['num' => $item->id]) . '">' . $path . '</a>';
    if ($item->parent_id !== null) {
      echo ' <a href="' . route('admin.editMenu', ['num' => $item->id]) . '"><i data-feather="edit"></i></a>';
      echo ' <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlertMenu(\'' . $item->id . '\');"><i data-feather="trash-2"></i></a>';
      echo '<form id="delete-form-' . $item->id . '" action="' . route('admin.deleteMenu', ['num' => $item->id]) . '" method="POST" style="display: none;">';
      echo csrf_field();
      echo method_field('DELETE');
      echo '</form>';
    }
    // Check if the item has children
    if ($item->childrenRecursive->isNotEmpty()) {
      echo '<ul>';

      foreach ($item->childrenRecursive as $child) {
        displayMenu($child, $path);
      }

      echo '</ul>';
    } else {
      // Add edit and delete links with icons if the menu is the last item
      // echo ' <a href="' . route('admin.editMenu', ['num' => $item->id]) . '"><i data-feather="edit"></i></a>';
      // echo ' <a href="#" class="text-danger" onclick="event.preventDefault(); deleteAlert(\'' . $item->id . '\');"><i data-feather="trash-2"></i></a>';
      // echo '<form id="delete-form-' . $item->id . '" action="' . route('admin.deleteMenu', ['num' => $item->id]) . '" method="POST" style="display: none;">';
      // echo csrf_field();
      // echo method_field('DELETE');
      // echo '</form>';
    }

    echo '</li>';
  }
}


if (!function_exists('displayMenuSorting')) {
  function displayMenuSorting($item)
  {
    echo '<li data-item-id="' . $item->id . '">';
    echo '<div class="handle">' . $item->title . ' - Sort Order: ' . $item->sort_id . '</div>';

    // Check if there are children
    if ($item->childrenRecursive->isNotEmpty()) {
      // Sort children by sort_id ASC
      $children = $item->childrenRecursive->sortBy('sort_id');

      echo '<ul class="nested-sortable sortable-list">';
      foreach ($children as $child) {
        displayMenuSorting($child);
      }
      echo '</ul>';
    }

    echo '</li>';
  }
}

if (!function_exists('decodeData')) {
  function decodeData($pageData)
  {
    return json_decode($pageData, true);
  }
}


if (!function_exists('checkBannerBGImage')) {
  function checkBannerBGImage($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['banner_bg_image'])) {
      return $pageSectionData['banner_bg_image'];
    }
    return null;
  }
}
if (!function_exists('checkBannerImage')) {
  function checkBannerImage($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['banner_image'])) {
      return $pageSectionData['banner_image'];
    }
    return null;
  }
}
if (!function_exists('checkTopClientImage')) {
  function checkTopClientImage($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['top_client_image'])) {
      return $pageSectionData['top_client_image']; // return as array
    }
    return null;
  }
}
if (!function_exists('checkBanner1Image')) {
  function checkBanner1Image($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['banner_image1'])) {
      return $pageSectionData['banner_image1'];
    }
    return null;
  }
}

if (!function_exists('checkBanner2Image')) {
  function checkBanner2Image($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['banner_image2'])) {
      return $pageSectionData['banner_image2'];
    }
    return null;
  }
}

if (!function_exists('checkBanner3Image')) {
  function checkBanner3Image($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['banner_image3'])) {
      return $pageSectionData['banner_image3'];
    }
    return null;
  }
}

if (!function_exists('checkClientReview')) {
  function checkClientReview($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['review'])) {
      return $pageSectionData['review'];
    }
    return null;
  }
}

if (!function_exists('checktestimoni')) {
  function checktestimoni($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['review'])) {
      return $pageSectionData['review'];
    }
    return null;
  }
}


if (!function_exists('siteMenu')) {
  function siteMenu()
  {
    $menus = Menu::with('childrenRecursive')->whereNull('parent_id')
      ->where('status', 'active')
      ->orderBy('sort_id')
      ->get();
    return $menus;
  }
}

if (!function_exists('getPageSlug')) {
  function getPageSlug($pageData)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData['page_slug'])) {
      return $pageSectionData['page_slug'];
    }
    return null;
  }
}

if (!function_exists('getPageDataDecode')) {
  function getPageDataDecode($pageData, $key)
  {
    $pageSectionData = json_decode($pageData, true);
    if (isset($pageSectionData[$key])) {
      return $pageSectionData[$key];
    }
    return null;
  }
}

if (!function_exists('renderMenu')) {
  function renderMenu($items)
  {
    $html = '<ul class="dropdown-menu border-0 rounded-custom shadow py-0 bg-white">';
    $html .= '<div class="dropdown-grid rounded-custom width-full">';

    foreach ($items as $item) {
      $menuSlug = $item->pages ? url(getPageSlug($item->pages->page_data)) : 'javascript:void(0)';
      $html .= '<div class="dropdown-grid-item">';
      $html .= '<a href="' . $menuSlug . '"><h6 class="drop-heading">' . $item->title . '</h6></a>';
      if ($item->childrenRecursive->isNotEmpty()) {
        foreach ($item->childrenRecursive as $child) {
          $childSlug = $child->pages ? url(getPageSlug($child->pages->page_data)) : 'javascript:void(0)';

          $html .= '<a href="' . $childSlug . '" class="dropdown-link">';
          $html .= '<span class="demo-list bg-primary rounded text-white fw-bold"></span>';
          $html .= '<div class="dropdown-info">';
          $html .= '<div class="drop-title">' . $child->title . '</div>';
          $html .= '</div></a>';
        }
      }

      $html .= '</div>';
    }

    $html .= '</div></ul>';
    return $html;
  }
}

if (!function_exists('getFooterMenu')) {
  function getFooterMenu($menuIdArray)
  {
    $menus = Menu::with('pages')->whereIn('id', $menuIdArray)
      ->where('status', 'active')
      ->orderBy('sort_id')
      ->get();
    return $menus;
  }
}

if (!function_exists('getlatestthreeBlogs')) {
  function getlatestthreeBlogs()
  {
    $blogs = Blogs::with('category')->where('status', '1')->orderBy('id', 'DESC')->limit(3)
      ->get();
    return $blogs;
  }
}


if (!function_exists('getBlogsPagignate')) {
  function getBlogsPagignate()
  {
    $blogs = Blogs::with('category', 'user')->where('status', '1')->orderBy('id', 'DESC')->paginate(11);
    return $blogs;
  }
}

if (!function_exists('getLatestTeamMember')) {
  function getLatestTeamMember()
  {
    $team = Team::where('status', 'active')->orderBy('id', 'DESC')->limit(8)
      ->get();
    return $team;
  }
}

if (!function_exists('getTeamMember')) {
  function getTeamMember()
  {
    $team = Team::where('status', 'active')->orderBy('id', 'DESC')->limit(8)
      ->get();
    return $team;
  }
}

if (!function_exists('extractPageNameAndLineNumber')) {
  function extractPageNameAndLineNumber($stackTrace)
  {
    // Initialize an empty array to store the results
    $result = [];

    // Regular expression to match file path and line number
    $pattern = '/(C:\\\\xampp\\\\htdocs\\\\[^\\(]+)\\((\\d+)\\)/';

    // Perform the matching
    preg_match_all($pattern, $stackTrace, $matches, PREG_SET_ORDER);

    // Process the matches
    foreach ($matches as $match) {
      $result[] = [
        'file' => $match[1],
        'line' => $match[2]
      ];
    }

    return $result;
  }
}
if (!function_exists('getMenuUserRole')) {
  function getMenuUserRole($id)
  {
    $departmentId =  Auth::user()->department_id;
    $designation =  Auth::user()->designation;
    $user = User::with(['userRole' => function ($query) use ($departmentId, $designation) {
      $query->where('department_id', $departmentId)->where('id', $designation);
    }])->where('id', $id)->first();
    return $user;
  }
}

if (!function_exists('inArrayCheck')) {
  function inArrayCheck($key, $array)
  {
    if (!in_array($key, $array)) {
      return false;
    }
    return true;
  }
}

if (!function_exists('displayMenuOption')) {

  function displayMenuOption($item, $path = '', $depth = 0, $selectedId = null)
  {
    // Construct the path with arrows for hierarchy representation
    $displayText = ($path ? $path . ' --> ' : '') . $item->title;

    // Determine if the current item should be selected
    $isSelected = $item->id == $selectedId ? 'selected' : '';

    // Output the option tag with the menu id as the value and selected if applicable
    echo '<option value="' . $item->id . '" ' . $isSelected . ' item-data="' . $item->title . '">' . str_repeat('&nbsp;', $depth * 4) . $displayText . '</option>';

    // Check if the item has children
    if ($item->childrenRecursive->isNotEmpty()) {
      // Loop through each child and call the function recursively
      foreach ($item->childrenRecursive as $child) {
        if ($child->menu_slug === null) {
          displayMenuOption($child, $displayText, $depth + 1, $selectedId);
        }
      }
    }
  }

  if (!function_exists('gethelpCategory')) {
    function gethelpCategory()
    {
      $helpFaqData = HelpCategory::with('helpFaq')->where('status', '1')->orderBy('category_name', 'ASC')
        ->get();
      return $helpFaqData;
    }
  }

  if (!function_exists('getFirstptag')) {
    function getFirstptag($htmlContent)
    {
      $dom = new \DOMDocument();
      libxml_use_internal_errors(true); // Prevent errors due to malformed HTML
      $dom->loadHTML($htmlContent);
      libxml_clear_errors();

      // Get all paragraph elements
      $paragraphs = $dom->getElementsByTagName('p');

      // Get the first paragraph if it exists
      $firstParagraph = '';
      if ($paragraphs->length > 0) {
        $firstParagraph = $dom->saveHTML($paragraphs->item(0));
      }

      return $firstParagraph;
    }
  }
}

if (!function_exists('getFirst200Words')) {
  function getFirst20Words($htmlContent)
  {
      // Strip tags to remove any HTML elements
      $textContent = strip_tags($htmlContent);

      // Split the text into an array of words
      $wordsArray = preg_split('/\s+/', $textContent, -1, PREG_SPLIT_NO_EMPTY);

      // Get the first 200 words
      $first200Words = array_slice($wordsArray, 0, 20);

      // Reassemble them into a string
      $result = implode(' ', $first200Words);

      return $result;
  }
}

if (!function_exists('getImageType')) {

function getImageType($imageName)
{
    $fileExtension = pathinfo($imageName, PATHINFO_EXTENSION);

    switch (strtolower($fileExtension)) {
        case 'jpg':
        case 'jpeg':
            return 'image/jpeg';
        case 'png':
            return 'image/png';
        case 'gif':
            return 'image/gif';
        case 'bmp':
            return 'image/bmp';
        case 'webp':
            return 'image/webp';
        case 'tiff':
        case 'tif':
            return 'image/tiff';
        case 'svg':
            return 'image/svg+xml';
        default:
            return 'unknown';
    }
}
}


if (!function_exists('getParentMenu')) {

  function getParentMenu($parentId)
  {
  $parentItem = Menu::where('id', $parentId)->first();
  if($parentItem){
    return $parentItem->title;

  }else{
    return 0;
  }
  }
}



if (!function_exists('getjobData')) {
  function getjobData()
  {
    $blogs = PostJob::where('status', operator: 'active')->orderBy('id', 'DESC')->limit(1000)
      ->get();
    return $blogs;
  }
}


if (!function_exists('getalljob')) {
  function getalljob($locationId = null, $jobTypeId = null, $departmentId = null)
  {
      $query = PostJob::where('status', 'active')->orderBy('id', 'DESC');

      // Apply location filter if provided
      if ($locationId) {
          $query->where('location_id', $locationId);
      }

      // Apply job type filter if provided
      if ($jobTypeId) {
          $query->where('type', $jobTypeId);
      }

      // Apply department filter if provided
      if ($departmentId) {
          $query->where('department_id', $departmentId);
      }

      return $query->get();
  }
}


if (!function_exists('getLatestdepartment')) {
  function getLatestdepartment()
  {
    $team = Department::where('status', 'active')->orderBy('id', 'DESC')->limit(12)
      ->get();
    return $team;
  }

  if (!function_exists('getlocationData')) {
    function getlocationData()
    {
      $blogs = Location::where('status', operator: 'active')->orderBy('id', 'DESC')->limit(1000)
        ->get();
      return $blogs;
    }
  }
}