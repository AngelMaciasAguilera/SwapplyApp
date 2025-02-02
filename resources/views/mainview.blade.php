<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to Swapply</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <style>
        .pagination-container nav {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination {
            display: flex;
            list-style: none;
            gap: 10px;
            padding: 0;
        }

        .pagination li {
            border: 1px solid #ddd;
            padding: 8px 12px;
            border-radius: 5px;
            background: #f8f9fa;
        }

        .pagination li a {
            text-decoration: none;
            color: #007bff;
        }

        .pagination .active {
            background: #007bff;
            color: white;
        }
    </style>
    
    <header style="background-color: purple; color:white;">
        <h3>SWAPPLY</h3>
        <nav>
            <ul class="link-list">
                @if(Auth::user() == null)
                    <li><a href="{{route('login')}}" style="color:white;">Log in</a></li>
                    <li><a href="{{route('register')}}" style="color:white;">Sign in</a></li>
                @else
                    <li><a href="{{route('home')}}" style="color:white;">My account</a></li>
                    <a href="{{route('sale.create')}}" class="btn btn-primary">Create your offer!</a>
                @endif
            </ul>
        </nav>
    </header>


    @if (!empty($sales))
    <div class="paginate">{{$sales->links()}}</div>
        @foreach ($sales as $sale)
            <div class="sale-card">
                <div class="header-img-card">
                    <img src="{{url('thumbnail/' . $sale->id)}}" alt="sale_image" width="400px" >
                </div>
                <div class="content-card">
                    <h3>{{$sale->product}}</h3>
                    <p>{{$sale->created_at}}</p>
                    <p>{{Str::limit($sale->description, 100)}}</p>
                </div>
                <div class="footer-card">
                    <p>{{$sale->price}} €</p>
                    <a href="">See more</a>
                </div>
            </div>
        @endforeach
    @else
        <div>
            No sales available yet... Be the first to create your own sale and earn money!
        </div>
    @endif


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
