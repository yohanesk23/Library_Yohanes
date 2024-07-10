<!-- 
    This Blade template is used to display the form for editing a book.
    It includes the header component and displays any alerts.
    The form allows the user to edit the book's title and author and submit the changes.
    It also includes a button to go back to the home page.
-->

@extends('books.components.header')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- Include alert component for displaying messages -->
                    @include('books.components.alert')
                    
                    <!-- Title of the form -->
                    <h5 class="card-title">Edit a Book</h5>
                    
                    <!-- Form for editing a book -->
                    <form id="bookForm" method="post" action="{{route('update_book')}}">
                        @csrf
                        <!-- Hidden input to store the book ID -->
                        <input type="hidden" name="id" value="{{$book->id}}">
                        
                        <!-- Input field for the book title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" value="{{$book->title}}" class="form-control" name="title" id="title"
                                   placeholder="Enter book title" required>
                        </div>
                        
                        <!-- Input field for the book author -->
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" value="{{$book->author}}" class="form-control" name="author" id="author"
                                   placeholder="Enter author name" required>
                        </div>
                        
                        <!-- Submit button to update the book -->
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                        
                        <!-- Button to go back to the home page -->
                        <a class="btn btn-secondary mt-3" href="{{route('home')}}">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
