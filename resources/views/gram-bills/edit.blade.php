@extends('layouts.master')
@section('title')
    @lang('translation.list-js5')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Gram Bills</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('gram-bills.update', $gramBill->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Method spoofing for update -->
                        
                            <div class="row gy-4">
                                <!-- State Dropdown -->
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                     <select class="form-control select2 @error('state') is-invalid @enderror" id="state" name="state">
                                        <option value="">Select State</option>
                                        @foreach($statesData['states'] as $state)
                                            <option value="{{ $state['state'] }}" {{ $gramBill->state === $state['state'] ? 'selected' : '' }}>
                                                {{ $state['state'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                   @error('state')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <div class="col-md-4">
                                    <label for="district" class="form-label">District</label>
                                    <select id="district" name="district" class="form-control select2">
                                        <option value="{{ $gramBill->district }}">{{ $gramBill->district }}</option>
                                    </select>
                                                                        @error('district')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <div class="col-md-4">
                                    <label for="taluka" class="form-label">Taluka</label>
                                                                     <select id="taluka-field" name="taluka" class="form-control select2">
                                        <option value="{{ $gramBill->taluka }}">{{ $gramBill->taluka }}</option>
                                    </select>
   @error('taluka')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <div class="col-md-4">
                                    <label for="gram" class="form-label">Gram Name</label>
  <select name="gram" id="gram-field"
                                        class="form-control select2 @error('gram') is-invalid @enderror">
                                        <option value="">Select Gram</option>
                                       
                                    </select>
                                                                      @error('gram')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Population Field -->
                                <div class="col-md-4">
                                    <label for="population" class="form-label">Population</label>
                                    <input type="number" class="form-control @error('population') is-invalid @enderror"
                                        id="population" name="population" placeholder="Enter Population" value="{{ old('population', $gramBill->population) }}">
                                    @error('population')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- First Time Bill Amount -->
                                <div class="col-md-4">
                                    <label for="first_time_bill_amount" class="form-label">First Time Bill Amount</label>
                                    <input type="number" class="form-control @error('first_time_bill_amount') is-invalid @enderror"
                                        id="first_time_bill_amount" name="first_time_bill_amount" placeholder="Enter First Time Bill Amount" 
                                        value="{{ old('first_time_bill_amount', $gramBill->first_time_bill_amount) }}">
                                    @error('first_time_bill_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Quotation Date -->
                                <div class="col-md-4">
                                    <label for="quotation_date" class="form-label">Quotation Date</label>
                                    <input type="date" class="form-control @error('quotation_date') is-invalid @enderror"
                                        id="quotation_date" name="quatation_date" value="{{ old('quatation_date', $gramBill->quatation_date) }}">
                                    @error('quotation_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Bill Date -->
                                <div class="col-md-4">
                                    <label for="bill_date" class="form-label">Bill Date</label>
                                    <input type="date" class="form-control @error('bill_date') is-invalid @enderror"
                                        id="bill_date" name="bill_date" value="{{ old('bill_date', $gramBill->bill_date) }}">
                                    @error('bill_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Reference Number -->
                                <div class="col-md-4">
                                    <label for="reference_number" class="form-label">Reference Number</label>
                                    <input type="number" class="form-control @error('reference_number') is-invalid @enderror"
                                        id="reference_number" name="reference_number" placeholder="Enter Reference Number" 
                                        value="{{ old('reference_number', $gramBill->reference_number) }}">
                                    @error('reference_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Maintenance Amount -->
                                <div class="col-md-4">
                                    <label for="maintenance_amount" class="form-label">Maintenance Amount</label>
                                    <input type="number" class="form-control @error('maintenance_amount') is-invalid @enderror"
                                        id="maintenance_amount" name="maintenance_amount" placeholder="Enter Maintenance Amount" 
                                        value="{{ old('maintenance_amount', $gramBill->maintenance_amount) }}">
                                    @error('maintenance_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Description -->
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                        rows="5" maxlength="5000">{{ old('description', $gramBill->description) }}</textarea>
                                    <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Payment Mode -->
                                <div class="col-md-4">
                                    <label for="payment_mode" class="form-label">Payment Mode</label>
                                    <select class="form-control @error('payment_mode') is-invalid @enderror"
                                        id="payment_mode" name="payment_mode">
                                        <option value="">Select Payment Mode</option>
                                        <option value="Cash" {{ old('payment_mode', $gramBill->payment_mode) == 'Cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="Online" {{ old('payment_mode', $gramBill->payment_mode) == 'Online' ? 'selected' : '' }}>Online</option>
                                        <option value="RTGS" {{ old('payment_mode', $gramBill->payment_mode) == 'RTGS' ? 'selected' : '' }}>RTGS</option>
                                    </select>
                                    @error('payment_mode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Next Maintenance Date -->
                                <div class="col-md-4">
                                    <label for="next_maintenance_date" class="form-label">Next Maintenance Date</label>
                                    <input type="date" class="form-control @error('next_maintenance_date') is-invalid @enderror"
                                        id="next_maintenance_date" name="next_maintenance_date" value="{{ old('next_maintenance_date', $gramBill->next_maintenance_date) }}">
                                    @error('next_maintenance_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                        
                                <!-- Bill Status -->
                                <div class="col-md-4">
                                    <label for="bill_status" class="form-label">Bill Status</label>
                                    <select class="form-control @error('bill_status') is-invalid @enderror"
                                        id="bill_status" name="bill_status">
                                        <option value="pending" {{ old('bill_status', $gramBill->bill_status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="complete" {{ old('bill_status', $gramBill->bill_status) == 'complete' ? 'selected' : '' }}>Complete</option>
                                    </select>
                                    @error('bill_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        
                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-12 d-flex justify-content-between">
                                    <a href="{{ route('gram-bills.index') }}" class="btn btn-secondary">Back</a>
                                    <button type="submit" class="btn btn-primary">Update Bill</button>
                                </div>
                            </div>
                            
                        </form>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
    <script>
        const textarea = document.getElementById('description');
        const charCountIndicator = document.getElementById('charCountIndicator');
        const maxChars = 5000;

        textarea.addEventListener('input', function() {
            const charCount = textarea.value.length;

            if (charCount > maxChars) {
                textarea.value = textarea.value.substring(0, maxChars); // Limit to maxChars
            }

            charCountIndicator.textContent = `Characters: ${charCount} / ${maxChars}`;
        });
    </script>
<script>
$(document).ready(function() {
    $('.select2').select2({ placeholder: 'Select an option', allowClear: true });

    // Load districts and talukas
    function loadDropdowns() {
        loadInitialDistricts();
        loadInitialTalukas();
        loadInitialGram();
    }

    function loadInitialDistricts() {
        var state = $('#state').val();
        if (state) {
            var statesData = @json($statesData['states']);
            var selectedState = statesData.find(item => item.state === state);
            var districtDropdown = $('#district');

            districtDropdown.empty().append('<option value="">Select District</option>');
            if (selectedState) {
                selectedState.districts.forEach(district => {
                    districtDropdown.append($('<option>', { value: district, text: district }));
                });
                $('#district').val('{{ $gramBill->district }}').trigger('change');
            }
        }
    }

    function loadInitialTalukas() {
        var state = $('#state').val();
        var district = $('#district').val();
        if (state && district) {
            $.ajax({
                url: '{{ route('tehsils.get') }}',
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    var talukaDropdown = $('#taluka-field');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');
                    response.forEach(taluka => {
                        talukaDropdown.append($('<option>', { value: taluka, text: taluka }));
                    });
                    $('#taluka-field').val('{{ $gramBill->taluka }}').trigger('change');
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }
    }

    function loadInitialGram() {
        var state = $('#state').val();
        var district = $('#district').val();
        var taluka = $('#taluka-field').val(); // Corrected to fetch taluka value from dropdown

        if (state && district && taluka) {
            $.ajax({
                url: '{{ route('grams.get') }}', // Route for fetching grams
                type: 'GET',
                data: { state: state, district: district, taluka: taluka },
                success: function(response) {
                    var gramDropdown = $('#gram-field');
                    gramDropdown.empty().append('<option value="">Select Gram</option>');
                    response.forEach(function(gram) {
                        gramDropdown.append($('<option>', { value: gram, text: gram }));
                    });
                    $('#gram-field').val('{{ $gramBill->gram }}').trigger('change'); // Pre-select value for gram
                },
                error: function(xhr) {
                    console.error('Error fetching grams:', xhr.responseText);
                }
            });
        } else {
            // Clear the Gram dropdown if dependencies are not selected
            $('#gram-field').empty().append('<option value="">Select Gram</option>');
        }
        // Clear user dropdown as Gram changes
        $('#username').empty().append('<option value="">Select User Name</option>');
    }

    loadDropdowns();

    // Attach change handlers
    $('#state').change(function() {
        loadInitialDistricts();
        $('#taluka-field').empty().append('<option value="">Select Taluka</option>'); // Reset dependent dropdowns
        $('#gram-field').empty().append('<option value="">Select Gram</option>');
    });

    $('#district').change(function() {
        loadInitialTalukas();
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Reset dependent dropdown
    });

    $('#taluka-field').change(function() {
        loadInitialGram();
    });
});
</script>

@endsection
