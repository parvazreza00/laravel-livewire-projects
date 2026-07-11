<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class contactFormRequest extends Form
{
    #[Validate('required', message:'Please enter your name.')]
    #[Validate('regex:/^[A-Za-z\s]+$/', message:'Name may only contain letters and spaces.')]
    #[Validate('min:3', message:'Name must be at least 3 chars.')]
    #[Validate('max:50', message:'Name must not be greater than 50 chars.')]
    public $name;

    #[Validate('required', message:'Please enter your email.')]
    #[Validate('email', message:'Please enter valid email.')]
    public $email;

    #[Validate('required', message:'Please enter your phone number.')]
    #[Validate('digits:11', message:'Phone number must be 11 digits.')]
    public $phone;

    #[Validate('required', message:'Please enter your Message.')]
    #[Validate('min:5', message:'Message must be at least 5 chars.')]
    #[Validate('max:50', message:'Message must not be greater than 255 chars.')]
    public $message;

    #[Validate('required', message:'Please enter your gender.')]
    public $gender;

    #[Validate('required', message:'Please enter your Nationality.')]
    public $nationality;

    public $newsletter;
}
