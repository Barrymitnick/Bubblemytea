<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/home.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

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
                Our Bubble Teas
            @endslot

            @slot('button')
                <a class="btn btn-outline-dark btn-cart" href="{{ route('order.history') }}">
                    Order History
                </a>
                <a class="btn btn-outline-dark btn-cart" href="/cart">
                    Cart <i class="icon ion-md-cart"></i>
                </a>
            @endslot
        @endcomponent

        <div class="row mt-4">
            @foreach ($products as $product)
                <div class="col-4 p-0 mt-3">
                    <div class="product-card">
                        <div class="product-details pl-4 pr-2" onclick="showProduct({{ json_encode($product) }})">
                            <p class="ml-5 mt-4 product-title">{{ $product->Name }}</p>
                            <div class="ml-5 mt-4 d-flex justify-content-between">
                                <p class="product-price m-0">{{ $product->Price }} €</p>
                                <button class="btn product-btn">
                                    <i class="icon ion-md-add"></i>
                                </button>
                            </div>
                        </div>
                        <img src="{{ $product->Image }}" class="product-image" alt="">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="modal fade" id="product-details-modal" tabindex="-1" role="dialog" aria-labelledby="product-details-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
          <div class="modal-content">
           
            <div class="modal-body">
              <div class="row mt-4">
                <div class="col-4">
                    <img class="product-details-image" alt="">
                </div>
                <div class="col-8">
                    <h1 class="product-details-title"></h1>
                    <p class="product-details-description"></p>
                    <p class="product-details-price"></p>
                    <hr>

                    <form action="{{ route('order.add') }}" method="POST">
                        @csrf
                        <input type="number" name="qty" id="hideQty" value="1">
                        <input type="number" name="product_id" id="hideProductId">

                        <div class="row">
                            <div class="col-6">
                                <p>Poppings</p>
                            </div>
                            <div class="col-6 float-right">
                                <select class="form-select product-details-select" aria-label="Default select example" name="popping" required="required">
                                    <option>Select a popping</option>
                                    @foreach ($poppings as $popping)
    
                                        <option selected value="{{ $popping->Id }}">{{ $popping->Name }}</option>
    
                                    @endforeach
                                  </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">Sugar</div>
                            <div class="col-6">
                                <input type="range" class="form-range" min="0" max="4" step="1" id="customRange3" name="sugar" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-6">Quantity</div>
                            <div class="col-6">
                                <div class="d-flex justify-content-between count">
                                    <button class="btn product-btn" type="button" onclick="minus()">
                                        <i class="icon ion-md-remove"></i>
                                    </button>
                                    <p class="p-0 m-0" id="number">1</p> 
                                    <button class="btn product-btn" type="button" onclick="plus()">
                                        <i class="icon ion-md-add"></i>
                                    </button>
                                </div>
                            </div>
                        </div>


                        <div class="mt-5">
                            <input class="btn btn-primary pl-4 pr-4 main-btn" type="submit" value="Add to cart">
                        </div>

                    </form>

                </div>
              </div>
            </div>
          
          </div>
        </div>
      </div>

      @component('components/freyja')
      @endcomponent

      @if(session()->has('successMessage'))
        <div class="alert alert-success alert-custom animate__fadeOutDown" id="alert-success">
            {{ session()->get('successMessage') }}
        </div>
      @endif

      <script src="/js/home.js"></script>
</body>

</html>