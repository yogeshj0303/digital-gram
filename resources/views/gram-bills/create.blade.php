@extends('layouts.master')
@section('title')
    @lang('translation.list-js4')
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
                    <h4 class="card-title mb-0 flex-grow-1">Add Gram Bills</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('gram-bills.store') }}" method="POST">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select name="state" id="state" class="form-control js-example-basic-single @error('state') is-invalid @enderror">
                                        <option value="">Select State</option>
                                        @foreach ($statesData['states'] as $state)
                                            <option value="{{ $state['state'] }}" {{ old('state') == $state['state'] ? 'selected' : '' }}>{{ $state['state'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('state')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="district" class="form-label">District</label>
                                    <select name="district" id="district" class="form-control js-example-basic-single @error('district') is-invalid @enderror">
                                        <option value="">Select District</option>
                                        <!-- District options will be populated based on state selection -->
                                    </select>
                                    @error('district')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="taluka" class="form-label">Taluka</label>
                                    <select name="taluka" id="taluka-field" class="form-select js-example-basic-single @error('taluka') is-invalid @enderror">
                                        <option value="">Select Taluka</option>
                                        <!-- Populate dynamically -->
                                    </select>
                                    @error('taluka')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                               
                               
        
                                <div class="col-md-4">
                                    <label for="category_name" class="form-label">Gram Name</label>
                                    <select class="form-control js-example-basic-single @error('gram') is-invalid @enderror" id="gram-field" name="gram">
                                        <option value="">Select Gram</option>
                                        <!-- Add options dynamically -->
                                    </select>
                                    @error('gram')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
        
                                <div class="col-md-4">
                                    <label for="population" class="form-label">Population</label>
                                    <input type="number" class="form-control @error('population') is-invalid @enderror"
                                        id="population" name="population" placeholder="Enter Population">
                                    @error('population')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="first_time_bill_amount" class="form-label">First Time Bill Amount</label>
                                    <input type="number"
                                        class="form-control @error('first_time_bill_amount') is-invalid @enderror"
                                        id="first_time_bill_amount" name="first_time_bill_amount"
                                        placeholder="Enter First Time Bill Amount">
                                    @error('first_time_bill_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="quatation_date" class="form-label">Quotation Date</label>
                                    <input type="date" class="form-control @error('quatation_date') is-invalid @enderror"
                                        id="quatation_date" name="quatation_date">
                                    @error('quatation_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="bill_date" class="form-label">Bill Date</label>
                                    <input type="date" class="form-control @error('bill_date') is-invalid @enderror"
                                        id="bill_date" name="bill_date">
                                    @error('bill_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="reference_number" class="form-label">Reference Number</label>
                                    <input type="number"
                                        class="form-control @error('reference_number') is-invalid @enderror"
                                        id="reference_number" name="reference_number" placeholder="Enter Reference Number">
                                    @error('reference_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="maintenance_amount" class="form-label">Maintenance Amount</label>
                                    <input type="number"
                                        class="form-control @error('maintenance_amount') is-invalid @enderror"
                                        id="maintenance_amount" name="maintenance_amount"
                                        placeholder="Enter Maintenance Amount">
                                    @error('maintenance_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                        rows="5" maxlength="5000"></textarea>
                                    <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="payment_mode" class="form-label">Payment Mode</label>
                                    <select class="form-control @error('payment_mode') is-invalid @enderror"
                                        id="payment_mode" name="payment_mode">
                                        <option value="">Select Payment Mode</option>
                                        <option value="Cash">Cash</option>
                                        <option value="Online">Online</option>
                                        <option value="RTGS">RTGS</option>
                                    </select>
                                    @error('payment_mode')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="next_maintenance_date" class="form-label">Next Maintenance Date</label>
                                    <input type="date"
                                        class="form-control @error('next_maintenance_date') is-invalid @enderror"
                                        id="next_maintenance_date" name="next_maintenance_date">
                                    @error('next_maintenance_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="bill_status" class="form-label">Bill Status</label>
                                    <select class="form-control @error('bill_status') is-invalid @enderror"
                                        id="bill_status" name="bill_status">
                                        <option value="pending">Pending</option>
                                        <option value="complete">Complete</option>
                                    </select>
                                    @error('bill_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <div class="text-start">
                                        <a href="{{ route('gram-bills.index') }}" class="btn btn-secondary">Back</a>
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
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
        $('#district').select2({
            placeholder: 'Select District',
            allowClear: true
        });
    });



    $(document).ready(function() {
        $('#state').select2({
            placeholder: 'Select state',
            allowClear: true
        });
    });
</script>
<script>
  $(document).ready(function () {
    // Handle state selection change
    $('#state').change(function () {
        var state = $(this).val();
        var statesData = @json($statesData['states']); // Pass states data to JavaScript

        var districtDropdown = $('#district');
        districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

        var selectedState = statesData.find(function (item) {
            return item.state === state;
        });

        if (selectedState) {
            selectedState.districts.forEach(function (district) {
                districtDropdown.append($('<option>', {
                    value: district,
                    text: district
                }));
            });
        }

        $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
        $('#name').empty().append('<option value="">Select Profile Name</option>'); // Clear existing options
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Clear grams dropdown
    });

    // Handle district selection change
    $('#district').change(function () {
        var state = $('#state').val();
        var district = $(this).val();

        if (state && district) {
            $.ajax({
                url: '{{ route('tehsils.get') }}', // Ensure this matches your route
                type: 'GET',
                data: { state: state, district: district },
                success: function (response) {
                    var talukaDropdown = $('#taluka-field');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');

                    response.forEach(function (taluka) {
                        talukaDropdown.append($('<option>', {
                            value: taluka,
                            text: taluka
                        }));
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }
        $('#gram-field').empty().append('<option value="">Select Gram</option>'); // Clear grams dropdown
    });

    // Handle taluka selection change
    $('#taluka-field').change(function () {
        var state = $('#state').val();
        var district = $('#district').val();
        var taluka = $(this).val();

        if (state && district && taluka) {
            $.ajax({
                url: '{{ route('grams.get') }}', // Route for fetching grams
                type: 'GET',
                data: { state: state, district: district, taluka: taluka },
                success: function (response) {
                    var gramDropdown = $('#gram-field');
                    gramDropdown.empty().append('<option value="">Select Gram</option>');

                    response.forEach(function (gram) {
                        gramDropdown.append($('<option>', {
                            value: gram,
                            text: gram
                        }));
                    });
                },
                error: function (xhr) {
                    console.error('Error fetching grams:', xhr.responseText);
                }
            });
        }
    });
});
</script>

@endsection
