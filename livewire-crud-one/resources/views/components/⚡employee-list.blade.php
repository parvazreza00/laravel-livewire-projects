<?php

use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use App\Models\Employee;
use Carbon\Carbon;

new class extends Component {
    use WithPagination, WithoutUrlPagination;

    public $searchTerm = null;
    public $activePageNumber = 1;
    public $sortColumn = 'id';
    public $sortOrder = 'asc';

    // sording table column wise into the table header column name
    public function sortBy($columnName)
    {
        if ($this->sortColumn === $columnName) {
            $this->sortOrder = $this->sortOrder === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortColumn = $columnName;
            $this->sortOrder = 'asc';
        }
    }

    #[Computed]
    public function employees()
    {
        return Employee::where('name', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('employee_id', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('department', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('designation', 'like', '%'. $this->searchTerm . '%')
            ->orWhere('salary', 'like', '%'. $this->searchTerm . '%')
            ->orderBy($this->sortColumn, $this->sortOrder)->paginate(5);
    }
    public function formatDate($date, $format = 'M d, y')
    {
        if (!$date) {
            return '-';
        }
        return Carbon::parse($date)->format($format);
    }
    public function employeDelete(Employee $employee)
    {
        if (!$employee) {
            session()->flash('error', 'Employee not found.');
            return;
        }

        if ($employee->photo && Storage::disk('public')->exists($employee->photo)) {
            Storage::disk('public')->delete($employee->photo);
        }

        if ($employee->delete()) {
            session()->flash('success', 'Employee remove from the storage');
        } else {
            session()->flash('error', 'Employee do not remove from the storage');
        }

        $currentEmployees = $this->employees();
        if ($currentEmployees->isEmpty() && $this->activePageNumber > 1) {
            // Redirect to previous page if current page has no employees after deletion
            $this->gotoPage($this->activePageNumber - 1);
        } else {
            // Redirect to current page if it still has employees
            $this->gotoPage($this->activePageNumber);
        }
    }

    public function updatingPage($page)
    {
        // dd($page);
        $this->activePageNumber = $page;
    }
};
?>

<div>

    <div class="container my-4">
        <div class="row border-bottom my-3">
            <div class="col-md-10 col-lg-10">
                <h4 class="fw-bold text-center">Livewire - 4 - Employee CRUD </h4>
            </div>
            <div class="col-md-2 col-lg-2 text-end">
                <a wire:navigate href="{{ route('add.employee') }}" class="btn btn-primary btn-sm fw-bold">ADD
                    EMPLOYEE</a>
            </div>
        </div>


        <div class="my-2">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @elseif(session('error'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>{{ session('error') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="card shadow">
            <div class="col-xl-4 ms-auto my-3 mx-2">
                <input type="text" class="form-control" placeholder="Search Employee" wire:model.live.debounce.250ms="searchTerm">
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Photo <span wire:click="sortBy('photo')">
                                @if($sortColumn === 'photo')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort" ></i>
                                @endif
                            </span> </th>
                            <th>EMP-ID <span wire:click="sortBy('employee_id')">
                                @if($sortColumn === 'employee_id')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Name <span wire:click="sortBy('name')">
                                @if($sortColumn === 'name')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Gender <span wire:click="sortBy('gender')">
                                @if($sortColumn === 'gender')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Department <span wire:click="sortBy('department')">
                                @if($sortColumn === 'department')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Designation <span wire:click="sortBy('designation')">
                                @if($sortColumn === 'designation')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Salary <span wire:click="sortBy('salary')">
                                @if($sortColumn === 'salary')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Joining Date <span wire:click="sortBy('joining_date')">
                                @if($sortColumn === 'joining_date')
                                    @if($sortOrder === 'asc')
                                        <i class="fa-solid fa-sort-up"></i>
                                    @else
                                        <i class="fa-solid fa-sort-down"></i>
                                    @endif
                                @else
                                <i class="fa-solid fa-sort"></i>
                                @endif
                            </span> </th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->employees as $key => $employee)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td> <img src="{{ Storage::url($employee->photo) }}" alt="" class="rounded"
                                        style="width: 100px;height: 80px;"> </td>
                                <td>{{ $employee->employee_id }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->gender === 1 ? 'Male' : ($employee === 2 ? 'Female' : 'Other') }}</td>
                                <td>{{ $employee->department }}</td>
                                <td>{{ $employee->designation }}</td>
                                <td>{{ $employee->salary }}</td>
                                <td>{{ $this->formatDate($employee->joining_date) }}</td>
                                <td>{{ $employee->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td>
                                    <a wire:navigate href="{{ route('edit.employee', $employee->id) }}"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm"
                                        wire:confirm="Are you sure to delete this employee?"
                                        wire:click="employeDelete({{ $employee->id }})">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $this->employees->links() }}
            </div>
        </div>



    </div>

</div>
