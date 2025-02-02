@extends('layouts.app')

@section('content')
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
    <div class="user-content">
        <h4>Your personal information</h4>
        <form action="{{ route('users.update', [$user->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value=" {{ $user->email }}">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}">
            <input type="submit" value="Update my personal information">
        </form>
        <p>Created at: {{ $user->created_at }}</p>
        <p>Updated at: {{ $user->updated_at }}</p>
    </div>


    <div class="user-sales">
        <h4>Your sales</h4>
        <div class="sales">
            @if (!empty($userSales))
                @foreach ($userSales as $sale)
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
                            <div class="sale-buttons">
                                @if ($sale->isSold != 1)
                                    <a href="">See the sale</a>
                                    <a href="{{route('sale.edit', [$sale->id])}}">Edit the sale</a>
                                    <a href="">Delete the sale</a>
                                @else
                                    <p>this sale was sold succesfully!</p>
                                @endif

                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    No sales available yet... Create your first sale and earn money!
                </div>
            @endif
        </div>
    </div>


@endsection
