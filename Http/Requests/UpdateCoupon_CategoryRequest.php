<?php

namespace Modules\Icommerce\Http\Requests;

use Modules\Core\Internationalisation\BaseFormRequest;

class UpdateCoupon_CategoryRequest extends BaseFormRequest
{
    public function rules()
    {
        return [];
    }

    public function translationRules()
    {
        return [];
    }

    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [];
    }

    public function translationMessages()
    {
        return [];
    }
}