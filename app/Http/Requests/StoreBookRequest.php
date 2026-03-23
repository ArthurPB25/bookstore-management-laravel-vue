<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' =>['required', 'string', 'max:255'],
            'author' =>['required', 'string', 'max:255'],
            'isbn' =>['required', 'string', 'unique:books,isbn'],
            'price' =>['required', 'numeric', 'min:0'],
            'publication_date' =>['required', 'date'],
            'category_id' =>['required', 'exists:categories,id'],
        ];
        
    }
    public function messages(): array{
            return[
                'required' => 'O campo :attribute é obrigatório',
                'isbn.unique' => 'Este ISBN já está cadastrado no sistema',
                'category_id.exists' => 'A categoria selecionada é invalida',
                'price.numeric' => 'O preço deve ser um valor numérico válido',
            ];
    }
}
