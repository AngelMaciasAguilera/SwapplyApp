<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The setting</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <a href="{{ route('users.index') }}">Go back</a>

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

    @if($setting == null)
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"
        data-bs-whatever="@getbootstrap">Create a setting</a>
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Create the setting</h5>
                </div>
                <div class="modal-body" id="modalBody">
                    <form action="{{route('setting.store')}}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" maxlength="25" required>
                        <label for="maxImages">Max of images for a sale:</label>
                        <input type="number" name="maxImages" id="maxImages" min="1" max="6" value="1">
                        <button class="btn btn-primary">Create setting</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="undo-delete">Close</button>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    @else
    <ul>
        <li>Name: {{ $setting->name }}</li>
        <li>Max o images: {{ $setting->maxImages }}</li>
        <li>Created in: {{ $setting->created_at }} </li>
        <li>Updated in: {{ $setting->updated_at }}</li>
    </ul>

    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal"
        data-bs-whatever="@getbootstrap">Edit setting</a>

    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Create the setting</h5>
                </div>
                <div class="modal-body" id="modalBody">
                    <form action="{{ route('setting.update', $setting->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Setting id: {{ $setting->id }}</label>
                        </div>
                        <div class="mb-3">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" maxlength="25" required value="{{$setting->name}}">
                        </div>
                        <div class="mb-3">
                            <label for="maxImages">Max of images for a sale:</label>
                            <input type="number" name="maxImages" id="maxImages" min="1" max="6"
                                value="{{$setting->maxImages}}">
                        </div>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>

                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="undo-delete">Close</button>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>