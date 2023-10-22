<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/animate.css">
    <link rel="stylesheet" href="/css/home.css">
    <link rel="stylesheet" href="/css/profil.css">


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>

    <title>Document</title>
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
                Hi 👋 {{ $name }}
            @endslot

            @slot('button')
                <a class="btn btn-outline-dark btn-cart" href="{{ route('user.logout') }}">
                    Log Out
                    <i class="icon ion-md-log-out"></i>
                </a>
                <a class="btn btn-outline-dark btn-cart" href="/">
                    Back to shop
                </a>
            @endslot
        @endcomponent
    </div>

    <form action="{{ route ('user.update') }}" method="POST">
        <div class="container">
            <div class="row mt-5">
                    @csrf
                    <div class="col-6">
                        <div class="container box-input">
                            <label for="email">Email address</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">
                                        <i class="icon ion-md-mail"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control custom-input" id="email" aria-describedby="basic-addon3" name="email" value="{{ $email }}" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="container box-input">
                            <label for="email">Name</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon3">
                                        <i class="icon ion-md-person"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control custom-input" id="email" aria-describedby="basic-addon3" name="name" value="{{ $name }}" required>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="row">
                    <div class="col-9"></div>
                    <div class="col-3 text-left">
                        <input class="btn btn-primary pl-4 pr-4 main-btn" type="submit" value="Update my profile">
                    </div>
                </div>

            </div>
        </form>

        <img src="/images/cat.gif" class="cat">

        @if(session()->has('successMessage'))
        <div class="alert alert-success alert-custom animate__fadeOutDown" id="alert-success">
            {{ session()->get('successMessage') }}
        </div>
      @endif
    
</body>
</html>