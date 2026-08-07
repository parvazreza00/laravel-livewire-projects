<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use App\Models\Employee;
use Illuminate\Validation\Rule;

class employeeFrom extends Form
{
    public ?Employee $employee = null;

    #[Validate('required', message: 'Please enter your name.')]
    #[Validate('min:3', message: 'Name must be at least 3 characters.')]
    #[Validate('max:50', message: 'Name must be at most 50 characters.')]
    public $name;

    #[Validate('required', message: 'Please enter your phone')]
    #[Validate('digits:11', message: 'Phone number must be exactly 11 digits')]
    #[Validate('regex:/^01[3-9]\d{8}$/', message: 'Please enter a valid 11-digit Bangladeshi phone number')]
    public $phone;

    #[Validate('required', message: 'Please enter joning date.')]
    #[Validate('date', message: 'Joning date must be date.')]
    #[Validate('before_or_equal:today', message: 'Joining date cannot be a future date.')]
    public $joining_date;

    #[Validate('required', message: 'Enter employee salary.')]
    #[Validate('numeric', message: 'Salary must be valid number.')]
    #[Validate('gt:0', message: 'Salary must be greater than 0.')]
    public $salary;

    #[Validate('required', message: 'Enter department name')]
    #[Validate('min:2', message: 'Department name at least 5 characters')]
    #[Validate('max:50', message: 'Department name at most 50 characters')]
    public $department;

    #[Validate('required', message: 'Enter designation name')]
    #[Validate('min:3', message: 'Designation name at least 5 characters')]
    #[Validate('max:50', message: 'Designation name at most 50 characters')]
    public $designation;

    #[Validate('required', message: 'Plese select any one gender name')]
    public $gender;

    public $email;
    public $photo;

    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('employees', 'email')
                    ->ignore($this->employee?->id),
            ],

            'photo' => $this->employee
                ? 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Please enter your email.',
            'email.email'    => 'Please enter a valid email.',
            'email.unique'   => 'Email already exists.',

            'photo.required' => 'Employee photo is required.',
            'photo.image'    => 'Please upload a valid image.',
            'photo.mimes'    => 'Photo must be JPG, JPEG, PNG, or WEBP.',
            'photo.max'      => 'Photo size must not exceed 2 MB.',
        ];
    }

    private function generateEmployeeId()
    {
        $latestEmployee = Employee::latest('id')->first();
        if (!$latestEmployee) {
            return 'EMP-00001';
        }
        $lastNumber = (int) str_replace('EMP-', '', $latestEmployee->employee_id);
        $nextNumber = $lastNumber + 1;

        return 'EMP-' . str_pad($nextNumber, 5, 0, STR_PAD_LEFT);
    }

    public function store($imagePath)
    {
        return Employee::create([
            'employee_id' => $this->generateEmployeeId(),
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'designation' => $this->designation,
            'department' => $this->department,
            'gender' => $this->gender,
            'joining_date' => $this->joining_date,
            'salary' => $this->salary,
            'photo' => $imagePath,

        ]);
    }

    public function update($employee, $imagePath)
    {
        return $employee->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'designation' => $this->designation,
            'department' => $this->department,
            'gender' => $this->gender,
            'joining_date' => $this->joining_date,
            'salary' => $this->salary,
            'photo' => $imagePath,
        ]);
    }
}
