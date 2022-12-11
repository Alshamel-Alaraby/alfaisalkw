@if ($errors->any())
    <div class="card card-danger">
        <div class="card-header">
            <h4>Please Fix This Errors</h4>
        </div>
        <div class="card-body">
            @foreach ($errors->all() as $error)
                <h6 style="color:#e74c3c;">{{ $error }}</h6>
            @endforeach
        </div>
    </div>
    <hr>
@endif
