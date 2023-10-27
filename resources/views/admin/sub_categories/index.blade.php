@extends('layouts.admin')
@push('head')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{$category->name}} categories</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">{{$category->name}} categories</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center flex-wrap gap-2">

                                <div class="flex-grow-1">
                                    <a href="{{url('/admin/categories')}}" class="btn btn-info add-btn"><i
                                            class="ri-arrow-left-line align-bottom"></i> Back to categories
                                    </a>
                                    <button class="btn btn-info add-btn" data-bs-toggle="modal"
                                            data-bs-target="#showModal"><i
                                            class="ri-add-fill me-1 align-bottom"></i> Add Sub category
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($errors->any())
                    @include('errors')
                @endif
                @if (session('message'))
                    <div class="col-lg-6">
                        <!-- Primary Alert -->
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong> Hi! </strong> <b>{{session('message')}} </b> !
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
                <!--end col-->
                <div class="col-xxl-12">
                    <div class="card" id="companyList">

                        <div class="card-body">
                            <div>
                                <div class="table-responsive table-card mb-3">
                                    <table id="example" class="display {{--table align-middle table-nowrap--}} mb-0">
                                        <thead class="table-light">
                                        <tr>

                                            <th class="sort" data-sort="name" scope="col">id</th>
                                            <th class="sort" data-sort="owner" scope="col">Name</th>
                                            <th class="sort" data-sort="owner" scope="col">Category</th>
                                            <th class="sort" data-sort="owner" scope="col">Description</th>
                                            <th class="sort" data-sort="owner" scope="col">Subs</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="list form-check-all">
                                        @foreach($category->sub_categories as $sub_category)
                                            <tr>

                                                <td class="owner">{{$sub_category->id}}</td>
                                                <td class="owner">{{$sub_category->name}}</td>
                                                <td class="owner">{!! $sub_category->category->name !!}</td>
                                                <td class="owner">{!! substr($sub_category->description, 0, 50) !!}....</td>
                                                <td class="owner"><a
                                                        href="{{url('admin/products/'.$sub_category->slug.'/index')}}">
                                                        Products ({{$sub_category->products->count()}})</a></td>
                                                <td>
                                                    <ul class="list-inline hstack gap-2 mb-0">
                                                        <li class="list-inline-item" data-bs-toggle="tooltip"
                                                            data-bs-trigger="hover" data-bs-placement="top"
                                                            title="Edit">
                                                            <a class="edit-item-btn"
                                                               href="{{url('/admin/sub_categories/'.$sub_category->slug.'/edit')}}">Edit
                                                                <i
                                                                    class="ri-pencil-fill align-bottom text-muted"></i></a>
                                                        </li>
                                                    </ul>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- add modal-->
                            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content border-0">
                                        <div class="modal-header bg-soft-info p-3">
                                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" id="close-modal"></button>
                                        </div>
                                        <form method="post" action="{{url('/admin/sub_categories/'.$category->slug.'/store')}}"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row g-3">
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label for="name"
                                                                   class="form-label">Sub Category</label>
                                                            <input type="text" name="name"
                                                                   class="form-control rounded-pill mb-3"
                                                                   value="{{old('name')}}"
                                                                   placeholder="Enter category"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <label for="name" class="form-label">Upload Category Cover</label>
                                                        <input type="file" name="image[]" multiple
                                                               class="form-control rounded-pill mb-3"
                                                               placeholder="Image upload">
                                                    </div>


                                                    <div class="col-lg-12">
                                                        <div>
                                                            <label for="description"
                                                                   class="form-label">Description</label>
                                                            <textarea name="description" class="form-control"
                                                                      id="editor"
                                                                      placeholder="Enter package category description">

                                                            </textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="button" class="btn btn-light"
                                                            data-bs-dismiss="modal">Close
                                                    </button>
                                                    <button type="submit" class="btn btn-success">Add
                                                        Category
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- add modal-->


                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->


            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
@stop
@push('scripts')
    <!-- ckeditor -->

    <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });
    </script>

@endpush
