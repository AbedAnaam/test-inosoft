<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Motor;
use App\Models\Mobil;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use JWTAuth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kendaraan = DB::collection('tbl_kendaraan')->get();

        if (!$kendaraan) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, data Kendaraan tidak ditemukan.'
            ], 400);
        }
    
        return $kendaraan;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate data
        $data = $request->only('tahun_keluaran', 'warna', 'harga');
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required|string',
            'warna' => 'required',
            'harga' => 'required',
        ]);

        // failed responses
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        // request valid, create new Kendaraan
        $kendaraan = Kendaraan::create([
            'tahun_keluaran' => $request->tahun_keluaran,
            'warna' => $request->warna,
            'harga' => $request->harga,
        ]);

        // kendaraan created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Kendaraan Created Successfully',
            'data' => $kendaraan,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kendaraan = Kendaraan::find($id);

        if (!$kendaraan) {
            return response()->json([
                'success' => 'false',
                'message' => 'Maaf, Kendaraan tidak ditemukan'
            ], 400);
        }

        return $kendaraan;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function edit(Kendaraan $kendaraan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kendaraan $kendaraan)
    {
        $data = $request->only('tahun_keluaran', 'warna', 'harga');
        $validator = Validator::make($data, [
            'tahun_keluaran' => 'required|string',
            'warna' => 'required',
            'harga' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $kendaraan = $kendaraan->update([
            'tahun_keluaran' => $request->tahun_keluaran,
            'warna' => $request->warna,
            'harga' => $request->harga,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Kendaraan updated successfully',
            'data' => $kendaraan
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kendaraan  $kendaraan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        return response()->json([
            'success' => 'true',
            'message' => 'Kendaraan Deleted Successfully',
        ], Response::HTTP_OK);
    }
}
