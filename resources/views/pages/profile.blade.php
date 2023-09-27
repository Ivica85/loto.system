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

        <div>
            <p>Credits: {{auth()->user()->credits ?? 0}}</p>
            <a class ="btn btn-outline-primary"href="{{route('profile.add_credits')}}">Add credits</a>
        </div>


        <h1>My account</h1>
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






    <form class="container mt-5 mb-5" method="POST" action="{{route('cards.save')}}" >
        @csrf

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>

        @endif


        <h1>My cards</h1>

        @foreach(Auth::user()->cards as $creditCard)
            <div class="d-flex align-items-center justify-content-evenly">
                <p>{{$creditCard->card_number}} - {{$creditCard->cvv}} - {{$creditCard->expiry}}</p>
                <a class="btn btn-danger" href="{{route('cards_delete',['card'=>$creditCard->id])}}">DELETE</a>
            </div>

        @endforeach

        <div>
            <label for="card_number" class="form-label">Card number</label>
            <input class="form-control" type="number" id="card_number" name="card_number" value="{{old("card_number")}}">
        </div>

        <div>
            <label for="cvv" class="form-label">CVV</label>
            <input class="form-control" type="text" id="cvv" name="cvv" value="{{old('cvv')}}">
        </div>


        <div>
            <label>Expiry month</label>
            <select class="form-select" name="expiry_month">
                @for($i=1;$i<=12;$i++)
                    <option>{{$i}}</option>
                @endfor
            </select>
        </div>

        <div class="mt-3">
            <label>Expiry year</label>
            <select class="form-select" name="expiry_year">
                @for($i=0;$i<=5;$i++)
                    <option>{{date('Y')+$i}}</option>
                @endfor
            </select>
        </div>

        <button class="btn btn-outline-primary mt-3">Save</button>

    </form>


@endsection

