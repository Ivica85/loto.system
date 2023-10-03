@if($errors->any())
    <div class="col-md-4">
        @foreach($errors->all() as $error)
            <p class="bg-danger">{{$error}}</p>
        @endforeach
    </div>

@endif
