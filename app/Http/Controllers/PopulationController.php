<?php

namespace App\Http\Controllers;
use App\Models\Population;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class PopulationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::where('is_admin','user')->get(); 
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        $populations = Population::paginate(10);
        return view('population.index', compact('populations','statesData','users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'population' => 'required|integer|min:0',
            'year' => 'required|integer|digits:4',
            'confirm_by' => 'required|string', // Make confirmed_by required
        ]);
    
        Population::create($validated);
    
        return redirect()->route('population.index')->with('success', 'Population data saved successfully.');
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
                $Population = Population::findOrFail($id);

        return response()->json([
            'Population' => $Population,
        ]);

    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, $id)
{
    $validated = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'population' => 'required|integer|min:0',
        'year' => 'required|integer|digits:4',
        'confirm_by' => 'required|string',
    ]);

    $population = Population::findOrFail($id); // Find the specific record
    $population->update($validated); // Update the record

    return response()->json([
        'id' => $population->id,
        'state' => $population->state,
        'district' => $population->district,
        'taluka' => $population->taluka,
        'gram' => $population->gram,
        'population' => $population->population,
        'year' => $population->year,
        'confirm_by' => $population->confirm_by,
    ]);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Gram record by ID
        $gram = Population::find($id);
  
        if ($gram) {
            $gram->delete();
            return response()->json(['message' => 'Population deleted successfully']);
        }
    
        return response()->json(['message' => 'Gram not found'], 404);
    }
}
