<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttachmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'content_type' => ['nullable'],
            'content_url' => ['nullable'],
            'deleted' => ['nullable', 'boolean'],
            'file_name' => ['nullable'],
            'height' => ['nullable'],
            'inline' => ['nullable', 'boolean'],
            'malware_access_override' => ['nullable', 'boolean'],
            'malware_scan_result' => ['nullable'],
            'mapped_content_url' => ['nullable'],
            'size' => ['nullable', 'integer'],
            'thumbnails' => ['nullable'],
            'url' => ['nullable'],
            'width' => ['nullable'],
            'comment_id' => ['nullable', 'exists:comments'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
