@extends('layout')

@section('content')



    <button onclick="getRandomNumbers()">Generate a random combination</button>

    <form id="rndNumbers" method="POST" action="{{route('lotto.buy')}}" class="container mb-5 mt-5">
        @csrf
        @include('partials.errors')
        <p class="text-primary">{{Session::get('message')}}</p>

        <div class="d-flex text-center">
            @for($i = 0; $i < 7; $i++)
                <input style="width:50px" class="rand_number" type="number" name="numbers[]" value="{{rand(0,100)}}">
            @endfor
        </div>

        <button class="btb btn-outline-primary mt-2">Buy a lotto ticket</button>
    </form>

    <script>
        function getRandomNumbers() {
            const AMOUNT = 8; //
            const BOTTOMRANGE = 1;
            const TOPRANGE = 100;

            let numbers = [];

            for (let i = 0; i < AMOUNT; i++) {
                let rndNumber = Math.floor(Math.random() * (TOPRANGE - BOTTOMRANGE + 1)) + BOTTOMRANGE;
                numbers.push(rndNumber);
            }

            let div = document.getElementById('rndNumbers');
            let inputs = div.querySelectorAll("input[type=number]");

            for (let i = 0; i < AMOUNT; i++) {
                inputs[i].value = numbers[i];
            }
        }
    </script>
@endsection
