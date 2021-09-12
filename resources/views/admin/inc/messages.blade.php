@if (session('msg'))
    <div class="alert alert-success">
        <p>{{ session('msg') }}</p>
    </div>
@endif
