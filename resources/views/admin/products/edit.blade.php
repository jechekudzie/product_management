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
                        <h4 class="mb-sm-0">Product</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                <li class="breadcrumb-item active">Product</li>
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
                                    <a href="{{url('/admin/products/'.$product->sub_category->slug.'/index')}}" class="btn btn-info add-btn"><i
                                            class="ri-arrow-left-line align-bottom"></i> Back
                                    </a>
                                </div>
                                <div class="flex-shrink-0">
                                    <div class="hstack text-nowrap gap-2">
                                        <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown"
                                                aria-expanded="false" class="btn btn-soft-info"><i
                                                class="ri-more-2-fill"></i></button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
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

                <div class="col-xxl-9">
                    <div class="card" id="companyList">
                        <div style="color: black;font-size: 18px;font-weight: bolder;" class="card-header">
                            Edit: {{$product->name}}
                        </div>


                        <div class="card-body">
                            <!--end add modal-->

                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content border-0">
                                        <form method="post" action="{{ url('/admin/products/'.$product->slug) }}" enctype="multipart/form-data">
                                            @method('PUT')
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row g-4">

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="name" class="form-label">Product</label>
                                                            <input type="text" name="name" id="name" class="form-control rounded-pill" value="{{ old('name', $product->name) }}" placeholder="Enter product"/>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="image" class="form-label">Upload Product Image</label>
                                                            <input type="file" name="image[]" id="image" multiple class="form-control rounded-pill">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="price" class="form-label">Price</label>
                                                            <input type="number" name="price" step="0.01" id="price" class="form-control rounded-pill" value="{{ old('price', $product->price) }}" placeholder="Enter product price">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="mb-3">
                                                            <label for="original_size" class="form-label">Original Size</label>
                                                            <input type="text" name="original_size" id="original_size" class="form-control rounded-pill" value="{{ old('original_size', $product->original_size) }}" placeholder="Enter original size">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-12">
                                                        <label class="form-label">Other Sizes</label>
                                                        <div id="other_sizes_container">
                                                            @php
                                                                $sizes = json_decode($product->other_sizes, true);

                                                                // Handle the case where sizes are stored as "90,12,34"
                                                                if (count($sizes) == 1 && strpos($sizes[0], ',') !== false) {
                                                                    $sizes = explode(',', $sizes[0]);
                                                                }
                                                            @endphp

                                                            @foreach($sizes as $size)
                                                                <div class="input-group mb-3">
                                                                    <input type="text" name="other_sizes[]" class="form-control rounded-pill" value="{{ $size }}" placeholder="Enter size">
                                                                    <button class="btn btn-secondary" type="button" onclick="addSizeField()">Add More</button>
                                                                    <button class="btn btn-danger" type="button" onclick="removeSizeField(this)">Remove</button>
                                                                </div>
                                                            @endforeach

                                                            <!-- Placeholder for dynamically added sizes using JavaScript -->
                                                            <div class="input-group mb-3" style="display: none;" id="placeholder_size">
                                                                <input type="text" name="other_sizes[]" class="form-control rounded-pill" placeholder="Enter size">
                                                                <button class="btn btn-secondary" type="button" onclick="addSizeField()">Add More</button>
                                                                <button class="btn btn-danger" type="button" onclick="removeSizeField(this)">Remove</button>
                                                            </div>
                                                        </div>
                                                    </div>




                                                    <div class="col-lg-12">
                                                        <div class="mb-3">
                                                            <label for="description" class="form-label">Description</label>
                                                            <textarea name="description" class="form-control" id="editor" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <div class="d-flex justify-content-end gap-2">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success">Update Product</button>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <!--end col-->

                <div class="col-xxl-3">
                    <div class="card" id="companyList">
                        <div style="color: black;font-size: 18px;font-weight: bolder;" class="card-header">
                            Current {{$product->name}}
                        </div>


                        <div class="card-body">
                            <!--end add modal-->
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content border-0">
                                    <img src="{{asset($product->image)}}" style="width: 300px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>

            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div>
@stop
@push('scripts')
    <!-- ckeditor -->

    <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
    <script type="text/javascript">
        ClassicEditor
            .create(document.querySelector('.editor'))
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function () {
            $(".datepicker").datepicker({
                dateFormat: "yy-mm-dd"
            });
        });

        function addSizeField() {
            // Clone the placeholder element
            var newElement = document.querySelector('#placeholder_size').cloneNode(true);

            // Remove the id and style attributes to make it visible
            newElement.removeAttribute('id');
            newElement.removeAttribute('style');

            // Append the new element to the container
            document.querySelector('#other_sizes_container').appendChild(newElement);
        }

        function removeSizeField(buttonElement) {
            // Get the parent .input-group of the clicked button
            var parentGroup = buttonElement.closest('.input-group');

            // Remove the parent .input-group from the DOM
            parentGroup.remove();
        }


    </script>

@endpush
