<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ResetRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }

  public function rules()
  {
    return [
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|max:255|confirmed',
    ];
  }
}
