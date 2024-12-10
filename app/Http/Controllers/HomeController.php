<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\RegisterToGram;
use App\Models\Gram;
use App\Models\GharpattiPanipatti;
use App\Models\GramBill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if (view()->exists($request->path())) {
            return view($request->path());
        }
        return abort(404);
    }

    public function root()
    {
        
        $getRegisterGram = RegisterToGram::count();
           $categories = Category::all();
           $grams = Gram::all(['id', 'gram_name']);
        
        return view('index',compact('getRegisterGram','categories','grams'));
    }

    /*Language Translation*/
    public function lang($locale)
    {
        if ($locale) {
            App::setLocale($locale);
            Session::put('lang', $locale);
            Session::save();
            return redirect()->back()->with('locale', $locale);
        } else {
            return redirect()->back();
        }
    }

    public function updateProfile(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ]);

        $user = User::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');

        if ($request->file('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
            $user->avatar =  $avatarName;
        }

        $user->update();
        if ($user) {
            Session::flash('message', 'User Details Updated successfully!');
            Session::flash('alert-class', 'alert-success');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "User Details Updated successfully!"
            // ], 200); // Status code here
            return redirect()->back();
        } else {
            Session::flash('message', 'Something went wrong!');
            Session::flash('alert-class', 'alert-danger');
            // return response()->json([
            //     'isSuccess' => true,
            //     'Message' => "Something went wrong!"
            // ], 200); // Status code here
            return redirect()->back();

        }
    }

    public function updatePassword(Request $request, $id)
    {
        
       try {
    $validate = $request->validate([
        'current_password' => 'required|string',
        'password' => 'required|string|min:8|confirmed',
    ]);
} catch (ValidationException $e) {
    dd($e->errors());
} catch (\Exception $e) {
    dd($e->getMessage()); 
}


    $user = Auth::user();

    if (!Hash::check($request->current_password, $user->password)) {
        return back()->withErrors(['current_password' => 'Current password is incorrect.']);
    }
    else{

    $user->password = Hash::make($request->password);
    }
    
    $user->save();
    return back()->with('success', 'Password changed successfully!');
}

public function getCategoryCount(Request $request)
{
    $categoryId = $request->input('category_id');
    $count = \DB::table('register_to_grams')
                ->where('category', $categoryId)
                ->count();

    return response()->json(['count' => $count]);
}
// In GramBillController.php
public function getGramDetails(Request $request)
{
    $gramName = $request->input('gram_name');

    // Assuming your GramBill model is related to the gram name
    $pendingCount = GramBill::where('gram', $gramName)->where('bill_status', 'pending')->count();
    $completedCount = GramBill::where('gram', $gramName)->where('bill_status', 'completed')->count();
    $totalAmount = GramBill::where('gram', $gramName)->sum('first_time_bill_amount'); // Assuming 'amount' is the column for total bill amount

    return response()->json([
        'pendingCount' => $pendingCount,
        'completedCount' => $completedCount,
        'totalAmount' => $totalAmount,
    ]);
}

// app/Http/Controllers/GharPattiPanipattiController.php

public function getCounts()
{
    $currentYear = now()->year;

    // Count users who are not registered as 'gharpatti' in GharPattiPanipatti table
    $gharPattiNotRegisteredCount = User::where('is_admin', 'user')->whereNotIn('id', function($query) {
        $query->select('username')
              ->from('gharpatti_panipattis')
              ->where('type', 'gharpatti');
    })
    ->count();

    // Count users who are not registered as 'panipatti' in GharPattiPanipatti table
    $panipattiNotRegisteredCount = User::where('is_admin', 'user')->whereNotIn('id', function($query) {
        $query->select('username')
              ->from('gharpatti_panipattis')
              ->where('type', 'panipatti');
    })
    ->count();

    return response()->json([
        'gharPattiNotRegisteredCount' => $gharPattiNotRegisteredCount,
        'panipattiNotRegisteredCount' => $panipattiNotRegisteredCount
    ]);
}

// Controller Method to get users for Gharpatti
public function getGharPattiUsers()
{
    $users = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'gharpatti');
        })
        ->get();

    return response()->json($users);
}

// Controller Method to get users for Panipatti
public function getPanipattiUsers()
{
    $users = User::where('is_admin', 'user')
        ->whereNotIn('id', function($query) {
            $query->select('username')
                  ->from('gharpatti_panipattis')
                  ->where('type', 'panipatti');
        })
        ->get();

    return response()->json($users);
}

public function getGramBillsCount(Request $request)
{
    $query = GramBill::query(); // Initialize the query

    // Filter by gram name if provided
    if ($request->has('billType') && $request->billType) {
        $query->where('gram', $request->billType);
    }

    // Filter by 'fromDate' if provided
    if ($request->has('fromDate') && $request->fromDate) {
        $query->whereDate('created_at', '>=', $request->fromDate);
    }

    // Filter by 'toDate' if provided
    if ($request->has('toDate') && $request->toDate) {
        $query->whereDate('created_at', '<=', $request->toDate);
    }

    // Get the total count of matching records
    $totalGramBillCount = $query->count();

    // Return the response with the count
    return response()->json([
        'totalGramBillCount' => $totalGramBillCount
    ]);
}

}

