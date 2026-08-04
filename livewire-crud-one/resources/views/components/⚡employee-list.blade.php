<?php

use Livewire\Component;

new class extends Component
{

};
?>

<div>

    <div class="container my-4">
        <div class="row border-bottom my-3">
            <div class="col-md-10 col-lg-10">
               <h4 class="fw-bold text-center">Livewire - 4 - Employee CRUD </h4>
            </div>
            <div class="col-md-2 col-lg-2">
                <a wire:navigate href="{{ route('add.employee') }}" class="btn btn-primary btn-sm fw-bold">ADD EMPLOYEE</a>
            </div>
        </div>

    </div>

</div>
