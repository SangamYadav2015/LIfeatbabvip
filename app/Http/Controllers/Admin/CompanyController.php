<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\CompanyService;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;

use App\Traits\ValidatesRequests;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    use ValidatesRequests;

    protected $companyService;

    public function __construct(
        CompanyService $companyService
    ) {
        $this->companyService = $companyService;
    }


     public function AddCompany()
     {
         try {
             $data['pageTitle'] = 'Admin Company List';
             $data['pageDescription'] = 'BabVip CMS Admin Company List';
          
             return view('admin.company.add_company');
         } catch (Exception $e) {
             Log::channel('database')->error('Company retrieval failed', [
                 'error' => $e->getMessage(),
                 'stack_trace' => $e->getTraceAsString(),
             ]);
             return response()->view('errors.500', [], 500);
         }
     }

     public function StoreCompany(Request $request)
{
    try {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255|unique:companies,company_name',
        ]);

        // Create a new company using the validated data
        $company = $this->companyService->create([
            'company_name' => $validatedData['company_name'],
        ]);

        // Redirect to the list of companies with a success message
        return redirect()->route('admin.companylist')->with('success', 'Company created successfully');
    } catch (Exception $e) {
        // Log the error and return a 500 error response
        Log::channel('database')->error('Company creation failed', [
            'error' => $e->getMessage(),
            'stack_trace' => $e->getTraceAsString(),
        ]);
        return response()->view('errors.500', [], 500);
    }
}

    public function AllCompany()
    {
        try {
            $data['pageTitle'] = 'Admin Company List';
            $data['pageDescription'] = 'BabVip CMS Admin Company List';
            $companies = $this->companyService->list()->paginate(10);
            return view('admin.company.all_company', compact('data', 'companies'));
        } catch (Exception $e) {
            Log::channel('database')->error('Company retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

  
  
   

    public function EditCompany($id)
    {
        try {

            $data['pageTitle'] = 'Admin Menu Edit';
            $data['pageDescription'] = 'BabVip CMS Admin Menu Edit';
           $companyRecord = $this->companyService->list()->where('id', $id)->first();


            return view('admin.company.edit_company', compact('data','companyRecord'));
        } catch (Exception $e) {
            Log::channel('database')->error('team data retrieval failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }
   
    public function UpdateCompany(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255|unique:companies,company_name,' . $id,
            ]);

            $this->companyService->update($validatedData, $id);
            return redirect()->route('admin.companylist')->with('success', 'Company created successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Company update failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

   
    public function DeleteCompany($id)
    {
        try {
            $this->companyService->delete($id);
            return redirect()->route('admin.companylist')->with('success', 'Company deleted successfully');
        } catch (Exception $e) {
            Log::channel('database')->error('Company deletion failed', [
                'error' => $e->getMessage(),
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    
   
}
