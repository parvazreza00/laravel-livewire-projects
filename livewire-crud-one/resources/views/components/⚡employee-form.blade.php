<?php

use Livewire\Component;

new class extends Component {};
?>

<div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <h4>Create Employee</h4>
                            </div>
                            <div class="col-md-6 col-lg-6 text-end">
                                <a wire:navigate href="{{ route('employees') }}" class="btn btn-dark btn-sm">GO
                                    BACK</a>
                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <h1>Emploee Create form</h1>

                    </div>
                    <div class="card-footer">
                        <a href="" class="btn btn-success btn-sm fs-5">Save</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
