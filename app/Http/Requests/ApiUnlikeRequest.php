<?php
namespace App\Http\Requests;

use App\Http\Requests\LikeRequest;
use Auth;
class ApiUnlikeRequest  extends LikeRequest
{
    public function authorize()
    {
        return Auth::guard('api')->user()->can('unlike', $this->likeable());
    }
}