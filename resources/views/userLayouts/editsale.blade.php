<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale edition</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

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

    <!-- Delete ImageModal -->
    <div class="modal fade" id="deleteImageModal" tabindex="-1" aria-labelledby="deleteImageModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteImageModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="deleteImageModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="undo-delete">Close</button>
                    <form action="" id="formToDelete" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-primary" id="confirm-delete"
                            data-href="{{ url('images/') }}">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (count($sale->images) < 2)
        <p>You need to add {{ 2 - count($sale->images)}} more image and update the sale to go back</p>
    @else
        <a href="{{ route('usersHome') }}">Go back</a>
    @endif
    <form action="{{ route('sale.update', $sale->id) }}"
        style="display:flex;flex-flow:column;gap:2rem; margin-top:1rem;" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Product:</label>
        <input type="text" id="name" name="name" minlength="10" maxlength="230" placeholder="Product name"
            value="{{ old('name', $sale->product) }}">

        <label for="description">Description:</label>
        <textarea name="description" id="description" minlength="40" maxlength="600" placeholder="Product description">{{ old('description', $sale->description) }}</textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" min="0" max="10000000" step="0.01" id="price"
            placeholder="Product price" value="{{ old('price', $sale->price) }}">

        <label for="category">Category:</label>
        <select name="category" id="category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category', $sale->category->id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label for="thumbnail">Change the thumbnail for the sale, if you want:</label>
        <input type="file" id="thumbnail" name="thumbnail"
            accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" onchange="previewThumbnail(event)">

        <img id="thumbnailPreview" src="{{ old('thumbnail', url('thumbnail/' . $sale->id)) }}" alt="Thumbnail Preview"
            style="width:400px; margin-top: 10px; border-radius: 8px; {{ $sale->img ? '' : 'display:none;' }}">


        @if (count($sale->images) < $maxImages)
            <label for="file">You can add images to your sale(minimum: 2 maximum: {{ $maxImages }}):</label>
            @for ($i = count($sale->images); $i < $maxImages; $i++)
                <input type="file" name="imagenes[]"
                    accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" id="file{{ $i }}"
                    {{ $i <= 1 ? 'required' : '' }}>
            @endfor

            <h4>Sale images</h4>
            @foreach ($sale->images as $image)
                <div class="image-container" style="position: relative; display: inline-block;">
                    <img src="{{ url('image/' . $image->id) }}" alt="sale_image" width="400px">
                    <!-- Botón de eliminar en la esquina superior derecha -->
                    <a href="" class="delete-image-btn" data-bs-toggle="modal"
                        style="position: absolute; top: 0; right: 0; background: rgba(255, 0, 0, 0.6); border: none; color: white; font-size: 16px; width: 30px; height: 30px; border-radius: 50%;text-decoration:none;"
                        data-bs-target="#deleteImageModal" data-id="{{ $image->id }}">X</a>
                </div>
            @endforeach
        @else
            <div class="sale-imgs">
                <h4>Sale images</h4>
                @foreach ($sale->images as $image)
                    <div class="image-container" style="position: relative; display: inline-block;">
                        <img src="{{ url('image/' . $image->id) }}" alt="sale_image" width="400px">
                        <!-- Botón de eliminar en la esquina superior derecha -->
                        <a href="" class="delete-image-btn" data-bs-toggle="modal"
                            style="position: absolute; top: 0; right: 0; background: rgba(255, 0, 0, 0.6); border: none; color: white; font-size: 16px; width: 30px; height: 30px; border-radius: 50%;text-decoration:none;"
                            data-bs-target="#deleteImageModal" data-id="{{ $image->id }}">X</a>
                    </div>
                @endforeach
            </div>
        @endif

        <button>Update it</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        function previewThumbnail(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('thumbnailPreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <script src="{{ asset('js/deleteImages.js') }}"></script>

</body>

</html>
