
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Add a Book</h5>
                    <form id="bookForm" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title"
                                   placeholder="Enter book title" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author" id="author"
                                   placeholder="Enter author name"
                                   required>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>