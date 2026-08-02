<?php

use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use App\Models\Post;
use Livewire\Attributes\Title;

new class extends Component {
    use WithFileUploads;

      #[Title('Livewire 4 crud with lareve')]

    public $isView = false;
    public $post = null;

    #[Validate('required', message: 'Post title is required')]
    #[Validate('min:3', message: 'Post title must be at least 3 characters')]
    #[Validate('max:150', message: 'Post title not more than 150 characters')]
    public $title;

    #[Validate('required', message: 'Post content is required')]
    #[Validate('min:10', message: 'Post content must be at least 10 characters long')]
    public $content;

    public $featured_image;

    public function mount(Post $post)
    {
        // dd($post);
        $this->isView = request()->routeIs('post.view');
        if ($post->id) {
            $this->post = $post;
            $this->title = $post->title;
            $this->content = $post->content;
        }
    }

   protected function rules()
    {
        return [
            'featured_image' => $this->post && $this->post->featrued_image
                ? 'nullable|image|mimes:jpg,jpeg,png,svg,bmp,webp,gif|max:2048'
                : 'required|image|mimes:jpg,jpeg,png,svg,bmp,webp,gif|max:2048',
        ];
    }

    protected function messages()
    {
        return [
            'featured_image.required' => 'Post featured image is required',
            'featured_image.image'    => 'Featured image must be a valid image',
            'featured_image.mimes'    => 'Featured image accepts only jpg, jpeg, png, svg, bmp, webp and gif',
            'featured_image.max'      => 'Featured image must not be greater than 2MB',
        ];
    }


    public function savePost()
    {
        $this->validate();


        $imagePath = null;

        if ($this->featured_image) {
            $imageName = time() . '.' . $this->featured_image->extension();
            $imagePath = $this->featured_image->storeAs('uploads', $imageName, 'public');
        }
        if ($this->post) {
            if ($this->post) {
                $this->post->title = $this->title;
                $this->post->content = $this->content;

                if ($imagePath) {
                    $this->post->featrued_image = $imagePath;
                }

                $updatePost = $this->post->save();

                if ($updatePost) {
                    session()->flash('success', 'Post Updated and published successfully');
                } else {
                    session()->flash('error', 'Failed ot post create. Please try again.');
                }
            }
        } else {
            $post = Post::create([
                'title' => $this->title,
                'content' => $this->content,
                'featrued_image' => $imagePath,
            ]);

            if ($post) {
                session()->flash('success', 'Post create and published successfully');
            } else {
                session()->flash('error', 'Failed ot post create. Please try again.');
            }
        }

        return $this->redirect('/', navigate: true);
    }
};
?>

<div>
    <div class="container mt-5">
        <div class="row">

            <div class="col-md-8 col-lg-8 m-auto">
                <form wire:submit="savePost">
                    <div class="card shadow">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-mg-6 col-lg-6">
                                    <h5 class="fw-bolder">{{ $isView ? 'View' : ($post ? 'Edit' : 'Create') }} Post</h5>
                                </div>
                                <div class="col-mg-6 col-lg-6 text-end">
                                    <a wire:navigate href="{{ route('posts') }}" class="btn btn-primary btn-sm "> Back
                                        to home </a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            {{-- post title --}}
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input type="text" wire:model="title" {{ $isView ? 'disabled' : '' }}
                                    class="form-control @error('title') is-invalid @enderror" id="title"
                                    placeholder="Enter Post Title">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- post content --}}
                            <div class="form-group mb-3">
                                <label for="content" class="form-label">Content <span
                                        class="text-danger">*</span></label>
                                <textarea wire:model="content" {{ $isView ? 'disabled' : '' }}
                                    class="form-control @error('content') is-invalid @enderror" id="content" placeholder="Enter Post Content"></textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @if ($post)
                                <label for="">Uploaded Featured Image:</label>
                                <div class="my-2">
                                    <img src="{{ Storage::url($post->featrued_image) }}" alt=""
                                        class="img-fluid" style="width: 150px; height: 100px">
                                </div>
                            @endif
                            {{-- post featured image --}}
                            @if (!$isView)
                                <div class="form-group mb-3">
                                    <label for="featured_image" class="form-label">Featured Image <span
                                            class="text-danger">*</span></label>
                                    <input type="file" wire:model="featured_image"
                                        class="form-control @error('featured_image') is-invalid @enderror"
                                        id="featured_image">
                                    @if ($featured_image)
                                        <img src="{{ $featured_image->temporaryUrl() }}" class="img-fluid"
                                            alt="" style="width: 100px;height: 100px;">
                                    @endif
                                    @error('featured_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endif

                        </div>
                        @if (!$isView)
                            <div class="card-footer">
                                <div class="form-group mb-3">
                                    <button type="submit"
                                        class="btn btn-success">{{ $post ? 'Update' : 'Save' }}</button>
                                </div>

                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
