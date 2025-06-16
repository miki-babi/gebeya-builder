<form action="{{ route('products.store') }}" method="POST">
    @csrf

    <div>
        <label>Name:</label>
        <input type="text" name="name" required>
    </div>

    <div>
        <label>Image URLs:</label>
        <div id="image-url-wrapper">
            <input type="text" name="image_url[]" placeholder="Enter image URL">
        </div>
        <button type="button" onclick="addInput('image-url-wrapper', 'image_url[]')">Add Image</button>
    </div>

    <div>
        <label>Categories:</label>
        <div id="category-wrapper">
            <input type="text" name="category[]" placeholder="Enter category">
        </div>
        <button type="button" onclick="addInput('category-wrapper', 'category[]')">Add Category</button>
    </div>

    <div>
        <label>Price:</label>
        <input type="number" name="price" required min="0" step="0.01">
    </div>

    <div>
        <label>Is Available:</label>
        <input type="checkbox" name="is_available" value="1">
    </div>

    <div>
        <label>Stock Quantity:</label>
        <input type="number" name="stock_quantity" min="0">
    </div>

    <button type="submit">Submit</button>
</form>

<script>
function addInput(wrapperId, inputName) {
    const wrapper = document.getElementById(wrapperId);
    const input = document.createElement('input');
    input.type = 'text';
    input.name = inputName;
    input.placeholder = 'Enter more';
    wrapper.appendChild(document.createElement('br'));
    wrapper.appendChild(input);
}
</script>
