<?php

namespace App\Http\Requests\Admin\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePerson extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.person.edit', $this->person);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firt_name' => ['sometimes', 'string'],
            'last_name' => ['sometimes', 'string'],
            'identification' => ['sometimes', 'string'],
            'email' => ['sometimes', 'email', 'string'],
            'telephone' => ['sometimes', 'string'],
            'address' => ['sometimes', 'string'],
            'birthday' => ['sometimes', 'date'],
            'gender' => ['sometimes', 'string'],
            'id_cities' => ['sometimes', 'string'],
            'specialties'=>[],
            'typesOfPeople'=>['required'],
        ];
    }

    /**
     * Modify input data
     *
     * @return array
     */
    public function getSanitized(): array
    {
        $sanitized = $this->validated();


        //Add your code for manipulation with request data here

        return $sanitized;
    }

    public function getSpecialties(): array
    {
        if ($this->has('specialties')) {
            $specialties = $this->get('specialties');
            return array_column($specialties, 'id');
        }
        return [];
    }

    public function getTypesOfPeople(): array
    {
        if ($this->has('typesOfPeople')) {
            $typesOfPeople = $this->get('typesOfPeople');
            return array_column($typesOfPeople, 'id');
        }
        return [];
    }
}
