@extends('layouts.layout')
@section('content')
<h1 class="text-center">Nuova Prenotazione</h1>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{route("booking.update",$booking)}}" method="post">
                    @csrf
                    @method("PATCH")
                   <div class="form-group">
                     <label for="Name">Inserisci Nominativo</label>
                     <input  class="form-control" type="text" name="nome" value="{{$booking->nome}}">
                   </div>
                   <div class="form-group">
                     <label for="Name">Numero Persone</label>
                     <input  class="form-control" type="number" name="posti" value="{{$booking->posti}}">
                   </div>
                   <div class="form-group">
                       <label for="data">Data Prenotazione</label>
                       <input type="date" name="giorno_prenotazione" id="" value="{{$booking->giorno_prenotazione}}">
                   </div>
                   <div class="form-group">
                       <label for="data">Oario Prenotazione</label>
                       <input type="time" name="orario" id="" value="{{$booking->orario}}">
                   </div>
                   <button type="submit">Prenota</button>
                </form>
            </div>
        </div>
    </div>
@endsection 