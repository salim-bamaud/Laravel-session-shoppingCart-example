<div>
    <div class="pt-40">
        <div class="flex justify-center items-center h-screen mx-20 pt-20">
            <div class=" rounded overflow-hidden shadow-lg bg-white">
                <div class="px-6 py-10">
                    @if (session('shoppingCart'))
                        <div>
                            <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
                                <thead class="text-xs text-white uppercase bg-blue-50 dark:bg-blue-700 dark:text-white">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Product name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Subtotal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (session('shoppingCart') as $product)
                                        <tr class="bg-white border-b dark:bg-blue-500 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                                {{ $product['name'] }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $product['price'] }}
                                            </td>
                                            <td class="px-2 py-4">
                                                <div class="flex justify-between items-center">
                                                    <button class="px-3 py-1 bg-gray-700 text-gray-200 rounded"
                                                        wire:click="decreaseProductQuantityInCart({{ $product['id'] }})">-</button>
                                                    <span
                                                        class="px-3 py-1 bg-gray-700">{{ $product['quantity'] }}</span>
                                                    <button class="px-3 py-1 bg-gray-700 text-gray-200 rounded"
                                                        wire:click="addToCart({{ $product['id'] }})">+</button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $product['price'] * $product['quantity'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr class="bg-white border-b dark:bg-gray-500 dark:border-gray-700">
                                        <td colspan="3" scope="row"
                                            class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                                            Total: </td>
                                        <td class="px-6 py-4">
                                            {{ $total }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>

                        <div class="px-6 py-4">
                            {{-- <form method="" action="#">
                                @csrf --}}
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-800">Create
                                Order</button>
                            {{-- </form> --}}
                        </div>

                    @endif
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Product name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    #
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $product->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $product->description }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $product->price }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex justify-between items-center">
                                            @if (session('shoppingCart') && array_key_exists($product->id, session('shoppingCart')))
                                                <button class="px-3 py-1 bg-red-200 text-gray-700 rounded"
                                                    wire:click="removeFromCart({{ $product->id }})">Remove From
                                                    Cart</button>
                                            @else
                                                <button class="px-3 py-1 bg-gray-200 text-gray-700 rounded"
                                                    wire:click="addToCart({{ $product->id }})">Add to Cart</button>
                                            @endif

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
