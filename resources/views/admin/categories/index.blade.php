@extends('layouts.admin')
@section('content')
@if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" id="error-alert">
        {{ session('error') }}
    </div>
@endif

     <div class="container-fluid px-4">
                        <div class="my-3">
                            <h1 class="mt-4 d-inline">Categories</h1>
                            <a href="{{ route('backend.categories.create') }}" class="btn btn-primary float-end">Create Category</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                       
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                              Items lists
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>#</th>
                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                      <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>#</th>
                                            
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @php
                                            $i =1;
                                        @endphp
                                        @foreach($categories as $category)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                
                                                <td>{{$category->name}}</td>
                                                <td>
                                                    <a href="{{ route('backend.categories.edit',$category->id) }}" class="btn btn-sn btn-warning">Edit</a>
                                                    <button type="submit" class="btn btn-sn btn-danger delete" data-id="{{ $category->id }}">Delete</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $categories->links() }}
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header bg-danger text-light">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Are you sure you want to Delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <form action="" id="deleteForm" method="POST">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                </div>
                </div>
            </div>
            </div>
        <script>
            setTimeout(function() {
                $('#success-alert').fadeOut();
                $('#error-alert').fadeOut();
            }, 10000); // 10 seconds
        </script>
@endsection
@section('script')
        <script>
            $(document).ready(function(){
                $('tbody').on('click','.delete',function(){
                  //  alert('hello');
                    let id=$(this).data('id');
                    //console.log(id);
                    $('#deleteForm').attr('action',`categoires/${id}`);
                    $('#deleteModal').modal('show');
                })
            })
        </script>
@endsection