<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function authorize(): bool
    {
        return $this->user()->name_slug === $this->route('profile') || Gate::allows('Admin');
    }

    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:10240'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore(User::where('name_slug', $this->route('profile'))->firstOrFail()->id)],
        ];
    }
}
