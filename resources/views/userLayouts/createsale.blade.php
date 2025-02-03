<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creating an offer</title>
    <link rel="stylesheet" href="{{ asset('css/createsale.css') }}">
</head>

<body>
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
    </div>
    @endif

    <a href="{{ route('sale.index') }}" class="back-link">Go back</a>

    <div class="form-container">
        <form action="{{route('sale.store')}}" method="POST" enctype="multipart/form-data" class="sale-form">
            @csrf
            @method('POST')

            <label for="name" class="form-label">Product:</label>
            <input type="text" id="name" name="name" minlength="10" maxlength="230" placeholder="Product name" required class="form-input">

            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" minlength="40" maxlength="600" placeholder="Product description" required class="form-textarea"></textarea>

            <label for="price" class="form-label">Price:</label>
            <input type="number" name="price" min="0" max="10000000" step="0.01" id="price" placeholder="Product price" required class="form-input">

            <label for="category" class="form-label">Category:</label>
            <select name="category" id="category" required class="form-select">
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>

            <label for="thumbnail" class="form-label">Choose a thumbnail for the sale:</label>
            <input type="file" id="thumbnail" name="thumbnail" required accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" onchange="previewThumbnail(event)" class="form-file">
            <img id="thumbnailPreview" src="#" alt="Thumbnail Preview" style="display:none;">

            <label for="file" class="form-label">Select at least 2 images for the sale (with a max of {{$maxImages}} images):</label>
            @for ($i = 0; $i < $maxImages; $i++)
                @if ($i <= 1)
                    <input type="file" name="imagenes[]" accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" id="file{{ $i }}" required class="form-file">
                @else
                    <input type="file" id="file{{ $i }}" name="imagenes[]" class="form-file">
                @endif
            @endfor

            <button type="submit" class="submit-btn">Create it</button>
        </form>
    </div>

    <script>
        function previewThumbnail(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('thumbnailPreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>

</html>
