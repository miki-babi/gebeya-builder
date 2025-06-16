@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="max-w-xl mx-auto bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden flex flex-row">
    <div>
        <div class="p-4">
            <img class="w-full h-48 object-cover" src="{{ $product->image_url[0] ?? 'https://via.placeholder.com/150' }}" alt="{{ $product->name }}">
            <div class="grid grid-cols-2 gap-4 mt-2">
                @foreach ($product->image_url as $imageUrl)
                    <img class="w-full h-32 object-cover rounded" src="{{ $imageUrl }}" alt="Additional Image">
                @endforeach
            </div>
        </div>
        
    </div>
    <div>
        <div class="p-4">
            <h1 class="text-lg font-bold text-gray-800">{{ $product->name }}</h1>
            <p class="text-gray-600 mt-2">{{ $product->description ?? 'No description available.' }}</p>
            <p class="text-gray-800 font-semibold mt-2">Price: ${{ $product->price }}</p>
            <p class="text-green-600 font-medium mt-2">
                {{ $product->is_available ? 'Available' : 'Out of Stock' }}
            </p>
            <p class="text-gray-600 mt-2">Stock Quantity: {{ $product->stock_quantity }}</p>
            <div class="mt-4">
                <strong class="text-gray-600">Categories:</strong>
                <ul class="list-inside text-gray-700">
                    @foreach (($product->category) as $category)
                        <li>{{ $category }}</li>
                    @endforeach
                </ul>
            </div>

            
        </div>
        <div class="mt-4">
                <form action="{{ route('orders.place') }}" method="POST">
                {{-- <form action="/" method="POST" class="bg-gray-100 p-4 rounded shadow"> --}}
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <label for="phone_number" class="block text-gray-600 font-medium">Phone Number:</label>
                    <input type="tel" id="phone_number" name="phone" class="border border-gray-300 rounded px-2 py-1 w-full mt-1" placeholder=" 📞 09********" required>
                    <label for="order_amount" class="block text-gray-600 font-medium">Order Amount:</label>
                    <input type="number" id="order_amount" name="amount" min="1" max="{{ $product->stock_quantity }}" class="border border-gray-300 rounded px-2 py-1 w-full mt-1" required>
                    <button type="submit" class="bg-white text-blue-500 border border-gray-300 font-bold py-2 px-4 rounded mt-2 hover:border-blue-500">
                        🛍 Place Order
                    </button>
                </form>
        </div>
    </div>
</div>
