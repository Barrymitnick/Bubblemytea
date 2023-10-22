<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/cart.css">

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
            <p class="empty-text mt-5">Your cart is empty 🙁</p>
        </div>
        @else

        <div class="row">
            <div class="col-9">

                @foreach ($orderProducts as $item)

                    <div class="row">
                        <div class="col-2">
                            <img src="{{ $item->Image }}" class="product-image" alt="">
                        </div>

                        <div class="col-3">
                            <p class="product-title">{{ $item->productName }}</p>
                            <p class="product-details">{{ $item->poppingName }}</p>
                            <p class="product-details">{{ $item->sugar }} tablespoons of sugar</p>
                        </div>

                        <div class="col-3">
                            <p class="product-qty"> x {{ $item->Qty }}</p>
                        </div>

                        <div class="col-2">
                            <p class="product-price"><span class="price-list">{{ $item->Price * $item->Qty  }}</span> €</p>
                        </div>

                        <div class="col-2">
                            <form action="{{ route('order.delete') }}" method="POST">
                                @csrf
                                <input type="number" value="{{ $item->id }}" class="hidden" name="id">
                                <button class="btn btn-outline-dark btn-close" type="submit">
                                    <i class="icon ion-md-close"></i>
                                </button>
                            </form>
                           
                        </div>

                    </div>
                    <hr>

                @endforeach

            </div>
            <div class="col-3 text-right">
                <div class="checkout-details p-3">
                    <p class="summary">Summary</p>
                    <div class="row">
                        <div class="col-8 sub-details">Total Order</div>
                        <div class="col-4 product-price" id="totalOrder"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9 sub-details">Reduction</div>
                        <div class="col-3 sub-details">0 €</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-9 sub-details">Promo Code</div>
                        <div class="col-3 sub-details"> - </div>
                    </div>
                </div>
                <div class="checkout p-3 mt-2">
                    <div class="row">
                        <div class="col-6 sub-details">Total</div>
                        <div class="col-6 product-price" id="total"></div>
                    </div>
                </div>
                <form action="{{ route('order.checkout') }}" method="POST">
                    @csrf
                    <input type="number" class="hidden" name="amount" id="amount">
                    <input type="number" class="hidden" name="id" value="{{ $orderId }}">
                    <button class="btn btn-primary mt-3 main-btn" type="submit">Check out items</button>
                </form>
            </div>

        @endif
 
        </div>
    </div>


    @component('components/freyja')
    @endcomponent

    <script>
        var totalOrder = document.getElementById('totalOrder');
        var total = document.getElementById('total');
        var tab = document.getElementsByClassName('price-list');
        var val = 0;
        for (let index = 0; index < tab.length; index++) {
            val += parseInt(tab[index].textContent);
        }
        totalOrder.innerHTML = val + ' €';
        total.innerHTML = val + ' €';
        document.getElementById('amount').setAttribute('value', val);
    </script>

</body>
</html>