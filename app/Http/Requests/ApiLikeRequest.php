<?php
namespace App\Http\Requests;

use App\Contracts\Likeable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use App\post_comment;
use Auth;
class ApiLikeRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::guard('api')->user()->can('like', $this->likeable());
    }

    public function rules()
    {
        return [
            'id' => [
                "required",
                function ($attribute, $value, $fail) {

                    if (! post_comment::where('id', $value)->exists()) {
                        $fail($value . " does not exists in database");
                    }
                },
            ],
        ];
    }

    public function likeable(): Likeable
    {

        return post_comment::findOrFail($this->input('id'));
    }
}