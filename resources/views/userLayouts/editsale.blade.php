<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale edition</title>
</head>
<body>
    <form action="{{ route('sale.update', $sale->id) }}" style="display:flex;flex-flow:column;gap:2rem; margin-top:1rem;" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Product:</label>
        <input type="text" id="name" name="name" minlength="10" maxlength="230" placeholder="Product name" value="{{ old('name', $sale->product) }}">

        <label for="description">Description:</label>
        <textarea name="description" id="description" minlength="40" maxlength="300" placeholder="Product description">{{ old('description', $sale->description) }}</textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" min="0" max="10000000" step="0.01" id="price" placeholder="Product price" value="{{ old('price', $sale->price) }}">

        <label for="category">Category:</label>
        <select name="category" id="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category', $sale->category->id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

         @if ($sale->img == null)
         <label for="thumbnail">Choose a thumbnail for the sale:</label>
         <input type="file" id="thumbnail" name="thumbnail" accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" onchange="previewThumbnail(event)">

         <img id="thumbnailPreview" src="{{ old('thumbnail') ? asset('storage/' . old('thumbnail')) : asset('storage/' . $sale->img) }}" alt="Thumbnail Preview" style="width:150px; margin-top: 10px; border-radius: 8px; {{ $sale->img ? '' : 'display:none;' }}">
         @else
            <h4>The thumbnail of the sale: </h4>
            <div>
                <img src="{{ url('thumbnail/' . $sale->id) }}" alt="sale_image" width="400px">
            </div>
         @endif


        @if ($sale->images)

        @else

        @endif

        <label for="file">Select at least 2 images for the sale (with a max of {{ $maxImages }} images):</label>
        @for ($i = 0; $i < $maxImages; $i++)
            <input type="file" name="imagenes[]" accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" id="file{{ $i }}" {{ $i <= 1 ? 'required' : '' }}>
        @endfor

        <button>Update it</button>
    </form>
</body>
</html>
