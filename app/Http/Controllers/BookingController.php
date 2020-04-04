<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();

        return view("home",compact("bookings"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //controllo dati form
        $request->validate([
            "nome"=> "required|string|max:40",
            "posti"=> "required|numeric",
            "giorno_prenotazione"=> "required|date",
            "orario"=> "required"
        ]);
        // salvo i dati
        $data = $request->all();
        
        $booking = new Booking();
        $booking->fill($data);
        //controllo i posti disponibili
        $postiPrenotati = Booking::all()->sum("posti");
        
        // if($postiPrenotati + $data["posti"] <= 20){
        //     $booking->save();
            if( $booking->save()){
                return redirect()->route('index');
            }else {
                abort("404 probelmi di connessione");
            }
        // }else{
        //     return back()->withInput();
        // }
            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        return view("edit",compact("booking"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        if(empty($booking)){
            return redirect()->back();
        }else{
            $response = $booking->delete();
            if($response){
                return redirect("booking")->with("delete", $booking);
            }else{
                abort("404 errore di rete");
            }
        }
    }
}
