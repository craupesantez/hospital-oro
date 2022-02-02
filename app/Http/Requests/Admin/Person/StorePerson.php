<?php

namespace App\Http\Requests\Admin\Person;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StorePerson extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Gate::allows('admin.person.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'firt_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'identification' => ['required', 'string','max:10'],
            'email' => ['required', 'email', 'string'],
            'telephone' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string'],
            'birthday' => ['required', 'date'],
            'gender' => ['required', 'string'],
            'id_cities' => ['required', 'string'],
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
