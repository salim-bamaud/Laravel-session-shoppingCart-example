<?php

namespace App\Livewire;

use Livewire\Component;
use App\Services\CartService;

class AddToCart extends Component
{
    public $products;
    public $shoppingCart;
    public $total = 0;

    //same function to add items and increment there quantity
    public function addToCart(CartService $cartService , $productId)
    {
        $cartService->addToCart($productId);
        $this->total = $cartService->getTotal();
    }

    // decrease quantity of item
    public function decreaseProductQuantityInCart(CartService $cartService , $productId)
    {
        $cartService->decreaseProductQuantityInCart($productId);
        $this->total = $cartService->getTotal();
    }

    public function removeFromCart(CartService $cartService ,$productId){
        $cartService->removeFromCart($productId);
    }

    public function mount(CartService $cartService)
    {
        $this->shoppingCart = $cartService->getShoppingCart();
        $this->total = $cartService->getTotal();
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }


}
