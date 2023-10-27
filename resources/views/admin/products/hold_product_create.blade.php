<form method="post" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row g-3">
            <div class="col-lg-6">
                <div>
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" class="form-control rounded-pill mb-3">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control rounded-pill mb-3" placeholder="Enter product name">
                </div>
                <div>
                    <label for="model" class="form-label">Model</label>
                    <input type="text" name="model" class="form-control rounded-pill mb-3" placeholder="Enter product model">
                </div>

                <div>
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" class="form-control rounded-pill mb-3">
                </div>

            </div>
            <div class="col-lg-6">
                <div>
                    <label for="brand_id" class="form-label">Brand</label>
                    <select name="brand_id" class="form-control rounded-pill mb-3">
                        <option value="">Select a brand</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" class="form-control rounded-pill mb-3" placeholder="Enter product price">
                </div>
                <div>
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" class="form-control rounded-pill mb-3" placeholder="Enter product quantity">
                </div>

            </div>
        </div>
        <div class="col-lg-12">

            <div>
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="editor form-control rounded-pill mb-3" placeholder="Enter product description"></textarea>
            </div>

        </div>
    </div>
    <div class="modal-footer">
        <div class="hstack gap-2 justify-content-end">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Add Product</button>
        </div>
    </div>
</form>
