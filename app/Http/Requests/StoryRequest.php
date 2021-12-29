<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoryRequest extends FormRequest
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
        $storyId = $this->route('story.id');
        return [
            'title' => [
                'required', 'min:10', 'max:50',
                //fail when user inputs dummy title in input field
                function ($attribute, $value, $fail) {
                    if ($value == 'Dummy Title') {
                        $fail($attribute . ' is not valid');
                    }
                },
                //ignore title has already been taken validation when editing
                Rule::unique('stories')->ignore($storyId)
            ],
            'body' => ['required', 'min:50'],
            'type' => ['required'],
            'status' => ['required'],
            'image' => 'sometimes|mimes:jpeg,jpg,png'
        ];
    }

    // custom messages for validation errors
    public function messages()
    {
        // 'title.required' => 'Please enter title'
        return [
            'required' => 'Please enter :attribute'
        ];
    }

    public function withValidator($v)
    {
        // body should have a max of 200 characters when type is short
        $v->sometimes('body', 'max:200', function ($input) {
            return 'short' == $input->type;
        });
    }
}
