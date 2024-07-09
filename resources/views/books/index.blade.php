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
                <div class="col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Search</h5>
                            <form method="get">
                                <div class="form-group">
                                    <label for="author">Search by Title / Author</label>
                                    <input value="{{request()->search}}" type="text" class="form-control" name="search"
                                           placeholder="Search .."
                                           required>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Search</button>
                                <a class="btn btn-secondary mt-3">Clear</a>
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
                                            class="btn btn-danger btn-sm delete" data-id="{{$book->id}}"><i
                                            class="fa fa-trash"></i>
                                        </a>
                                        <a href="{{route('edit_book',['id' => $book->id])}}"
                                            class="btn btn-warning btn-sm edit" data-id="{{$book->id}}"><i
                                            class="fa fa-pencil"></i>
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
    </div>
@endsection
<!-- Ending the content section -->
