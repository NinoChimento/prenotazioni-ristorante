<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Booking;
class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // controlli 

     protected $validazione = [
        "nome" => "required|string|max:40",
        "posti" => "required|numeric",
        "giorno_prenotazione" => "required|date",
        "orario" => "required"
     ];

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
        $request->validate(
            $this->validazione
            );
        // salvo i dati
        $data = $request->all();
        // controllo che il cliente non abbia gia altre prenotazioni
        //tramite il nomitavivo non avendo gestito in questo lavoro autenticazione user
        $control = Booking::where("nome",$data["nome"])->first();
        
        if (!$control) {
            return redirect()->back()->withInput();
        }
        //controllo i posti disponibili ed eventualmente accetto la prenotazione
        $postiPrenotati = Booking::all()->sum("posti");
        
        if($postiPrenotati + $data["posti"] <= 20){
            $booking = new Booking();
            $booking->fill($data);
            $booking->save();
            if( $booking->save()){
                return  redirect("booking")->with("newBooking", $booking);
            }else {
                abort("404 probelmi di connessione");
            }
        }else{
           return Redirect::back()->withErrors(['Posti esauriti riprova tra un ora']);
        }
            
        
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
    public function update(Request $request, Booking $booking)
    {   

        if (empty($booking)) {
            abort("404 prenotazione inesistente");
        }
        // controllo dati
        $request->validate(
            $this->validazione
        );
        $data = $request->all();
        // compilazione dati
        $booking->fill($data);

        //controllo posti disponibili 
        $postiPrenotati = Booking::all()->sum("posti");

        if ($postiPrenotati + $data["posti"] <= 20) {
            $booking->save();
        // salvatagio dati

        $response = $booking->update();
        }   
        $dati = [
            "response" => $response,
            "booking"=> $booking
        ];

        if ($response) {
           return  redirect("booking")->with("updateBooking",$booking);
        }else {
            return redirect()->back($dati);
        }

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
