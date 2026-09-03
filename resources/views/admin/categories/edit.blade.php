
@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">

    <div class="card shadow mb-4">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Edit Category</h4>

            <a href="{{ route('backend.categories.index') }}" class="btn btn-danger">
                Cancel
            </a>
        </div>

        <div class="card-body">

            <form action="{{ route('backend.categories.update',$category->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                
                

                <!-- Categories Name -->
                <div class="mb-3">
                    <label class="form-label">Category Name</label>

                    <input type="text"
                           name="name"
                           value="{{ old('name',$category->name) }}"
                           class="form-control @error('name') is-invalid @enderror">

                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image -->
                <div class="mb-3">

                    <ul class="nav nav-tabs" id="imageTab" role="tablist">

                        <li class="nav-item">
                            <button class="nav-link active"
                                    data-bs-toggle="tab"
                                    data-bs-target="#current-image"
                                    type="button">
                                Current Image
                            </button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link"
                                    data-bs-toggle="tab"
                                    data-bs-target="#new-image"
                                    type="button">
                                Upload New Image
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content border border-top-0 p-3">

                        <!-- Current Image -->
                        <div class="tab-pane fade show active"
                             id="current-image">

                            <img src="{{ asset($category->image) }}"
                                 class="img-fluid w-25 h-25"
                                 alt="Current Image">
                            <input type="hidden" name="old_image" value="{{ $category->image }}">

                        </div>

                        <!-- New Image -->
                        <div class="tab-pane fade"
                             id="new-image">

                            <input type="file"
                                   name="image"
                                   accept="image/*"
                                   class="form-control @error('image') is-invalid @enderror">

                            @error('image')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>

                </div>

               

        
                <button class="btn btn-primary">
                    Update Category
                </button>

                <a href="{{ route('backend.categoires.index') }}"
                   class="btn btn-secondary">
                    Cancel
                </a>

            </form>

        </div>

    </div>

</div>

@endsection

