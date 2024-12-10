<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Gram;
use App\Models\Taluka;
use App\Models\User;
use Illuminate\Http\Request;

class MasterController extends Controller
{

    public function getTehsils(Request $request)
    {
        $state = $request->input('state');
        $district = $request->input('district');
    
        // Validate input
        if (!$state || !$district) {
            return response()->json([], 400); // Return empty array if validation fails
        }
    
        $tehsils = Taluka::where('state', $state)
                         ->where('district', $district)
                         ->pluck('taluka_name');
    
        return response()->json($tehsils);
    }
    public function getGrams(Request $request)
    {
        $state = $request->input('state');
        $district = $request->input('district');
        $taluka = $request->input('taluka');
        // Validate input
        if (!$state || !$district || !$taluka) {
            return response()->json([], 400); // Return empty array if validation fails
        }
    
        $grams = Gram::where('state', $state)
                         ->where('district', $district)
                         ->where('taluka', $taluka)
                         ->pluck('gram_name');
    
        return response()->json($grams);
    }

    public function getByGram(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
        ]);

        // Fetch users based on the provided gram
        $users = User::where('state', $request->state)
            ->where('district', $request->district)
            ->where('taluka', $request->taluka)
            ->where('gram', $request->gram)
            ->get(['id', 'name','gharpatti_annual','panipatti_annual']); // Only get ID and username

        // Return the users as a JSON response
        return response()->json($users);
    }

    //
    public function index(){
    $categories = Category::paginate(10);
    return view('master.category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        Category::create([
            'category_name' => $request->category_name,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category added successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json($category); // Return the category data as JSON
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);
    
        $category = Category::findOrFail($id);
        $category->update([
            'category_name' => $request->category_name,
        ]);
    
        return response()->json([
            'message' => 'Category updated successfully.',
            'category' => $category,
        ]);
    }
    

    public function destroy($id)
    {
        $category = Category::find($id);
    
        if ($category) {
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        }
    
        return response()->json(['message' => 'Category not found'], 404);
    }
    
// Display the Gram page
public function gramIndex()
{
    $grams = Gram::paginate(10);
    $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
    return view('master.gram', compact('grams','statesData'));
}

// Store a new Gram
public function gramStore(Request $request)
{
    $request->validate([
        'gram_name' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'required|string|max:255',
        'village' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'pin_code' => 'nullable|numeric|digits:6',
    ]);

    Gram::create($request->all());

    return redirect()->route('grams.index')->with('success', 'Gram added successfully.');
}

// Fetch Gram for editing
public function gramEdit($id)
{
    $gram = Gram::findOrFail($id);
    return response()->json($gram);
}

// Update Gram details
public function gramUpdate(Request $request, $id)
{
    $request->validate([
        'gram_name' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'required|string|max:255',
        'village' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'pin_code' => 'nullable|numeric|digits:6',
    ]);

    $gram = Gram::findOrFail($id);
    
    $gram->update($request->all());

    return response()->json([
        'message' => 'Gram updated successfully.',
        'gram' => $gram,
    ]);
}

// Delete a Gram
public function gramDestroy($id)
{
    $gram = Gram::find($id);

    if ($gram) {
        $gram->delete();
        return response()->json(['message' => 'Gram deleted successfully']);
    }

    return response()->json(['message' => 'Gram not found'], 404);
}

    // taluka methods
    public function talukaIndex(){
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);

        $talukas = Taluka::paginate(10);
        return view('master.taluka', compact('talukas','statesData'));
        }
    
        public function talukaStore(Request $request)
        {
            $request->validate([
                'taluka_name' => 'required|string|max:255',
                'state' => 'required|string|max:255',
                'district' => 'required|string|max:255',
            ]);
        
            Taluka::create([
                'taluka_name' => $request->taluka_name,
                'state' => $request->state,
                'district' => $request->district,
            ]);
        
            return redirect()->route('talukas.index')->with('success', 'Taluka added successfully.');
        }
        
   public function talukaEdit($id)
{
    // Find the Taluka
    $taluka = Taluka::findOrFail($id);
  
    return response()->json([
        'id' => $taluka->id,
        'taluka_name' => $taluka->taluka_name,
        'state' => $taluka->state,
        'district' => $taluka->district,
    ]);
}

public function talukaUpdate(Request $request, $id)
{
    $request->validate([
        'taluka_name' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
    ]);

    $taluka = Taluka::findOrFail($id);
    $taluka->update([
        'taluka_name' => $request->taluka_name,
        'state' => $request->state,
        'district' => $request->district,
    ]);

    return response()->json([
        'id' => $taluka->id,
        'taluka_name' => $taluka->taluka_name,
        'state' => $taluka->state,
        'district' => $taluka->district,
    ]);
}
 
        public function talukaDestroy($id)
        {
            $taluka = Taluka::find($id);
        
            if ($taluka) {
                $taluka->delete();
                return response()->json(['message' => 'Taluka deleted successfully']);
            }
        
            return response()->json(['message' => 'Taluka not found'], 404);
        }
        
      

}
