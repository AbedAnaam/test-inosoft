<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class MobilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mobil = DB::collection('mobils')->get();

        if (!$mobil) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, data Mobil tidak ditemukan.'
            ], 400);
        }
    
        return $mobil;
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
        $data = $request->only('mesin', 'kapasitas_penumpang', 'tipe');
        $validator = Validator::make($data, [
            'mesin' => 'required|string',
            'kapasitas_penumpang' => 'required',
            'tipe' => 'required',
        ]);

        // failed responses
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        // request valid, create new mobil
        $mobil = Mobil::create([
            'mesin' => $request->mesin,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'tipe' => $request->tipe,
        ]);

        // mobil created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Mobil Created Successfully',
            'data' => $mobil,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mobil = Mobil::find($id);

        if (!$mobil) {
            return response()->json([
                'success' => 'false',
                'message' => 'Sorry, mobil not found'
            ], 400);
        }

        return $mobil;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function edit(Mobil $mobil)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mobil $mobil)
    {
        $data = $request->only('mesin', 'kapasitas_penumpang', 'tipe');
        $validator = Validator::make($data, [
            'mesin' => 'required|string',
            'kapasitas_penumpang' => 'required',
            'tipe' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $mobil = $mobil->update([
            'mesin' => $request->mesin,
            'kapasitas_penumpang' => $request->kapasitas_penumpang,
            'tipe' => $request->tipe,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Mobil updated successfully',
            'data' => $mobil
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mobil  $mobil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mobil $mobil)
    {
        $mobil->delete();

        return response()->json([
            'success' => 'true',
            'message' => 'Mobil Deleted Successfully',
        ], Response::HTTP_OK);
    }
}
