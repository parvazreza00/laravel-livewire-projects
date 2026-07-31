<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component {
    use WithFileUploads;

    // #[validate('required', message:"Please Give Your File")]
    // #[validate('mimes:pdf,doc,csv,xlx', message:"File type must be pdf,doc,csv,xlx")]

    // #[validate('mimes:png,jpg,jpeg,', message:"Image type must be png,jpg,jpeg")]
    #[validate('required', message: 'Please Give Your Any Image')]
    #[validate('max:2028', message: 'File is not greater than 2MB')]
    public $files = [];

    public function saveFile()
    {
        $responsefile = [];

        $this->validate();

        foreach ($this->files as $file) {
            $fileName = time() . '.' . $file->extension();

            $responsefile[] = $file->storeAs('uploads', $fileName);
        }

        dd($responsefile);
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
                    <input type="file" wire:model="files" class="form-control" multiple>
                    <div class="spinner-border" role="status" wire:loading wire:target="files">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    @error('files.*')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                    @if (count($files) > 0)
                        @foreach ($files as $file)
                            <img src="{{ $file->temporaryUrl() }}" alt="" class="img-fluid"
                                style="width: 100px;height: 100px;">
                        @endforeach
                    @endif
                </div>
                <div class="text-center mt-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>
