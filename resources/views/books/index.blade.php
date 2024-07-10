@extends('books.components.header') 
<!-- Extending the header component -->
@section('content') 
<!-- Starting the content section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    @include('books.components.alert')
                    <h5 class="card-title">Add a Book</h5>
                    <!-- Form for adding a book -->
                    <form id="bookForm" method="post" action="{{route('save_book')}}">
                        @csrf 
                        <!-- CSRF token for security -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Enter book title" required>
                            <!-- Input for book title -->
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author" id="author"
                                   placeholder="Enter author name" required>
                            <!-- Input for author name -->
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Add</button>
                        <!-- Submit button -->
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-5">
            <div class="row">
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search</h5>
                            <form method="get" action="{{ route('home') }}">
                                <div class="form-group">
                                    <label for="author">Search by Title / Author</label>
                                    <input value="{{ request()->search }}" type="text" class="form-control" name="search" placeholder="Search ..">
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Search</button>
                                <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Clear</a>
                                <div class="btn-group mt-3">
                                    <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sort by
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><button class="dropdown-item" type="submit" name="sort_by" value="title_asc">Title (A-Z)</button></li>
                                        <li><button class="dropdown-item" type="submit" name="sort_by" value="title_desc">Title (Z-A)</button></li>
                                        <li><button class="dropdown-item" type="submit" name="sort_by" value="author_asc">Author (A-Z)</button></li>
                                        <li><button class="dropdown-item" type="submit" name="sort_by" value="author_desc">Author (Z-A)</button></li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Export</h5>
                            <label>Choose Fields and Format</label>
                            <form id="exportForm" method="post" action="{{route('export_to_csv_or_xml')}}">
                                @csrf
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex">
                                        <div class="form-check ml-5" style="margin: 5px 40px 5px 5px">
                                            <input class="form-check-input" name="fields[]" type="checkbox" value="author" id="flexCheckDefault1" onclick="validateCheckboxes()">
                                            <label class="form-check-label" for="flexCheckDefault1">
                                                Author
                                            </label>
                                        </div>
                                        <div class="form-check ml-5" style="margin: 5px">
                                            <input class="form-check-input" name="fields[]" type="checkbox" value="title" id="flexCheckChecked" onclick="validateCheckboxes()">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                Title
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                            <input type="radio" class="btn-check" name="export_type" id="btnradio1" value="csv" checked>
                                            <label class="btn btn-outline-primary waves-effect" for="btnradio1">CSV</label>
                                            <input type="radio" class="btn-check" name="export_type" id="btnradio2" value="xml">
                                            <label class="btn btn-outline-primary waves-effect" for="btnradio2">XML</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" id="exportButton" class="btn btn-primary mt-3">Export</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Books</h5>
                    <div class="table-responsive">
                        <table class="table table-striped mt-4">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody id="bookList">
                                @foreach($books as $book)
                                    <tr>
                                        <td>{{$book->title}}</td>
                                        <td>{{$book->author}}</td>
                                        <td>
                                            <a href="{{route('delete_book',['id' => $book->id])}}"
                                               onclick="return confirm('Do you want to delete this?')"
                                               class="btn btn-danger btn-sm delete" data-id="{{$book->id}}">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <a href="{{route('edit_book',['id' => $book->id])}}"
                                               class="btn btn-warning btn-sm edit" data-id="{{$book->id}}">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function validateCheckboxes() {
                const checkboxes = document.querySelectorAll('input[name="fields[]"]');
                const exportButton = document.getElementById('exportButton');
                let isChecked = false;

                checkboxes.forEach((checkbox) => {
                    if (checkbox.checked) {
                        isChecked = true;
                    }
                });

                exportButton.disabled = !isChecked;
            }
            // Call validateCheckboxes once on page load to initialize the state
            document.addEventListener('DOMContentLoaded', validateCheckboxes);
        </script>
    </div>
@endsection
<!-- Ending the content section -->
