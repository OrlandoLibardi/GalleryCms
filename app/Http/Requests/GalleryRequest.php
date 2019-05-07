<?php

namespace OrlandoLibardi\GalleryCms\app\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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

        switch($this->method()){
            case 'POST':
                $rules = [
                    'name'         => 'required|string|max:255',
                    'template'     => 'required'
                ];   
            break;    
            case 'PUT':
                $rules = [
                    'name'         => 'required|string|max:255',
                    'template'     => 'required'
                ]; 
            break;
            case 'PATCH':
                $rules = [
                    'status'         => 'required|min:0|max:1',
                ]; 
            break;
            case 'DELETE':
                $rules = [
                    'id.*' => 'required|exists:menus,id' 
                ];
            break;
            default:
                 $rules = [];
        }

        return $rules;

    
    }
    
}
