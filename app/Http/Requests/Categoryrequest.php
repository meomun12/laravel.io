<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Categoryrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|min:6|max:32',
            'description'=>'min:6',
            'status'=>'required',
        ];
    }
    public function message(){
        return[
            'name.required'=>'ten bat buoc nhap',
            'name.min'=>'ten tu 6 ki tu tro len',
            'name.max'=>'ten toi da 32 ki tu tro len ',
            'description.min'=>'mo ta toi thieu 6 ki tu',
            'description.max'=>'mo ta toi da 32 ki tu ',



        ];
    }
}
