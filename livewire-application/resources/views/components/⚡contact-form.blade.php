<?php

use Livewire\Component;

new class extends Component {
    public $name;
    public $email;
    public $phone;
    public $message;
    public $gender;
    public $nationality;
    public $newsletter;

    public function contformSubmit(){
        dump([
            "name" => $this->name,
            "email" => $this->email,
            "phone" => $this->phone,
            "message" => $this->message,
            "nationality" => $this->nationality,
            "gender" => $this->gender,
            "newsletter" => $this->newsletter,
        ]);
    }
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
                        <input type="text" id="name" wire:model="name" class="form-control" placeholder="Enter Name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input type="text" id="email" class="form-control" wire:model="email" placeholder="Enter Email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control" wire:model="phone" placeholder="Enter Phone">
                    </div>
                    <div class="form-group mb-3">
                        <label for="message">Message</label>
                        <textarea id="message" class="form-control" wire:model="message" placeholder="Message"> </textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="phone">Nationality</label>
                        <select name="nationality" wire:model="nationality" id="nationality" class="form-select">
                            <option value="bangladesh">Banglaedsh</option>
                            <option value="india">India</option>
                            <option value="pakistan">Pakistan</option>
                            <option value="us">USA</option>
                        </select>

                    </div>

                    <div class="d-flex form-group mb-3">
                        <label for="gender">Gender : </label>
                        <div class="form-check ms-3">
                            <input type="radio" name="gender" wire:model="gender" id="male" value="male" class="form-check-input">
                            <label for="male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check ms-3">
                            <input type="radio" name="gender" wire:model="gender" id="female" value="female" class="form-check-input">
                            <label for="female" class="form-check-label">Female</label>
                        </div>
                    </div>
                    <div class="d-flex form-group mb-3">
                        <div class="form-check">
                            <input type="checkbox" value="yes" wire:model="newsletter" id="newsletter" class="form-check-input">
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
