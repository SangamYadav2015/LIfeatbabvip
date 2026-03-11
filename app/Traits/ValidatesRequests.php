<?php
namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait ValidatesRequests
{

    protected function validateRequest(Request $request, array $rules, array $messages = [])
    {
        $validator = Validator::make($request->all(), $rules, $messages);
        return $validator;
    }

 
    /**
     * Get the custom messages for the example form.
     *
     * @return array
     */
    
}
