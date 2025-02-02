<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sale edition</title>
</head>

<body>
  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="deleteModalBody">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="undo-delete">Close</button>
          <form action="" id="formToDelete" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-primary" id="confirm-delete" data-href="{{ url('users/') }}">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>


    <a href="{{ route('usersHome') }}">Go back</a>
    <form action="{{ route('sale.update', $sale->id) }}" style="display:flex;flex-flow:column;gap:2rem; margin-top:1rem;"
        method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="name">Product:</label>
        <input type="text" id="name" name="name" minlength="10" maxlength="230" placeholder="Product name"
            value="{{ old('name', $sale->product) }}">

        <label for="description">Description:</label>
        <textarea name="description" id="description" minlength="40" maxlength="300" placeholder="Product description">{{ old('description', $sale->description) }}</textarea>

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

        @if ($sale->img == null)
            <label for="thumbnail">Choose a thumbnail for the sale:</label>
            <input type="file" id="thumbnail" name="thumbnail"
                accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" onchange="previewThumbnail(event)">

            <img id="thumbnailPreview"
                src="{{ old('thumbnail') ? asset('storage/' . old('thumbnail')) : asset('storage/' . $sale->img) }}"
                alt="Thumbnail Preview"
                style="width:150px; margin-top: 10px; border-radius: 8px; {{ $sale->img ? '' : 'display:none;' }}">
        @else
            <h4>The thumbnail of the sale: </h4>
            <div class="thumbnail-container" style="position: relative; display: inline-block;">
                <img src="{{ url('thumbnail/' . $sale->id) }}" alt="sale_thumbnail" width="400px">
                <!-- Botón de eliminar en la esquina superior derecha para la miniatura -->
                <button type="button" class="delete-btn"
                    style="position: absolute; top: 0; right: 0; background: rgba(255, 0, 0, 0.6); border: none; color: white; font-size: 16px; width: 30px; height: 30px; border-radius: 50%;">&times;</button>
            </div>
        @endif


        @if (count($sale->images) < $maxImages)
            <label for="file">You can add images to your sale(minimum: 2 maximum: {{ $maxImages }}):</label>
            @for ($i = count($sale->images); $i < $maxImages; $i++)
                <input type="file" name="imagenes[]"
                    accept="image/png, image/jpeg, image/webp, image/jpg, image/avif" id="file{{ $i }}"
                    {{ $i <= 1 ? 'required' : '' }}>
            @endfor
        @else
            <div class="sale-imgs">
                <h4>Sale images</h4>
                @foreach ($sale->images as $image)
                    <div class="image-container" style="position: relative; display: inline-block;">
                        <img src="{{ url('image/' . $image->id) }}" alt="sale_image" width="400px">
                        <!-- Botón de eliminar en la esquina superior derecha -->
                        <button type="button" class="delete-btn"
                            style="position: absolute; top: 0; right: 0; background: rgba(255, 0, 0, 0.6); border: none; color: white; font-size: 16px; width: 30px; height: 30px; border-radius: 50%;">&times;</button>
                    </div>
                @endforeach
            </div>
        @endif

        <button>Update it</button>
    </form>
</body>

</html>
