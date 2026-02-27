<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransacaoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'valor' => 'required|numeric|min:0',
            'cpf' => 'required|string|max:14',
            // 'status' => 'in:em_processamento,aprovada,negada',
            'arquivo' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'valor.min' => "Campo valor menor que o permitido",
            'valor.required' => "Campo valor é obrigatório",
            'cpf.required' => "Campo CPF é obrigatório",
            'cpf.max' => "CPF informado inválido",
        ];
    }
}
