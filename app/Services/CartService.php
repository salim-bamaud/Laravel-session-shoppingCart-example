<?php

namespace App\Services;

use App\Models\Product;

class CartService
{

    public function getShoppingCart(): array
        {
            // get data from session (this equals Session::get(), use empty array as default)
            return $shoppingCart = session('shoppingCart', []);

        }

        // add or increase quantity of item in cart
    public function addToCart(int $productId): array
        {
            // get data from session (this equals Session::get(), use empty array as default)
            $shoppingCart = session('shoppingCart', []);

            if (isset($shoppingCart[$productId]))
            {
                // product is already in shopping cart, increment the quantity
                $shoppingCart[$productId]['quantity'] += 1;
            }
            else
            {
                // fetch the product and add 1 to the shopping cart
                $product = Product::findOrFail($productId);
                $shoppingCart[$productId] = [
                    'id' => $productId,
                    'quantity'    => 1,
                    'price'     => $product->price,
                    'name'      => $product->name,
                ];
            }

            // update the session data (this equals Session::put() )
            session(['shoppingCart' => $shoppingCart]);
            return $shoppingCart;
        }



        public function decreaseProductQuantityInCart(int $productId): array | null
            {
                $shoppingCart = session('shoppingCart', []);

                if (!isset($shoppingCart[$productId]))
                {
                    // should not happen, and should throw an error.
                    return null;
                }
                else
                {
                    if ($shoppingCart[$productId]['quantity'] == 1){
                        unset($shoppingCart[$productId]);
                    }
                    else
                    {
                        $shoppingCart[$productId]['quantity'] -= 1;
                    }
                }

                session(['shoppingCart' => $shoppingCart]);
                return $shoppingCart;
            }

        public function getTotal(){
            $total = 0;
            $shoppingCart = session('shoppingCart');

            if ($shoppingCart)
            {
                foreach($shoppingCart as $product)
                    $total += $product['price']*$product['quantity'];
            }

            return $total;
        }

        public function removeFromCart(int $productId){
            $shoppingCart = session('shoppingCart', []);

                if (!isset($shoppingCart[$productId]))
                {
                    // should not happen, and should throw an error.
                    return null;
                }
                else
                {
                    unset($shoppingCart[$productId]);
                }

                session(['shoppingCart' => $shoppingCart]);
                return $shoppingCart;
        }

}
