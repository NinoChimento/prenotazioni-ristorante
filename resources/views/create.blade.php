@extends('layouts.layout')
@section('content')
@if($errors->any())
    <h4 class="text-center">{{$errors->first()}}</h4>
@endif
<h1 class="text-center">Nuova Prenotazione</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if ($errors->any())
                   <div class="alert alert-danger">
                       <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                       </ul>
                   </div>
                @endif
                <form action="{{route("booking.store")}}" method="post">
                    @csrf
                    @method("POST")
                   <div class="form-group">
                     <label for="Name">Inserisci Nominativo</label>
                     <input  class="form-control" type="text" name="nome" value="{{old("nome")}}">
                   </div>
                   <div class="form-group">
                     <label for="Name">Numero Persone</label>
                     <input  class="form-control" type="number" name="posti" value="{{old("posti")}}">
                   </div>
                   <div class="form-group">
                       <label for="data">Data Prenotazione</label>
                       <input type="date" name="giorno_prenotazione" id=""  value="{{old("giorno_prenotazione")}}">
                   </div>
                   <div class="form-group">
                       <label for="data">Oario Prenotazione</label>
                       <input type="time" name="orario" id=""  value="{{old("orario")}}">
                   </div>
                   <button type="submit">Prenota</button>
                </form>
            </div>
        </div>
    </div>
@endsection 