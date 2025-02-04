<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $sale->product }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/showsale.css') }}">
</head>

<body>
    <a class="btn btn-primary" href="{{ route('sale.index') }}">Comeback to all sales</a>
    <div class="sale-card">
        <aside>
            @foreach ($sale->images as $image)
                <div class="image-container" style="position: relative; display: inline-block;">
                    <img src="{{ url('image/' . $image->id) }}" alt="sale_image" width="400px">
                </div>
            @endforeach
        </aside>
        <div class="sale-content">
            <h3>{{ $sale->product }}</h3>
            <p>{{ $sale->description }}</p>
            <p>Dealer: {{ $sale->user->name }}</p>
            <p>Category: {{ $sale->category->name }}</p>
            <p>Price: {{ $sale->price }}</p>
            @if ($user != null)
                <a class="btn btn-primary" href="{{ route('buySale', $sale->id) }}">Buy it!</a>
            @else
                <a class="btn btn-primary" href="{{ route('register') }}">Buy it!</a>

            @endif
        </div>
    </div>

    <div class="related-sales">
        <h3>Related sales: </h3>
        @if (!empty($relatedSales))
            @foreach ($relatedSales as $sale)
                <div class="sale-card">
                    <div class="header-img-card">
                        <img src="{{ url('thumbnail/' . $sale->id) }}" alt="sale_image" width="400px">
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
        @else
            <div>
                No sales available yet... Be the first to create your own sale and earn money!
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
