<?php

namespace App\Http\Controllers;
use App\Models\RegisterToGram;
use App\Models\Category;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;

class RegisterToGramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $registerToGrams = RegisterToGram::paginate(10);
        $getCategory = Category::all();
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('register-to-gram.index',compact('statesData','registerToGrams','getCategory'));
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
        dd($request);

        $validated = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'category' => 'required|string',
            'pdf.*' => 'nullable|mimes:pdf', // Validate PDF files
        ]);
    
        // Create a new RegisterToGram record
        $registerToGram = RegisterToGram::create([
            'state' => $request->state,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'gram' => $request->gram,
            'category' => $request->category,
        ]);
    
        $folderPath = 'uploads/' . $request->state . '/' . $request->district . '/' . $request->taluka .'/' . $request->gram;
    
        // Check if the folder exists, create it if it doesn't
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }
    
        // Debug: Check if files are being sent
        
    
        if ($request->hasFile('pdf')) {
            foreach ($request->file('pdf') as $file) {
                // Store the file in the existing or newly created folder
                $filePath = $file->store($folderPath, 'public');
                    
                // Store the file path in the database associated with the RegisterToGram record
                $registerToGram->files()->create(['path' => $filePath]);
            }
        }
    
        return redirect()->route('register-to-gram.index')->with('success', 'Registration saved successfully!');
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
        $registerToGrams = RegisterToGram::findOrFail($id);
        $getCategory = Category::all();
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return response()->json([
            'gram' => $registerToGrams,
            'statesData' => $statesData,
            'categories' => $getCategory,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, string $id)
{
    // Validate the request data
    $validated = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'category' => 'required|string',
        'pdf.*' => 'nullable|mimes:pdf', // Validate PDF files
    ]);
    
    $registerToGram = RegisterToGram::findOrFail($id);
    
    // Update the record
    $registerToGram->update([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'category' => $request->category,
    ]);
    
    // Define the folder path
    $folderPath = 'uploads/' . $request->state . '/' . $request->district . '/' . $request->taluka .'/' . $request->gram;
    
    // Check if the folder exists, create it if it doesn't
    if (!Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->makeDirectory($folderPath);
    }
    
    // Handle file uploads
    if ($request->hasFile('pdf')) {
        foreach ($request->file('pdf') as $file) {
            // Store the file in the existing or newly created folder
            $filePath = $file->store($folderPath, 'public');
            
            // Store the file path in the database associated with the RegisterToGram record
            $registerToGram->files()->create(['path' => $filePath]);
        }
    }

    // You can return a response or redirect after the update
        return response()->json(['success' => 'update successfully']);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Gram record by ID
        $gram = RegisterToGram::find($id);
        
        if ($gram) {
            // Loop through the associated files and delete them from storage
            foreach ($gram->files as $file) {
                // Delete the file from the storage disk
                Storage::disk('public')->delete($file->path);
                
                // Optionally, delete the file record from the database
                $file->delete();
            }
    
            // Delete the Gram record
            $gram->delete();
    
            return response()->json(['message' => 'Gram and associated files deleted successfully']);
        }
    
        return response()->json(['message' => 'Gram not found'], 404);
    }
    
}
