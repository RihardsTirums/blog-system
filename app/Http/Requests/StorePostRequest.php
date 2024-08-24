<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;

/**
 * Class StorePostRequest
 *
 * Handles authorization and validation for creating a new post.
 *
 * @package App\Http\Requests
 */
class StorePostRequest extends BasePostRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('create', Post::class);
    }
}