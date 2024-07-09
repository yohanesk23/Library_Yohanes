@extends('books.components.header')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit a Book</h5>
                    <form id="bookForm" method="post" action="{{route('update_book')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$book->id}}">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" value="{{$book->title}}" class="form-control" name="title" id="title"
                                   placeholder="Enter book title" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" value="{{$book->author}}" class="form-control" name="author" id="author"
                                   placeholder="Enter author name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                        <a class="btn btn-secondary mt-3" href="{{route('home')}}">Back</a>
                    </form>
                </div>
            </div>
        </div>

    </div>

@endsection
