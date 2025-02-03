<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Swapply</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>

    <header class="main-header">
        <h3>SWAPPLY</h3>
        <nav>
            <ul class="link-list">
                @if (Auth::user() == null)
                    <li><a href="{{ route('login') }}">Log in</a></li>
                    <li><a href="{{ route('register') }}">Sign in</a></li>
                @else
                    <li><a href="{{ route('home') }}">My account</a></li>
                    <a href="{{ route('sale.create') }}" class="btn btn-primary">Create your offer!</a>
                @endif
            </ul>
        </nav>
    </header>

    @if (session('message'))
        <div class="alert alert-success" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            {{ $errors->first() }}
        </div>
    @endif

    @if (!empty($sales))
        <div class="sales-list">
            @foreach ($sales as $sale)
                <div class="sale-card">
                    <div class="header-img-card">
                        <img src="{{ url('thumbnail/' . $sale->id) }}" alt="sale_image">
                    </div>
                    <div class="content-card">
                        <h3>{{ $sale->product }}</h3>
                        <p>{{ $sale->created_at }}</p>
                        <p>{{ Str::limit($sale->description, 100) }}</p>
                    </div>
                    <div class="footer-card">
                        <p>{{ $sale->price }} €</p>
                        <a href="{{ route('sale.show', $sale->id) }}">See more</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-sales-message">
            No sales available yet... Be the first to create your own sale and earn money!
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
