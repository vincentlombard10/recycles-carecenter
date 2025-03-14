<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'attachments' => ['nullable'],
            'audit_id' => ['nullable', 'integer'],
            'author_id' => ['nullable', 'integer'],
            'body' => ['nullable'],
            'html_body' => ['nullable'],
            'metadata' => ['nullable'],
            'plain_body' => ['nullable'],
            'public' => ['nullable', 'boolean'],
            'type' => ['nullable'],
            'uploads' => ['nullable'],
            'via' => ['required'],
            'ticket_id' => ['required', 'exists:tickets'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
