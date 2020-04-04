@extends('layouts.layout')
@section('content')
@if (session("delete"))
        <div class="alert alert-danger">
            E stata cancellata la prenotazione a nome di :{{session("delete")->nome}}
        </div>
    @endif
@if (session("newBooking"))
        <div class="alert alert-success">
            Nuova prenotazione a nome di  :{{session("newBooking")->nome}}
        </div>
    @endif
@if (session("updateBooking"))
        <div class="alert alert-success">
            Modifica prenotazione a nome di  :{{session("updateBooking")->nome}}
        </div>
    @endif    
<h1 class="text-center">Prenotazioni risotrante</h1>
<h2 class="text-center"><a class="btn btn-success" href="{{route("booking.create")}}">Prenota</a></h2>
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
                   <td><a class="btn btn-primary" href="{{route("booking.edit",$booking)}}">Modifica</a></td>
                   <td>
                     <form action="{{route("booking.destroy",$booking)}}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button class="btn btn-danger" type="submit">Cancella</button>
                     </form>
                   </td>
                 </tr>
                </tbody>
               @empty
                   
               @endforelse
               
             </table> 
        </div>
    </div>
</div>
@endsection