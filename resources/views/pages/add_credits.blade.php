@extends('layout')

@section('content')

    <form class="container mt-5 mb-5 col-12 col-md-4" action="{{route('credits_add')}}" method="POST">
    @csrf

        <div>
            <label for="">Select a card</label>
            <select name="credit_card" class="form-select" name="" id="">
                @foreach(auth()->user()->cards as $card)
                    <option value="{{$card->id}}">{{$card->card_number}}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="mb-2" for="credits">Credit amount</label>
            <select name="credits" class="form-select" id="credits">
                @for($i=1; $i<=10 ; $i++)
                    @php $creditsAmount = $i*env('CREDITS_QUANTIFIER') @endphp
                    <option value="{{ $creditsAmount }}">{{$creditsAmount}} credit (cena: {{$creditsAmount*env("CREDITS_VALUE_RSD")}}rsd)</option>
                @endfor
            </select>
        </div>

        <button class="btn btn-primary">Add credit</button>

    </form>

@endsection
