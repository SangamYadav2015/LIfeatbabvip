<?php

namespace App\Imports;

use App\Models\Company;
use App\Models\Department;
use App\Models\Location;
use App\Models\PostJob;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PostJobImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Validate the row data
        // dd($row);
        $companyId=0;
        $departmentId=0;
        $locationId=0;
        $disClosedSalary=1;
        $status='active';
        if (Company::where('company_name', $row['company_name'])->exists()) {
           $company= Company::where('company_name', $row['company_name'])->first();
           $companyId = $company->id; 
           $status='active';
        }else{
            $status='inactive';

         }
        if (Department::where('Department_name', $row['department_name'])->exists()) {
            $department= Department::where('Department_name', $row['department_name'])->first();
            $departmentId = $department->id; 
            $status='active';

         }else{
            $status='inactive';

         }

         if (Location::where('location_name', $row['location_name'])->exists()) {
            $location= Location::where('location_name', $row['location_name'])->first();
            $locationId = $location->id; 

         }else{
            $status='inactive';

         }
         if($row['min_salary'] !== '' && $row['max_salary'] !== ''){
            $disClosedSalary=0;
         }
         $jobSlug = preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($row['job_title']));

         if (!PostJob::where('company_id', $companyId)->where('department_id', $departmentId)->where('location_id', $locationId)->where('title', $row['job_title'])->exists()) {

            return new PostJob([
            'title'             => $row['job_title'],
            'description'       => $row['job_description'],
            'job_slug'          => $jobSlug,
            'company_id'        => $companyId,
            'department_id'     =>  $departmentId,
            'location_id'       => $locationId,
            'type'              => $row['job_typefull_time_part_time_contract_temporary_internship'],
            'designation'       => $row['job_designation'],
            'minimum_salary'    => $row['min_salary'],
            'maximum_salary'    => $row['max_salary'],
            'status'            => $status,
            'salary_disclosed'  => $disClosedSalary,
            
        ]);
    }
    }
}
