<?php

namespace App\Http\Controllers;
use App\Models\GramBill;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class GramBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $gramBills = GramBill::paginate(10);
        return view('gram-bills.index',compact('gramBills'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('gram-bills.create',compact('statesData'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'taluka' => 'required|string|max:255',
            'gram' => 'required|string|max:255',
            'population' => 'required|integer|min:0',
            'first_time_bill_amount' => 'required|numeric|min:0',
            'quatation_date' => 'required|date',
            'bill_date' => 'required|date',
            'reference_number' => 'required|string|max:255',
            'maintenance_amount' => 'required|numeric|min:0',
            'description' => 'required|string|max:5000',
            'payment_mode' => 'required|string|in:Cash,Online,RTGS',
            'next_maintenance_date' => 'required|date',
            'bill_status' => 'required|string|in:pending,complete',
        ]);

        GramBill::create($validated);

        return redirect()->route('gram-bills.index')->with('success', 'Gram Bill saved successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $gramBill = GramBill::findOrFail($id);
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('gram-bills.edit',compact('statesData','gramBill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
    $validated = $request->validate([
        'state' => 'required',
        'district' => 'required',
        'taluka' => 'required',
        'gram' => 'required',
        'population' => 'required|numeric',
        'first_time_bill_amount' => 'required|numeric',
        'quatation_date' => 'required|date',
        'bill_date' => 'required|date',
        'reference_number' => 'required|numeric',
        'maintenance_amount' => 'required|numeric',
        'description' => 'required|string|max:5000',
        'payment_mode' => 'required',
        'next_maintenance_date' => 'required|date',
        'bill_status' => 'required',
    ]);
} catch (ValidationException $e) {
    // Dump the validation errors and stop execution
    dd($e->errors());
}

        $gramBill = GramBill::findOrFail($id);
        $gramBill->update($request->all());
    
        return redirect()->route('gram-bills.index')->with('success', 'Gram Bill updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
         // Find the Gram record by ID
         $gram = GramBill::find($id);
        
         if ($gram) {
        
     
             // Delete the Gram record
             $gram->delete();
     
             return response()->json(['message' => 'Gram Bill deleted successfully']);
         }
     
         return response()->json(['message' => 'Gram Bill not found'], 404);
    }
}
