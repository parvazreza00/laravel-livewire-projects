<?php

use Livewire\Component;

use Livewire\Attributes\Validate;
use App\Livewire\Forms\contactFormRequest;

new class extends Component {

    public contactFormRequest $form;

    public function contformSubmit()
    {
        $this->validate();
        // $this->validate([
        //     'name' => 'required|min:3|max:50|regex:/^[A-Za-z\s]+$/',
        //     'email' => 'required|email',
        //     'phone' => 'required|min:11|max:11',
        //     'message' => 'required|min:5|max:255',
        //     'nationality' => 'required',
        //     'gender' => 'required',
        // ]);
        dump([
            'name' => $this->form->name,
            'email' => $this->form->email,
            'phone' => $this->form->phone,
            'message' => $this->form->message,
            'nationality' => $this->form->nationality,
            'gender' => $this->form->gender,
            'newsletter' => $this->form->newsletter,
        ]);
    }

    // protected function messages(){
    //     return[
    //         'name.required' => "Please enter your name",
    //         'name.regex' => "Name may only contain letters and spaces.",
    //         'email.required' => "Please enter your name",
    //         'email.email' => "Please enter valid email",
    //         'phone.required' => "Please enter your phone number",
    //         'phone.digits' => "Please enter valid phone number",
    //         'phone.min' => "Please enter min 11 chars",
    //         'phone.max' => "Please enter max 11 chars",
    //         'message.required' => "Please enter Message",
    //         'message.min' => "Please enter Min 5 chars Message",
    //         'message.max' => "Please enter not more than 255 chars Message",
    //         'nationality.required' => "Please enter your nationality",
    //         'gender.required' => "Please enter your gender",
    //     ];

    // }
};
?>

<div>
    <div class="row mt-5">
        <div class="col-xl-6 m-auto ">
            <form wire:submit="contformSubmit">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="card-title text-center">
                            <h1>Contact form</h1>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label for="name">UserName</label>
                            <input type="text" id="name" wire:model="form.name" class="form-control"
                                placeholder="Enter Name">
                            @error('form.name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" id="email" class="form-control" wire:model="form.email"
                                placeholder="Enter Email">
                            @error('form.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control" wire:model="form.phone"
                                placeholder="Enter Phone">
                            @error('form.phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" wire:model="form.message" placeholder="Message"> </textarea>
                            @error('form.message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Nationality</label>
                            <select name="nationality" wire:model="form.nationality" id="nationality" class="form-select">
                                <option value="bangladesh">Banglaedsh</option>
                                <option value="india">India</option>
                                <option value="pakistan">Pakistan</option>
                                <option value="us">USA</option>
                            </select>
                            @error('form.nationality')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>

                        <div class="form-group mb-3">
                            <div class="d-flex">
                                <label for="gender">Gender : </label>
                                <div class="form-check ms-3">
                                    <input type="radio" name="gender" wire:model="form.gender" id="male"
                                        value="male" class="form-check-input">
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check ms-3">
                                    <input type="radio" name="gender" wire:model="form.gender" id="female"
                                        value="female" class="form-check-input">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                            </div>
                            @error('form.gender')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex form-group mb-3">
                            <div class="form-check">
                                <input type="checkbox" value="yes" wire:model="form.newsletter" id="newsletter"
                                    class="form-check-input">
                                <label for="male" class="form-check-label">Subscribe our newsletter</label>
                            </div>
                        </div>

                    </div>
                    <div class="card-footer">
                        <button class="btn btn-success" type="submit">Submit</button>

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
