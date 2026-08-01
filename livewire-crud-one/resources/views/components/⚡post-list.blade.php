<?php

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Computed;

new class extends Component {
    use WithPagination, WithoutUrlPagination;

    #[Computed]
    public function posts()
    {
        return Post::paginate(5);
    }

    public function shortContent($content)
    {
        return Str::words($content, 10, '...');
    }
};
?>

<div>
    <div class="container my-3">

        <div class="row border-bottom py-3">
            <div class="col-md-11 col-lg-11 log-xl-11">
                <h4 class="text-center fw-bold">SPA - CRUD APP USING Livewire</h4>
            </div>
            <div class="col-md-1 col-lg-1 log-xl-1">
                <a wire:navigate href="{{ route('create-post') }}" class="btn btn-primary btn-sm">ADD POST</a>
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

        {{-- Post listing table --}}
        <div class="card shadow">
            <div class="card-body mt-4 table-responsive">
                <table class="table border table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Featured Image</th>
                            <th scope="col">Title</th>
                            <th scope="col">Content</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->posts as $key => $post)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td><a wire:navigate href="{{ route('post.view', $post->id) }}"> <img src="{{ Storage::url($post->featrued_image) }}" alt=""
                                        class="img-fluid" style="width: 150px; height: 100px"> </a>  </td>
                                <td><a class="text-decoration-none" wire:navigate href="{{ route('post.view', $post->id) }}">{{ $post->title }}</td>
                                <td>{{ $this->shortContent($post->content) }} </a></td>
                                <td><span><strong>Posted:
                                        </strong>{{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                                    <br>
                                    <span><strong>Updated:
                                        </strong>{{ \Carbon\Carbon::parse($post->updated_at)->diffForHumans() }}</span>
                                </td>
                                <td>
                                    <a wire:navigate href="{{ route('post.edit', $post->id) }}" class="btn btn-success btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                 {{ $this->posts->links() }}
            </div>
        </div>

    </div>
</div>
