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
        <p>Updated at: {{$user->updated_at}}</p>
    </div>


    <div class="user-sales">
        <h4>Your sales</h4>
        
    </div>


@endsection
