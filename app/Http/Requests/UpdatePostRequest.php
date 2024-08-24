<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Gate;

/**
 * Class UpdatePostRequest
 *
 * Handles authorization and validation for updating an existing post.
 *
 * @package App\Http\Requests
 */
class UpdatePostRequest extends BasePostRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('update', $this->route('post'));
    }
}