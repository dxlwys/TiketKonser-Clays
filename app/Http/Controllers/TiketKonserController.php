<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tiket;

class TiketKonserController extends Controller
{
    public function index()
    {
        $table = Tiket::all();

        return response()->json([
            'message' => 'Load Data Tiket Success!',
            'data' => $table
        ],200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $table = Tiket::create([
            "jenis_tiket" => $request->jenis_tiket,
            "tanggal" => $request->tanggal,
            "harga_tiket" => $request->harga_tiket,
            "jumlah_tiket" => $request->jumlah_tiket,
            "benefit_tiket" => $request->benefit_tiket
        ]);

        return response()->json([
            "message" => "Store Data Tiket Success!",
            "Tiket" => $table
        ],201);
    }

    public function show($id)
    {
        $table = Tiket::find($id);
        if($table){
            return $table;
        }else{
            return ["message" => "Data Tiket Not Found!"];
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $table = Tiket::find($id);
        if($table){
            $table->jenis_tiket = $request->jenis_tiket ? $request->jenis_tiket : $table->jenis_tiket;
            $table->tanggal = $request->tanggal ? $request->tanggal : $table->tanggal;
            $table->harga_tiket = $request->harga_tiket ? $request->harga_tiket : $table->harga_tiket;
            $table->jumlah_tiket = $request->jumlah_tiket ? $request->jumlah_tiket : $table->jumlah_tiket;
            $table->benefit_tiket = $request->benefit_tiket ? $request->benefit_tiket : $table->benefit_tiket;
            $table->save();

            return $table;
        }else{
            return ["message"=>"Data Tiket Not Found"];
        }
    }

    public function destroy($id)
    {
        $table = Tiket::find($id);
        if($table){
            $table->delete();

            return ["message"=>"Delete Tiket Success!"];
        }else{
            return ["message"=>"Data Tiket Not Found!"];
        }
    }
}