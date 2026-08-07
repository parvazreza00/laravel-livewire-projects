<?php

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Forms\employeeFrom;
use App\Models\Employee;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    public employeeFrom $form;
    public $currentPhoto;
    public $employee = null;
    public $isEdit = null;

    public function mount(Employee $employee)
    {
        $this->isEdit = request()->routeIs('edit.employee');

        if ($employee->id) {
            $this->employee = $employee;
            $this->form->employee = $employee;

            $this->form->name = $employee->name;
            $this->form->email = $employee->email;
            $this->form->phone = $employee->phone;
            $this->form->salary = $employee->salary;
            $this->form->joining_date = $employee->joining_date;
            $this->form->designation = $employee->designation;
            $this->form->department = $employee->department;
            $this->form->gender = $employee->gender;
            $this->currentPhoto = $employee->photo;
        }
    }


    public function saveEmployee()
    {
        $this->form->validate();
        $imagePath = $this->employee?->photo;

        if ($this->form->photo) {
            if ($this->employee && $this->employee->photo && Storage::disk('public')->exists($this->employee->photo)) {
                Storage::disk('public')->delete($this->employee->photo);
            }
            $imageName = time() . '.' . $this->form->photo->extension();
            $imagePath = $this->form->photo->storeAs('uploads/employees/', $imageName, 'public');
        }

        if ($this->employee) {
            $empUpdate = $this->form->update($this->employee, $imagePath);
            if ($empUpdate) {
                session()->flash('success', 'Employee updated successfully.');
            } else {
                session()->flash('error', 'Employee updated failed.');
            }
        } else {
            $employee = $this->form->store($imagePath);

            if ($employee) {
                session()->flash('success', 'Employee created successfully.');
            } else {
                session()->flash('error', 'Employee failed to create.');
            }
        }

        return $this->redirect('/all-employee', navigate: true);
    }
};
?>

<div>
    <div class="container my-4">
        <div class="row">
            <div class="col-md-10 col-lg-10 m-auto">
                <form action="" wire:submit="saveEmployee">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6 col-lg-6">
                                    <h4>Employee {{ $isEdit ? 'Update' : 'Create' }}</h4>
                                </div>
                                <div class="col-md-6 col-lg-6 text-end">
                                    <a wire:navigate href="{{ route('employees') }}" class="btn btn-primary btn-sm">GO
                                        BACK</a>
                                </div>
                            </div>


                        </div>
                        <div class="card-body">
                            {{-- employee name --}}
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" wire:model.live="form.name"
                                    class="form-control @error('form.name') is-invalid @enderror" id="name"
                                    placeholder="Enter employee name">
                                @error('form.name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee email --}}
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="email" wire:model.live="form.email"
                                    class="form-control @error('form.email') is-invalid @enderror" id="email"
                                    placeholder="Enter employee email">
                                @error('form.email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee phone --}}
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" wire:model.live="form.phone"
                                    class="form-control @error('form.phone') is-invalid @enderror" id="phone"
                                    placeholder="Enter employee phone">
                                @error('form.phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee joining_date --}}
                            <div class="form-group mb-3">
                                <label for="joining_date" class="form-label">Joining date <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="date" wire:model.live="form.joining_date"
                                    class="form-control @error('form.joining_date') is-invalid @enderror" id="joining_date"
                                    placeholder="Enter employee joining_date">
                                @error('form.joining_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee salary --}}
                            <div class="form-group mb-3">
                                <label for="salary" class="form-label">Salary <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="number" wire:model.live="form.salary"
                                    class="form-control @error('form.salary') is-invalid @enderror" id="salary"
                                    placeholder="Enter employee salary">
                                @error('form.salary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee department --}}
                            <div class="form-group mb-3">
                                <label for="department" class="form-label">Department <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" wire:model.live="form.department"
                                    class="form-control @error('form.department') is-invalid @enderror" id="department"
                                    placeholder="Enter employee department">
                                @error('form.department')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee designation --}}
                            <div class="form-group mb-3">
                                <label for="designation" class="form-label">Designation <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="text" wire:model.live="form.designation"
                                    class="form-control @error('form.designation') is-invalid @enderror" id="designation"
                                    placeholder="Enter employee designation">
                                @error('form.designation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- employee gender --}}
                            <div class="form-group mb-3">
                                <label for="gender" class="form-label me-5">Gender <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="radio" wire:model.live="form.gender" value="1"
                                    class="form-check-input" style="width: 24px; height: 24px;"> Male
                                <input type="radio" wire:model.live="form.gender" value="2"
                                    class="form-check-input ms-3" style="width: 24px; height: 24px;"> Female
                                <input type="radio" wire:model.live="form.gender" value="3"
                                    class="form-check-input ms-3" style="width: 24px; height: 24px;"> Other
                                <div>
                                    @error('form.gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <img src="" alt="">
                            </div>
                            {{-- employee photo --}}
                            <div class="form-group mb-3">
                                <label for="photo" class="form-label">Photo <span
                                        class="text-danger fs-5">*</span></label>
                                <input type="file" wire:model.live="form.photo"
                                    class="form-control @error('form.photo') is-invalid @enderror" id="photo"
                                    placeholder="Enter employee photo"><br>
                                @if ($this->form->photo)
                                    <img src="{{ $this->form->photo->temporaryUrl() }}" alt=""
                                        class="img-fluid" style="width:200px;height: 160px;">
                                @elseif($currentPhoto)
                                    <img src="{{ Storage::url($currentPhoto) }}" alt="" class="img-fluid"
                                        style="width:200px;height: 160px;">
                                @endif
                                @error('form.photo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit"
                                class="btn btn-primary sm fw-bold">{{ $isEdit ? 'Update' : 'Save' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
