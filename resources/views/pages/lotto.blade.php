@extends('layout')


@section('content')

    <form method="POST" action="{{route('lotto.buy')}}" class="container mb-5 mt-5">
    @csrf
        <div class="d-flex text-center">
            @for($i = 0; $i < 7; $i++)
                <input style="width:50px" class="rand_number" type="number" name="numbers[]" value="{{rand(0,100)}}">
            @endfor
        </div>

        <button class="btb btn-outline-primary mt-2">Buy a lotto ticket</button>

    </form>


@endsection
