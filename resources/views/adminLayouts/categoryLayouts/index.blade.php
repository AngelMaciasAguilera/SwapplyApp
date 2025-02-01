<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The categories</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>
    <a href="{{ route('users.index') }}" class="btn">Go back</a>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCategory"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="deleteCategoryModalBody">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="undo-delete">Close</button>
                    <form action="" id="formCategoryToDelete" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-primary" id="confirm-delete"
                            data-href="{{ url('category/') }}">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Create a Category</h5>
                </div>
                <div class="modal-body" id="modalBody">
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        @method('POST')
                        <label for="name">Name:</label>
                        <input type="text" name="name" id="name" maxlength="230" required>
                        <button class="btn btn-primary">Create setting</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="undo-delete">Close</button>
                </div>
                <div class="modal-footer">
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

    <a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"
        data-bs-whatever="@getbootstrap">Create setting</a>


    <div class="container">
        @foreach ($categories as $category)
            <div>Category {{ $category->id }} with name: {{ $category->name }}
                <ul>
                    <li><a href="" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showModal"
                            data-bs-whatever="@getbootstrap">Show</a> </li>

                    <div class="modal fade" id="updateModal{{ $category->id }}" tabindex="-1"
                        aria-labelledby="updateModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="">Update the category</h5>
                                </div>
                                <div class="modal-body" id="modalBody">
                                    <form action="{{ route('category.update', [$category->id]) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <label for="name">Name:</label>
                                        <input type="text" name="name" id="name"
                                            value="{{ $category->name }}">
                                        <button class="btn btn-primary">Update</button>
                                    </form>

                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        id="undo-delete">Close</button>
                                </div>
                                <div class="modal-footer">
                                </div>
                            </div>
                        </div>
                    </div>

                    <li><a href="" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#updateModal{{ $category->id }}">Update</a></li>


                    <li><a href="" class="btn btn-primary deleteCategoryBtn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-categoryid="{{ $category->id }}" data-categoryname="{{ $category->name }}">Delete</a></li>
                </ul>
            </div>
        @endforeach
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>
