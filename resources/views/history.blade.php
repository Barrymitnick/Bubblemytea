<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/history.css">

    <title>Bubble tea</title>

</head>
<body>

    @component('components/navbar')
        @slot('name')
            {{ $name }}
        @endslot
    @endcomponent

    <div class="container mt-5">
        @component('components/header')
            @slot('title')
                My Cart
            @endslot

            @slot('button')
                <a class="btn btn-outline-dark btn-cart" href="/">
                    Back to shop
                </a>
            @endslot
        @endcomponent
    </div>

    <div class="container mt-4">
        @if(isset($noOrder))
            <div class="text-center">
                <img src="/images/empty.gif" class="empty-image">
                <p class="empty-text mt-5">Your order history is empty</p>
            </div>
        @else
           
        <div class="row">
            <div class="col-9">

                @foreach ($data as $item)

                    <div class="container historyCard p-4">
                        @foreach ($item['productOrder'] as $product)

                            <div class="row">
                                <div class="col-2">
                                    <img src="{{ $product->Image }}" class="product-image" alt="">
                                </div>

                                <div class="col-3">
                                    <p class="product-title">{{ $product->productName }}</p>
                                    <p class="product-details">{{ $product->poppingName }}</p>
                                    <p class="product-details">{{ $product->sugar }} tablespoons of sugar</p>
                                </div>

                                <div class="col-3">
                                    <p class="product-qty"> x {{ $product->Qty }}</p>
                                </div>

                                <div class="col-2">
                                    <p class="product-price"><span class="price-list">{{ $product->Price * $product->Qty  }}</span> €</p>
                                </div>

                            </div>
                            <hr>

                        @endforeach
                            <p class="product-details text-right">Total : <span class="product-price">{{ $item['order']->amount }} €</span></p>
                            <p  class="product-details text-right">Date : {{ date('j F, Y', strtotime($item['order']->updated_at)) }}</p>
                    </div>

                @endforeach

            </div>
        </div>

        @endif
    </div>

    @component('components/freyja')
    @endcomponent

</body>
</html>