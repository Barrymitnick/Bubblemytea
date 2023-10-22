<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/cart.css">
    <link rel="stylesheet" href="/css/admin.css">

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
                Manage your products
            @endslot

            @slot('button')
            
            @endslot
        @endcomponent


        <div class="row mt-5">
            <div class="col-8">
                <p class="title-list">Bubble teas list</p>

                <div class="w-75 text-right add-bloc">
                    <form action="{{ route( 'product.add' ) }}" method="GET">
                        @csrf
                        <input type="text" class="form-control custom-input" placeholder="Tea name" name="name" required>
                        <input type="text" class="form-control custom-input mt-1" placeholder="Image Link" name="image" required>
                        <input type="number" step=".01" class="form-control custom-input mt-1" placeholder="Price" name="price" required>
                        <textarea  class="form-control custom-input mt-1" name="description" required id="" cols="30" rows="10">Description</textarea>
                        <button class="btn btn-primary main-btn mt-2" type="submit">Add product</button>
                    </form>
                </div>
              
                <hr>
                @foreach ($products as $item)
                    
                <form action="{{ route ( 'product.edit' ) }}" method="POST">
                @csrf
                    <div class="row">
                        

                            <div class="col-2">
                                <img src="{{ $item->Image }}" class="product-image" alt="">
                            </div>

                            <div class="col-6">
                                <input class="form-control custom-input mb-1" value="{{ $item->Name }}" name="name">
                                <textarea class="form-control custom-input mb-1" name="description" id="" cols="30" rows="10" >{{ $item->Description }}</textarea>
                                <input class="form-control custom-input" value="{{ $item->Image }}" name="image">
                            </div>

                            <div class="col-2">
                                <input type="number" step=".01" class="form-control custom-input mb-1" value="{{ $item->Price }}" name="price">
                            </div>


                            <div class="col-2">
                                <input type="text" class="hidden" value="{{ $item->Id }}" name="id">
                                <button class="btn btn-outline-dark" type="submit" name="action" value="edit">
                                    <i class="icon ion-md-create"></i>
                                </button>
                                <button class="btn btn-outline-danger" name="action" value="delete">
                                    <i class="icon ion-md-trash"></i>
                                </button>
                            </div>

                    </div>
                </form>

                <hr>

                @endforeach

            </div>

            <div class="col-4" style="border-left:1px solid #b5b5b5">
                 <p class="title-list">Poppings list</p>

                 <div class="add-bloc">
                    <form action="{{ route('popping.add') }}" method="POST">
                        @csrf
                        <div class="text-right">
                            <input type="text" class="form-control custom-input" name="name" placeholder="Popping name" required>
                            <button class="btn btn-primay main-btn mt-2" type="submit">Add popping</button>
                        </div>
                    </form>
                 </div>
                 <hr>

                @foreach ($poppings as $popping)
                    
                <form action="{{ route('poppings.edit') }}" method="POST">
                    @csrf
                    <div class="row mt-3">

                            <div class="col-8">
                                <input class="form-control custom-input" type="text" value="{{ $popping->Name }}" name="name" required>
                                <input class="form-control custom-input hidden" type="text" value="{{ $popping->Id }}" name="id" required>
                            </div>
    
                            <div class="col-2">
                                <button class="btn btn-outline-dark" name="action" value="edit" type="submit">
                                    <i class="icon ion-md-create"></i>
                                </button>
                            </div>
    
                            <div class="col-2">
                                <button class="btn btn-outline-danger" name="action" value="delete" type="submit">
                                    <i class="icon ion-md-trash"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <hr>

                @endforeach
            </div>
        </div>

    </div>
</body>
</html>