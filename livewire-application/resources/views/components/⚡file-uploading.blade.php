<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    #[validate('required', message:"Please Give Your File")]
    #[validate('mimes:pdf,doc,csv,xlx', message:"File type must be pdf,doc,csv,xlx")]
    #[validate('max:2028', message:"File is not greater than 2MB")]
    public $file;

    public function saveFile()
    {
        $this->validate();

        dd($this->file);
    }
};
?>

<div>
    <div class="row">
        <div class="col-xl-6 m-auto">
            <h1 class="text-center">File Uploading - Livewire 4</h1>
            <form wire:submit="saveFile">
                <div>
                    <label for="file">File-Upload</label>
                    <input type="file" wire:model="file" class="form-control">
                    @error('file')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
