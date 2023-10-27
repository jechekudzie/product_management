<form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="category_id">Category</label>
        <select name="category_id">
            <option value="">Select a category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="brand_id">Brand</label>
        <select name="brand_id">
            <option value="">Select a brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="name">Product Name</label>
        <input type="text" name="name" placeholder="Enter product name" value="{{ old('name') }}">
    </div>
    <div>
        <label for="model">Model</label>
        <input type="text" name="model" placeholder="Enter product model" value="{{ old('model') }}">
    </div>
    <div>
        <label for="description">Description</label>
        <textarea name="description" placeholder="Enter product description">{{ old('description') }}</textarea>
    </div>
    <div>
        <label for="quantity">Quantity</label>
        <input type="number" name="quantity" placeholder="Enter product quantity" value="{{ old('quantity') }}">
    </div>
    <div>
        <label for="image">Image</label>
        <input type="file" name="image" accept="image/*">
    </div>
    <div>
        <label for="price">Price</label>
        <input type="number" name="price" step="0.01" placeholder="Enter product price" value="{{ old('price') }}">
    </div>
    <div>
        <label for="on_discount">On Discount</label>
        <select name="on_discount">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>
    <div>
        <label for="discount_percentage">Discount Percentage</label>
        <input type="number" name="discount_percentage" step="0.01" placeholder="Enter discount percentage" value="{{ old('discount_percentage') }}">
    </div>
    <div>
        <label for="qr_code">QR Code</label>
        <input type="text" name="qr_code" placeholder="Enter QR code" value="{{ old('qr_code') }}">
    </div>
    <div>
        <label for="bar_code">Bar Code</label>
        <input type="text" name="bar_code" placeholder="Enter bar code" value="{{ old('bar_code') }}">
    </div>
    <button type="submit">Create Product</button>
</form>
