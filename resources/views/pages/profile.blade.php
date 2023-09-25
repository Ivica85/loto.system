@extends('layout')


@section('content')

    <form class="container mt-5 mb-5" method="POST" action="{{route('profile.save')}}" >
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>

        @endif


        <h1>Moj nalog</h1>
        <div>
            <label for="email" class="form-label">Email</label>
            <input class="form-control" type="text" id="email" name="email" value="{{auth()->user()->email}}">
        </div>

        <div>
            <label for="name" class="form-label">Name</label>
            <input class="form-control" type="text" id="name" name="name" value="{{auth()->user()->name}}">
        </div>


        <div>
            <label for="password" class="form-label">Password</label>
            <input class="form-control" type="text" id="password" name="password" placeholder="Insert new password">
        </div>

        <button class="btn btn-outline-primary mt-3">Save</button>

    </form>

@endsection

