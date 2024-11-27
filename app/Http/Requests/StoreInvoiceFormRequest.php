<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceFormRequest extends FormRequest
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
            'username' => 'required|string',
            'selectedVehicle' => 'required|string|min:6|max:7',
            
            'vehicles' => 'sometimes|array',
            'vehicles.*.model' => 'required|string',
            'vehicles.*.domain' => 'required|string|min:6|max:7|unique:vehicles,domain',
            'vehicles.*.greenCard' => 'sometimes|string',

            'replacements' => 'required|array',
            'replacements.*.replacement' => 'required|string',
            'replacements.*.unitPrice' => 'required|numeric',
            'replacements.*.quantity' => 'required|integer',

            'works' => 'required|array',
            'works.*.work' => 'required|string',
            'works.*.unitPrice' => 'required|numeric',
        ];
    }
}

