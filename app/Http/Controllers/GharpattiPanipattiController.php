<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\GharpattiPanipatti;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;

use Illuminate\Http\Request;

class GharpattiPanipattiController extends Controller
{
    public function index()
    {
$records = GharpattiPanipatti::select('gharpatti_panipattis.*', 'users.name as user_name')
    ->leftJoin('users', 'users.id', '=', 'gharpatti_panipattis.username')
    ->orderBy('gharpatti_panipattis.id', 'desc')
    ->paginate(10);

        return view('gharpatti-panipatti.gharpatti_panipatti', compact('records'));
    }

    public function create()
    {
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        return view('gharpatti-panipatti.create',compact('statesData'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state' => 'required|string',
            'district' => 'required|string',
            'taluka' => 'required|string',
            'gram' => 'required|string',
            'username' => 'required|string',
            'type' => 'required|string|in:gharpatti,panipatti',
            'amount_type' => 'required|string',
            'paid_type' => 'required|string|in:cash,online,rtgs,check',
            'paid_amount' => 'required|numeric|min:0',
            'paid_date' => 'required|date',
            'remaining_amount' => 'nullable|numeric|min:0',
            'send_bill' => 'nullable|boolean',
        ]);

      $record =   GharpattiPanipatti::create($request->all());
        
          // If send_bill is true, generate and send the PDF bill
    if ($request->send_bill) {
        $pdfPath = $this->generatePdfBill($record);

        // Assuming the user's mobile number is part of the `username` or another field
        $mobile = $this->getMobileNumber($record->username); // Replace with actual logic
        
     
        $this->sendBillMessage($mobile, $pdfPath);
    }

        return redirect()->route('gharpatti-panipatti.index')->with('success', 'Record added successfully!');
    }

    public function show($id)
    {
        $record = GharpattiPanipatti::findOrFail($id);
        return view('gharpatti_panipatti.show', compact('record'));
    }

    public function edit($id)
    {
        $filePath = storage_path('data/states_districts.json');
   
        $statesData = json_decode(file_get_contents($filePath), true);
        $record = GharpattiPanipatti::findOrFail($id);
        return view('gharpatti-panipatti.edit', compact('record','statesData'));
    }

    public function update(Request $request, $id)
    {
    
       try {
    $request->validate([
        'state' => 'required|string',
        'district' => 'required|string',
        'taluka' => 'required|string',
        'gram' => 'required|string',
        'type' => 'required|string|in:gharpatti,panipatti',
        'amount_type' => 'required|string',
        'paid_type' => 'required|string|in:cash,online,rtgs,check',
        'paid_amount' => 'required|numeric|min:0',
        'paid_date' => 'required|date',
        'remaining_amount' => 'nullable|numeric|min:0',
        'send_bill' => 'nullable|boolean',
    ]);
} catch (ValidationException $e) {
    dd($e->errors());
}
        $record = GharpattiPanipatti::findOrFail($id);
        $record->update($request->all());

        return redirect()->route('gharpatti-panipatti.index')->with('success', 'Record updated successfully!');
    }

    public function destroy($id)
    {
        
        $record = GharpattiPanipatti::findOrFail($id);
        
        $record->delete();

        return redirect()->route('gharpatti-panipatti.index')->with('success', 'Record deleted successfully!');
    }
    
    
    private function generatePdfBill($record)
{
    $pdfContent = \PDF::loadView('pdf.bill', ['record' => $record])->output();

    $filePath = storage_path('app/public/bills/') . 'bill_' . $record->id . '.pdf';
    file_put_contents($filePath, $pdfContent);

    return $filePath;
}

/**
 * Send the PDF bill via WhatsApp.
 */
private function sendBillMessage($mobile, $pdfPath)
{
       // Read the PDF file contents
    $pdfContent = file_get_contents($pdfPath);
    $pdfName = basename($pdfPath);
    
$message = "Your bill is ready. Please find the attached PDF: https://e-gram.actthost.com/storage/bills/" . $pdfName;



    $apikey = '9b27317c95af48b281c9bea373bbb889';
        $response = Http::get('http://web.cloudwhatsapp.com/wapp/api/send', [
            'apikey' => $apikey,
            'mobile' => '91' . $mobile,
            'msg' => $message,
        ]);

        $jsonData = $response->json();

    if ($jsonData['status'] != 'success') {
        // Log or handle API error
        \Log::error('Failed to send bill via WhatsApp: ' . $jsonData['message']);
    }
}
/**
 * Retrieve the mobile number from the username or other fields.
 */
private function getMobileNumber($username)
{
  
    // Replace with logic to fetch mobile number, e.g., querying the database
    $getUser = User::where('id',$username)->select('contact_no')->first();
    $mobileNo = $getUser->contact_no;
    return $mobileNo;
}

}
