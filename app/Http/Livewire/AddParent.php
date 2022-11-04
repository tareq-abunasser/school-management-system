<?php

namespace App\Http\Livewire;

use App\Models\Blood;
use App\Models\MyParent;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AddParent extends Component
{
    public $successMessage = '';

    public $catchError;

    public $currentStep = 1,

        // Father_INPUTS
        $email, $password,
        $father_name, $father_name_en,
        $father_national_id, $father_passport_id,
        $father_phone, $father_job, $father_job_en,
        $father_nationality_id, $father_blood_type_id,
        $father_address, $father_religion_id,

        // Mother_INPUTS
        $mother_name, $mother_name_en,
        $mother_national_id, $mother_passport_id,
        $mother_phone, $mother_job, $mother_job_en,
        $mother_nationality_id, $mother_blood_type_id,
        $mother_address, $mother_religion_id;


    protected $rules = [
        'email' => 'required|email',
        'father_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'father_passport_id' => 'min:10|max:10',
        'father_phone' => 'min:10|regex:/^([0-9\s\-\+\(\)]*)$/',
        'mother_national_id' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
        'mother_passport_id' => 'min:10|max:10',
        'mother_phone' => 'min:10|regex:/^([0-9\s\-\+\(\)]*)$/'
    ];

    // this is used for real time validation
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submit()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.add-parent', [
            'nationalities' => Nationality::all(),
            'bloods' => Blood::all(),
            'religions' => Religion::all(),
        ]);

    }

    public function next()
    {
        if ($this->currentStep <= 2) {
            $this->currentStep++;
        }

    }


    public function back()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }

    }

    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|unique:my_parents,email,' . $this->id,
            'password' => 'required',
            'father_name' => 'required',
            'father_name_en' => 'required',
            'father_job' => 'required',
            'father_job_en' => 'required',
            'father_national_id' => 'required|unique:my_parents,father_national_id,' . $this->id,
            'father_passport_id' => 'required|unique:my_parents,father_passport_id,' . $this->id,
            'father_phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'father_nationality_id' => 'required',
            'father_blood_type_id' => 'required',
            'father_religion_id' => 'required',
            'father_address' => 'required',
        ]);

        $this->next();
    }


    public function secondStepSubmit()
    {

        $this->validate([
            'mother_name' => 'required',
            'mother_name_en' => 'required',
            'mother_national_id' => 'required|unique:my_parents,mother_national_id,' . $this->id,
            'mother_passport_id' => 'required|unique:my_parents,mother_passport_id,' . $this->id,
            'mother_phone' => 'required',
            'mother_job' => 'required',
            'mother_job_en' => 'required',
            'mother_nationality_id' => 'required',
            'mother_blood_type_id' => 'required',
            'mother_religion_id' => 'required',
            'mother_address' => 'required',
        ]);

        $this->next();
    }

    public function submitForm()
    {


        try {
            $parent = new MyParent();

            $parent->email = $this->email;
            $parent->password = Hash::make($this->password);

            // Father_INPUTS
            $parent->father_name = ["ar" => $this->father_name, "en" => $this->father_name_en];
            $parent->father_national_id = $this->father_national_id;
            $parent->father_passport_id = $this->father_passport_id;
            $parent->father_phone = $this->father_phone;
            $parent->father_job = ["ar" => $this->father_job, "en" => $this->father_job_en];
            $parent->father_nationality_id = $this->father_nationality_id;
            $parent->father_blood_type_id = $this->father_blood_type_id;
            $parent->father_address = $this->father_address;
            $parent->father_religion_id = $this->father_religion_id;

            // Mother_INPUTS
            $parent->mother_name = ["ar" => $this->mother_name, "en" => $this->mother_name_en];
            $parent->mother_name_en = $this->mother_name_en;
            $parent->mother_national_id = $this->mother_national_id;
            $parent->mother_passport_id = $this->mother_passport_id;
            $parent->mother_phone = $this->mother_phone;
            $parent->mother_job = ["ar" => $this->mother_job, "en" => $this->mother_job_en];
            $parent->mother_nationality_id = $this->mother_nationality_id;
            $parent->mother_blood_type_id = $this->mother_blood_type_id;
            $parent->mother_address = $this->mother_address;
            $parent->mother_religion_id = $this->mother_religion_id;


            $parent->save();
            $this->successMessage = trans('messages.success');
            $this->clearForm();
            $this->currentStep = 1;
        } catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };


    }

    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->father_name = '';
        $this->father_name_en = '';
        $this->father_national_id = '';
        $this->father_passport_id = '';
        $this->father_phone = '';
        $this->father_job = '';
        $this->father_job_en = '';
        $this->father_nationality_id = '';
        $this->father_blood_type_id = '';
        $this->father_address = '';
        $this->father_religion_id = '';
        $this->mother_name = '';
        $this->mother_name_en = '';
        $this->mother_national_id = '';
        $this->mother_passport_id = '';
        $this->mother_phone = '';
        $this->mother_job = '';
        $this->mother_job_en = '';
        $this->mother_nationality_id = '';
        $this->mother_blood_type_id = '';
        $this->mother_address = '';
        $this->mother_religion_id = '';
    }


}
