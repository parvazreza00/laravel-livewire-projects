<?php

use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;

new class extends Component {
    use WithPagination, WithoutUrlPagination;

    #[Title('Livewire 4 crud with lareve')]
    public $searchTerm = null;
    public $activePageNumber = 1;

    #[Computed]
    public function posts()
    {
        return Post::where('title', 'like', '%'. $this->searchTerm . '%')
        ->orWhere('content', 'like', '%'. $this->searchTerm . '%')
        ->orderBy('id','DESC')->paginate(5);
    }

    public function shortContent($content)
    {
        return Str::words($content, 10, '...');
    }

    public function deletePost(Post $post){
        // dd($post);
        if($post){
            if(Storage::exists($post->featrued_image)){
                Storage::delete($post->featrued_image);
            }
            $deleteResponse = $post->delete();
            if($deleteResponse){
                session()->flash('success','Post deleted succressfully');
            }else{
                session()->flash('error','Post do not deleted');
            }
        }else{
            session()->flash('error','Post do not Found');
        }

        $currentPosts = $this->posts();
        if($currentPosts->isEmpty() && $this->activePageNumber > 1){
            // redirect to previous page if current page has no posts after deletion
            $this->gotoPage($this->activePageNumber - 1);
        }else{
         // redirect to current page if it still has posts
            $this->gotoPage($this->activePageNumber);
        }


        // return $this->redirect('/', navigate:true);
    }

    public function updatingPage($page){
       $this->activePageNumber =  $page;
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
            <div class="col-xl-4 ms-auto my-3 mx-2">
                <input type="text" class="form-control" placeholder="Search Post" wire:model.live.debounce.250ms="searchTerm">
            </div>
            <div class="card-body table-responsive">
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
                                    <button wire:confirm="Are you sure to delete the post?" wire:click="deletePost({{ $post->id }})" class="btn btn-danger btn-sm">Delete</button>
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
