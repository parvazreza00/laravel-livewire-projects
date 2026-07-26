<?php

use Livewire\Component;

use Livewire\Attributes\Validate;
use App\Livewire\Forms\contactFormRequest;
use App\Models\Contact;

new class extends Component {

    public contactFormRequest $form;

    public function contformSubmit()
    {
        $this->form->validate();

        $contact = Contact::create($this->form->all());
        $this->form->reset();
        if($contact){
            session()->flash('success', 'Contact form submitted successfully.');
        }else{
            session()->flash('failed', 'Contact form submission failed.');
        }

    }
};
?>

<div>
    <div class="row mt-5">
        <div class="col-xl-6 m-auto">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('failed'))
                <div class="alert alert-danger">
                    {{ session('failed') }}
                </div>
            @enderror
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
                            <input type="text" id="name" wire:model.live="form.name" class="form-control"
                                placeholder="Enter Name">
                            @error('form.name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="text" id="email" class="form-control" wire:model.live="form.email"
                                placeholder="Enter Email">
                            @error('form.email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="phone">Phone</label>
                            <input type="text" id="phone" class="form-control" wire:model.live="form.phone"
                                placeholder="Enter Phone">
                            @error('form.phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" wire:model.live="form.message" placeholder="Message"> </textarea>
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
