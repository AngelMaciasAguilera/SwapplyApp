<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin the sales</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <!-- Delete Sale Modal -->
    <div class="modal fade" id="deleteSaleModal" tabindex="-1" aria-labelledby="deleteSaleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteSaleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="deleteSaleModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="undo-delete">Close</button>
                    <form action="" id="formToDelete" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-primary" id="confirm-delete"
                            data-href="{{ url('sale/') }}">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <a href="{{route('users.index')}}" style="margin-left: 2rem;margin-top:2rem; margin-bottom:2rem;" class="btn btn-primary">Go back</a>


    <h1 style="margin-left: 2rem">User sales</h1>

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
                        <a href="" class="btn btn-primary deleteSaleBtn" style="color: white!important" data-bs-toggle="modal" data-bs-target="#deleteSaleModal" data-product="{{$sale->product}}" data-id="{{$sale->id}}">Delete it</a>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="no-sales-message">
            No sales available yet... Be the first to create your own sale and earn money!
        </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="{{ asset('js/deleteSale.js') }}"></script>

</body>

</html>
