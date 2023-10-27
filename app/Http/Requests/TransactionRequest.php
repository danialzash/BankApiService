<?php

namespace App\Http\Requests;

use App\Rules\IranCreditCard;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TransactionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'from_card' => ['required', new IranCreditCard()],
            'to_card' => ['required', new IranCreditCard()],
            'amount' => 'required|numeric|min:1000|max:50000000'
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'amount' => convert_numbers_to_english($this->amount)
        ]);
    }


    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors();

        $response = response()->json([
            'message' => 'Invalid data send',
            'details' => $errors->messages(),
        ], 422);

        throw new HttpResponseException($response);
    }
}
