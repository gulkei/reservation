<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemporaryRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'name' => [
        'required',
        'string',
        'max:255',
      ],
      'email' => [
        'required',
        'email:rfc,dns',
        'string',
        'max:255',
        'unique:users',
      ],
      'request' => [
        'max:255',
      ],
    ];
  }
}
