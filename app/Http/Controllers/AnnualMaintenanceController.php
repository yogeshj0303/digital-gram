<?php

namespace App\Http\Controllers;
use App\Models\AnnualMaintenance;
use Illuminate\Http\Request;

class AnnualMaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $annualMaintenance = AnnualMaintenance::paginate(10);
        return view('annual-maintenance.index',compact('annualMaintenance'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('annual-maintenance.create',compact('statesData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

          // Validation rules
          $validatedData = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'maintenance_year' => 'required|integer',
            'maintenance_amount' => 'required|numeric',
            'remaining_amount' => 'required|numeric',
            'payment_mode' => 'required|string',
            'description' => 'nullable|string|max:5000',
            'current_population' => 'nullable|integer',
            'bill_status' => 'required|string',
        ]);

        // Store the data in the database
        AnnualMaintenance::create($validatedData);

        // Redirect back with success message
        return redirect()->route('annual-maintenance.index')->with('success', 'Annual maintenance data stored successfully');
   
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
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
           // Retrieve the maintenance record by ID
           $user = AnnualMaintenance::findOrFail($id);

           // Pass the data to the edit view
           return view('annual-maintenance.edit', compact('user','statesData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // Validate the input data
       $request->validate([
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'required|string|max:255',
        'gram' => 'required|string|max:255',
        'maintenance_year' => 'required|integer',
        'maintenance_amount' => 'required|numeric',
        'remaining_amount' => 'required|numeric',
        'payment_mode' => 'required|string',
        'description' => 'nullable|string|max:5000',
        'current_population' => 'nullable|integer',
        'bill_status' => 'required|in:pending,complete',
    ]);

    // Find the existing maintenance record
    $maintenance = AnnualMaintenance::findOrFail($id);

    // Update the record with new data
    $maintenance->update([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'maintenance_year' => $request->maintenance_year,
        'maintenance_amount' => $request->maintenance_amount,
        'remaining_amount' => $request->remaining_amount,
        'payment_mode' => $request->payment_mode,
        'description' => $request->description,
        'current_population' => $request->current_population,
        'bill_status' => $request->bill_status,
    ]);

    // Redirect back to the index or a specific page with success message
    return redirect()->route('annual-maintenance.index')->with('success', 'Annual Maintenance updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       
        // Find the Gram record by ID
        $gram = AnnualMaintenance::find($id);
       
        if ($gram) {
       
    
            // Delete the Gram record
            $gram->delete();
    
            return response()->json(['message' => 'Annual Maintenance deleted successfully']);
        }
    
        return response()->json(['message' => 'Annual Maintenance not found'], 404);
   }
}
