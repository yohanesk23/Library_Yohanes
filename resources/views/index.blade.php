@extends('components.header') 
<!-- Extending the header component -->
@section('content') 
<!-- Starting the content section -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
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
    </div>
@endsection
<!-- Ending the content section -->
