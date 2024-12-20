<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Iban;
use Illuminate\Http\Request;

class IbanController extends Controller
{
    /**
    * Display a listing of the resource.
    */
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->isAdmin()) {
            $ibans = Iban::with('user')->paginate(10);
        } else {
            $ibans = Iban::with('user')->where('user_id', $user->id)->paginate(10);
        }
        
        return response()->json($ibans);
    }
    
    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $request->validate([
            'iban' => 'required|string',
        ]);
        
        $iban = strtoupper(str_replace(' ', '', $request->iban));
        
        $ibanRecord = Iban::create([
            'iban_number' => $iban,
            'user_id' => auth()->id(),
        ]);
        
        return response()->json([
            'message' => 'IBAN is valid and saved.',
            'iban' => $ibanRecord,
        ], 201);
    }

    /**
    * Display the specified resource.
    */
    public function show(Iban $iban)
    {
        return response()->json($iban);
    }

    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, Iban $iban)
    {
        $request->validate([
            'iban' => 'required|string',
        ]);
        
        $iban->iban_number = strtoupper(str_replace(' ', '', $request->iban));
        $iban->save();
        
        return response()->json([
            'message' => 'IBAN updated successfully.',
            'iban' => $iban,
        ]);
    }

    /**
    * Remove the specified resource from storage.
    */
    public function destroy(Iban $iban)
    {
        $iban->delete();
        
        return response()->json([
            'message' => 'IBAN deleted successfully.',
        ], 200);
    }
}
