<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Creating an offer</title>
</head>

<body>
    <a href="{{ route('sale.index') }}" >Go back</a>
    <form action="{{route('sale.store')}}" style="display:flex;flex-flow:column;gap:2rem; margin-top:1rem;" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <label for="name">Product:</label>
        <input type="text" id="name" name="name" minlength="40" maxlength="230" placeholder="Product name" required>
        <label for="description">Description:</label>
        <textarea name="description" id="description" minlength="40" maxlength="300" placeholder="Product description" required></textarea>
        <label for="price">Price:</label>
        <input type="number" name="price" min="0"  max="10000000" step="0.01" id="price" placeholder="Product price" required>
        <label for="category">Category:</label>
        <select name="category" id="category" required>
            @foreach ($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>

        <label for="thumbnail">Choose a thumbnail for the sale:</label>
        <input type="file" id="thumbnail" name="thumbnail" accept="image/*" onchange="previewThumbnail(event)">
        <img id="thumbnailPreview" src="#" alt="Thumbnail Preview" style="display:none; width:150px; margin-top: 10px; border-radius: 8px;">

        <label for="file">Select at least 2 images for the sale (with a max of {{$maxImages}} images):</label>
        @for ($i = 0; $i < $maxImages; $i++)
            @if ($i <= 1)
                <input type="file" name="imagenes[]" id="file{{ $i }}" required>
            @else
                <input type="file" id="file{{ $i }}" name="imagenes[]">
            @endif

        @endfor
        <button>Create it</button>
    </form>

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
