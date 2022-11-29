<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Tiket;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $table = Payment::all();

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
        $customer_id = $request->user()->id;

        $ID_tiket = $request->ID_tiket;
        $harga_tiket = Tiket::where('id', $ID_tiket)->value('harga_tiket');

        $table = Payment::create([
            "ID_tiket" => $ID_tiket,
            "Customer_ID" => $customer_id,
            "harga_tiket" => $harga_tiket,
            "Tanggal_Pembayaran" => date('Y-m-d H:i:s')
        ]);

        return response()->json([
            'message' => 'Store Data Tiket Success!',
            'data' => $table
        ],200);                                                                              
    }

    public function show($id)
    {
        $table = Payment::find($id);
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
        $table = Payment::find($id);
        if($table){
            $table->ID_tiket = $request->ID_tiket ? $request->ID_tiket : $table->ID_tiket;
            $table->Customer_ID = $request->Customer_ID ? $request->Customer_ID : $table->Customer_ID;
            $table->harga_tiket = $request->harga_tiket ? $request->harga_tiket : $table->harga_tiket;
            $table->Tanggal_Pembayaran = $request->Tanggal_Pembayaran ? $request->Tanggal_Pembayaran : $table->Tanggal_Pembayaran;
            $table->save();

            return $table;
        }else{
            return ["message"=>"Data Tiket Not Found!"];
        }
    }

    public function destroy($id)
    {
        $table = Payment::find($id);
        if($table){
            $table->delete();

            return ["message" => "Delete Tiket Success!"];
        }else{
            return ["message" => "Data Tiket Not Found!"];
        }
    }
}
