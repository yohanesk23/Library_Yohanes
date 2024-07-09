<!-- Check if there is a session message -->
@if (session('message'))
    <!-- Display the alert box with dynamic class based on the message type (success or danger) -->
    <div class="alert alert-{{session('message')['class']}} alert-dismissible fade show" role="alert">
        <!-- Button to close the alert box -->
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <!-- Display the message with a strong emphasis on the message type -->
        <strong>{{ucfirst(session('message')['class'])}}: </strong> {{session('message')['result']}}
    </div>
@endif
