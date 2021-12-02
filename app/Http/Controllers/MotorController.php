<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\User;
use Illuminate\Http\Request;
use JWTAuth;
use DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class MotorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $motor = DB::collection('tbl_motor')->get();

        if (!$motor) {
            return response()->json([
                'success' => false,
                'message' => 'Maaf, data Motor tidak ditemukan.'
            ], 400);
        }
    
        return $motor;
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
        $data = $request->only('mesin', 'tipe_suspensi', 'tipe_transmisi');
        $validator = Validator::make($data, [
            'mesin' => 'required|string',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required',
        ]);

        // failed responses
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        // request valid, create new Motor
        $motor = Motor::create([
            'mesin' => $request->mesin,
            'tipe_suspensi' => $request->tipe_suspensi,
            'tipe_transmisi' => $request->tipe_transmisi,
        ]);

        // motor created, return success response
        return response()->json([
            'success' => true,
            'message' => 'Motor Created Successfully',
            'data' => $motor,
        ], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motor = Motor::find($id);

        if (!$motor) {
            return response()->json([
                'success' => 'false',
                'message' => 'Sorry, motor not found'
            ], 400);
        }

        return $motor;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function edit(Motor $motor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Motor $motor)
    {
        $data = $request->only('mesin', 'tipe_suspensi', 'tipe_transmisi');
        $validator = Validator::make($data, [
            'mesin' => 'required|string',
            'tipe_suspensi' => 'required',
            'tipe_transmisi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $motor = $motor->update([
            'mesin' => $request->mesin,
            'tipe_suspensi' => $request->tipe_suspensi,
            'tipe_transmisi' => $request->tipe_transmisi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Motor updated successfully',
            'data' => $motor
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Motor  $motor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Motor $motor)
    {
        $motor->delete();

        return response()->json([
            'success' => 'true',
            'message' => 'Motor Deleted Successfully',
        ], Response::HTTP_OK);
    }
}
