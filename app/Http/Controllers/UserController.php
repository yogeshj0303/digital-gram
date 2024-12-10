<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     
     
     
     

public function profileuser(){
      $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
    return view('profile' , compact('statesData'));
}

     
     
     
     
     
     
     
     
    public function index()
    {
            $users = User::where('is_admin','user')->paginate(10);
            return view('users.index', compact('users'));
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('users.create',compact('statesData'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'state' => 'required',
            'district' => 'required',
            'taluka' => 'required',
            'gram' => 'required',
            'name' => 'required|string|max:255',
            'contact_no' => 'required|numeric',
            'gate_no' => 'nullable|string|max:255',
            'profile_pic' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gender' => 'required',
            'dob' => 'required|date',
            'age' => 'required|numeric',
            'land_area' => 'nullable|string|max:255',
            'farm_area' => 'nullable|string|max:255',
            'gharpatti_annual' => 'nullable|numeric',
            'home_type' => 'nullable|string|max:255',
            'panipatti_annual' => 'nullable|numeric',
            'user_type' => 'required|string',
        ]);

        // Store profile picture if uploaded
        $profilePicPath = null;
        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        }

        // Save data to the database
        User::create([
            'state' => $request->state,
            'district' => $request->district,
            'taluka' => $request->taluka,
            'gram' => $request->gram,
            'name' => $request->name,
            'contact_no' => $request->contact_no,
            'gate_no' => $request->gate_no,
            'profile_pic' => $profilePicPath,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'age' => $request->age,
            'land_area' => $request->land_area,
            'farm_area' => $request->farm_area,
            'gharpatti_annual' => $request->gharpatti_annual,
            'home_type' => $request->home_type,
            'panipatti_annual' => $request->panipatti_annual,
            'user_type' => $request->user_type,
        ]);

        // Redirect back with success message
        return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        
        $user = User::find($id);
                $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);

        
        return view('users.edit', compact('user' , 'statesData'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'state' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'taluka' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'contact_no' => 'required|string|max:20',
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'age' => 'nullable|integer',
            'land_area' => 'nullable|string|max:255',
            'farm_area' => 'nullable|string|max:255',
                        'home_type' => 'nullable|string|max:255',

            'gharpatti_annual' => 'nullable|numeric',
            'panipatti_annual' => 'nullable|numeric',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'user_type' => 'nullable|in:Gram_Sevak,Clark,Sarpanch,Sadsy,Public',
        ]);
    
        $user = User::findOrFail($id);
    
        // Update fields
        $user->state = $request->state;
        $user->district = $request->district;
        $user->taluka = $request->taluka;
        $user->name = $request->name;
        $user->contact_no = $request->contact_no;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->age = $request->age;
        $user->land_area = $request->land_area;
                $user->home_type = $request->home_type;

        $user->farm_area = $request->farm_area;
        $user->gharpatti_annual = $request->gharpatti_annual;
        $user->panipatti_annual = $request->panipatti_annual;
        $user->user_type = $request->user_type;
    
        // Handle profile picture upload
        if ($request->hasFile('profile_pic')) {
            // Delete old profile picture if exists
            if ($user->profile_pic && \Storage::exists($user->profile_pic)) {
                \Storage::delete($user->profile_pic);
            }
            // Store new profile picture
            $user->profile_pic = $request->file('profile_pic')->store('profile_pics', 'public');
        }
    
        $user->save();
    
        return redirect()->route('users.index')->with('success', 'User updated successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
    
        if ($user) {
            $user->delete();
            return response()->json(['message' => 'User deleted successfully']);
        }
    
        return response()->json(['message' => 'User not found'], 404);
    }

    public function getOTP(){
        return view('auth.otp-page');
    }

    
    public function userLogin(){
        return view('auth.users-login');
    }
    

public function loginWithOTP(Request $request)
{
    // Validate the mobile number input
    $request->validate([
        'mobile_number' => 'required|digits:10', // Assuming a 10-digit mobile number
    ]);

    $mobileNumber = $request->input('mobile_number');

    // Check if the mobile number exists in the `users` table
    $user = User::where('contact_no', $mobileNumber)->first();

    if ($user) {
        // Generate a 4-digit random OTP
        $otp = random_int(1000, 9999);

        // Update the OTP and expiry in the users table
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(1); // Set OTP expiration time
        $user->save();
        
          // Send OTP via WhatsApp (Your existing method for sending OTP)
    $this->sendOtpMessage($mobileNumber, $otp);


        // Optionally, send the OTP to the user via SMS (use an SMS service provider)
        // Example: SMS::send($mobileNumber, "Your OTP is: $otp");

        return redirect()->route('otp.page.view')->with('success', 'OTP sent to your mobile number.');
    } else {
        return redirect()->back()->withErrors(['mobile_number' => 'Mobile number not found.']);
    }
}

   private function sendOtpMessage($mobile, $otp)
    {
        $message = "Your OTP for login is *$otp*. Please do not share it with anyone.\n\nThank you!";
        
        // WhatsApp API integration (use your API key)
        $apikey = '9b27317c95af48b281c9bea373bbb889';
        $response = Http::get('http://web.cloudwhatsapp.com/wapp/api/send', [
            'apikey' => $apikey,
            'mobile' => '91' . $mobile,
            'msg' => $message,
        ]);

        $jsonData = $response->json();
        if ($jsonData['status'] != 'success') {
            // Log or handle API error
        }
    }


public function verifyOtp(Request $request)
{
    // Validate OTP digits
    $request->validate([
        'digit1' => 'required|digits:1',
        'digit2' => 'required|digits:1',
        'digit3' => 'required|digits:1',
        'digit4' => 'required|digits:1',
    ]);

    // Combine the OTP digits into a single string
    $otp = $request->digit1 . $request->digit2 . $request->digit3 . $request->digit4;

    // Find the user with the OTP
    $user = User::where('otp', $otp)
                ->where('otp_expires_at', '>', now()) // Ensure OTP is still valid
                ->first();

    if ($user) {
        // OTP is valid, proceed with login or other actions
        $user->otp = null;  // Clear OTP
        $user->otp_expires_at = null;  // Clear OTP expiration time
        $user->save();

        Auth::login($user);  // Log in the user

        return redirect()->route('root')->with('success', 'OTP verified successfully!');
    }

    // OTP is invalid or expired
    return redirect()->back()->withErrors(['otp' => 'Invalid or expired OTP. Please try again.']);
}





 public function updatePassword(Request $request)
{
 
    $validate = $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);




    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        dd("not match");
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }
    else{

    $user->password = Hash::make($request->password);
            dd(" match");
    }

    $user->save();

    return back()->with('success', 'Password changed successfully!');
}



public function editprofile(Request $request , $id)
{
    
        $user = User::find($id);
                return response()->json([
            'user' => $user,
        ]);


}


public function profileupdate(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'state' => 'required|string|max:255',
        'district' => 'required|string|max:255',
        'taluka' => 'nullable|string|max:255',
        'name' => 'required|string|max:255',
        'contact_no' => 'required|string|max:20',
        'gender' => 'nullable|in:Male,Female',
        'dob' => 'nullable|date',
        'age' => 'nullable|integer',
        'land_area' => 'nullable|string|max:255',
    ]);

    // Find the user by ID or fail if not found
    $user = User::findOrFail($id);

    // Update user attributes with request data
    $user->state = $request->input('state');
    $user->district = $request->input('district');
    $user->taluka = $request->input('taluka');
    $user->name = $request->input('name');
    $user->contact_no = $request->input('contact_no');
    $user->gender = $request->input('gender');
    $user->dob = $request->input('dob');
    $user->age = $request->input('age');
    $user->land_area = $request->input('land_area');

    // Save the updated user data to the database
    $user->save();

    // Return a JSON response with updated data
    return response()->json([
        'id' => $user->id,
        'state' => $user->state,
        'district' => $user->district,
        'taluka' => $user->taluka,
        'name' => $user->name,
        'contact_no' => $user->contact_no,
        'gender' => $user->gender,
        'dob' => $user->dob,
        'age' => $user->age,
        'land_area' => $user->land_area,
    ]);
}





}
