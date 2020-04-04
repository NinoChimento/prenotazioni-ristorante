@extends('layouts.layout')
@section('content')
<h1 class="text-center">Prenotazioni risotrante</h1>
<h2 class="text-center"><a class="btn btn-success" href="{{route("create")}}">Prenota</a></h2>
<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
               <thead>
                 <tr>
                   <th scope="col">Nome</th>
                   <th scope="col">Posti</th>
                   <th scope="col">Data</th>
                   <th scope="col">Orario</th>
                   <th scope="col">Modifica</th>
                   <th scope="col">Cancella</th>
                 </tr>
               </thead>
               @forelse ($bookings as $booking)
                <tbody>
                 <tr>
                   <td>{{$booking->nome}}</td>
                   <td>{{$booking->posti}}</td>
                   <td>{{$booking->giorno_prenotazione}}</td>
                   <td>{{$booking->orario}}</td>
                   <td><a class="btn btn-primary" href="">Modifica</a></td>
                 </tr>
                </tbody>
               @empty
                   
               @endforelse
               
             </table> 
        </div>
    </div>
</div>
@endsection