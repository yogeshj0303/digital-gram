<?php

namespace App\Http\Controllers;
use App\Models\AboutGram;
use App\Models\Category;
use Illuminate\Support\Facades\Storage; 
use Illuminate\Http\Request;

class AboutGramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $aboutGrams = AboutGram::paginate(10);
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('about-gram/about_gram',compact('statesData','aboutGrams'));
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
        // Validate the form data
        $validated = $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'about_gram' => 'required',
            'pdf' => 'nullable|mimes:pdf', // Validate PDF files
        ]);
    
        // Create folder path based on state, district, taluka, and gram
        $folderPath = 'about-gram/' . $request->state . '/' . $request->district . '/' . $request->taluka . '/' . $request->gram;
    
        // Check if the folder exists, create it if it doesn't
        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }
    
        // Initialize filePath to null (in case no file is uploaded)
        $filePath = null;
    
        // Check if a PDF file is uploaded
        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            // Store the file in the folder and get the file path
            $filePath = $file->store($folderPath, 'public');
        }
    
        // Create a new RegisterToGram record
        $registerToGram = AboutGram::create([
            'state' => $request->state,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'gram' => $request->gram,
            'about_gram' => $request->about_gram,
            'path' => $filePath, // Store the file path if a file is uploaded
        ]);
    
        // Redirect back with success message
        return redirect()->route('about-gram.index')->with('success', 'About gram saved successfully!');
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
        $registerToGrams = AboutGram::findOrFail($id);
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
    // Validate the incoming request data
    $validated = $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'about_gram' => 'required',
        'pdf.*' => 'nullable|mimes:pdf', // Validate PDF files
    ]);

    // Find the existing record to update
    $registerToGram = AboutGram::findOrFail($id);

    // Create folder path based on state, district, taluka, and gram
    $folderPath = 'about-gram/' . $request->state . '/' . $request->district . '/' . $request->taluka . '/' . $request->gram;

    // Check if the folder exists, create it if it doesn't
    if (!Storage::disk('public')->exists($folderPath)) {
        Storage::disk('public')->makeDirectory($folderPath);
    }

    // Initialize filePath to null (in case no file is uploaded)
    $filePath = $registerToGram->path; // Keep the old file path if no new file is uploaded

    // Check if a new PDF file is uploaded
    if ($request->hasFile('pdf')) {
        $file = $request->file('pdf');
        
        // If it's an array of files (multiple uploads)
        if (is_array($file)) {
            foreach ($file as $f) {
                // Store each file and return the file path (this will need handling for multiple files if required)
                $filePath = $f->store($folderPath, 'public');
            }
        } else {
            // Handle the single file upload
            // Delete the old file if exists
            if ($filePath && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
            // Store the new file and update the file path
            $filePath = $file->store($folderPath, 'public');
        }
    }

    // Update the existing record with new data
    $registerToGram->update([
        'state' => $request->state,
        'district' => $request->district,
        'taluka' => $request->taluka,
        'gram' => $request->gram,
        'about_gram' => $request->about_gram,
        'path' => $filePath,
    ]);

    return response()->json(['success' => 'Updated successfully']);
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the Gram record by ID
        $gram = AboutGram::find($id);
        
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
