@extends('layouts.master')
@section('title')
    @lang('translation.list-js3')
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <style>
        .file-item {
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .file-item span {
            font-size: 14px;
        }
        .file-item button {
            margin-left: 10px;
        }
    </style>
    @endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- List Categories -->
        <div class="col-xxl-6">
            @if(session('success'))
            <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
@endif
@if(session('error'))
 
    <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
        <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Population</h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="gramTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>Gram Name</th>
                                    <th>Population</th>
                                    <th>year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($populations as $gram)
                                <tr>
                                    <td>{{ $gram->id }}</td>
                                    <td>{{ $gram->state }}</td>
                                    <td>{{ $gram->district }}</td>
                                    <td>{{ $gram->taluka }}</td>
                                    <td>{{ $gram->gram }}</td> 
                                    <td>{{ $gram->population }}</td>
                                    <td>{{ $gram->year }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                         <!-- Edit Button (Trigger Modal) -->
        <button class="btn btn-sm btn-primary editGram" data-id="{{ $gram->id }}">
            <i class="fa fa-edit"></i> Edit
        </button>
        
                                        <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteRecordModal" data-id="{{ $gram->id }}">
                                            Delete
                                        </button>

                                    </td>
                                </tr>
                            @endforeach
                            
                            </tbody>
                        </table>
                        @if ($populations->isNotEmpty())
                            <div class="d-flex justify-content-center">
                                {!! $populations->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <div class="col-xxl-6">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Population</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('population.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
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
                        <div class="col-md-12">
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
                        <div class="col-md-12">
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
                       
                       

                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Select Gram</label>
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


                        <div class="col-md-12 mb-3">
                            <label for="gram" class="form-label">Population</label>
                            <input type="number" id="population" class="form-control" name="population">
                            @error('population')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="gram" class="form-label">Year</label>
                            <input type="number" id="year" class="form-control" name="year">
                            @error('year')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="confirmed_by" class="form-label">Confirmed By</label>
                            <select id="confirmed_by" class="form-control js-example-basic-single @error('confirmed_by') is-invalid @enderror" name="confirm_by">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_type }}" {{ old('confirmed_by') == $user->user_type ? 'selected' : '' }}>{{ $user->user_type }}</option>
                                @endforeach
                            </select>
                            @error('confirmed_by')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                        
                        <div class="col-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Delete Modal -->
        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you Sure?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record?</p>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <form id="deleteForm" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light">Yes, delete it</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form id="editGramForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editGramModalLabel">Edit Gram</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- State Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="state" class="form-label">State</label>
                        <select id="editState" name="state" class="form-select mb-3" required>
                            <option value="">Select state</option>
                            @foreach($statesData['states'] as $state)
                                <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                            @endforeach
                        </select>
                                @error('state')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- District Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="district" class="form-label">District</label>
                        <select name="district" id="editDistrict" class="form-control @error('district') is-invalid @enderror">
                            <option value="">Select District</option>
                            <!-- District options will be populated based on state selection -->
                        </select>
                                @error('district')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- Taluka Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="taluka" class="form-label">Taluka</label>
                                <select name="taluka" id="editTaluka" class="form-select">
                                    <option value="">Select Taluka</option>
                                    <!-- Populate dynamically -->
                                </select>
                                @error('taluka')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- Gram Name Selection -->
                            <div class="col-md-12 mb-3">
                                <label for="gram" class="form-label">Gram Name</label>
                                <select class="form-control @error('gram') is-invalid @enderror" id="editGramName" name="gram">
                                    <option value="">Select Gram</option>
                                    <!-- Gram options will be added dynamically -->
                                </select>
                                @error('gram')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
        
                            <!-- Category Selection -->

                            <!-- PDF Upload -->
                        <div class="col-md-12 mb-3">
                            <label for="population" class="form-label">Population</label>
                            <input type="text" id="editpopulation" class="form-control" name="population">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="text" id="edityear" class="form-control" name="year">
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="confirmed_by" class="form-label">Confirmed By</label>
                            <select id="confirm_by" class="form-control js-example-basic-single @error('confirm_by') is-invalid @enderror" name="confirm_by">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->user_type }}" {{ old('confirm_by') == $user->user_type ? 'selected' : '' }}>{{ $user->user_type }}</option>
                                @endforeach
                            </select>
                            @error('confirmed_by')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        
                      
                        </div>
                        <div class="modal-footer">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </form>
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
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
    var id = $(this).data('id');
    
    $.get('/population/' + id + '/edit', function(data) {


        $('#editGramModal').modal('show');
                $('#editState').val(data.Population.state).change(); 
            $('#editDistrict').val(data.Population.district).change();
             
$('#editTaluka').data('selected-taluka', data.Population.taluka).trigger('change'); // Set selected taluka in memory
$('#editTaluka').val(data.Population.taluka); // Set dropdown value and trigger change

        var talukaa = $('#editTaluka').val();


        $('#editGramName').data('selected-gram', data.Population.gram); 

                $('#editpopulation').val(data.Population.population);
                $('#edityear').val(data.Population.year);

            $('#confirm_by').val(data.Population.confirm_by).change();


        $('#editGramForm').attr('action', '/population/' + id); 
    });
});


   $('#editState').change(function() {
        var state = $(this).val();
        var statesData = @json($statesData['states']); // Pass states data to JavaScript

        var districtDropdown = $('#editDistrict');
        districtDropdown.empty().append('<option value="">Select District</option>'); // Clear existing options

        var selectedState = statesData.find(function(item) {
            return item.state === state;
        });
        
        console.log('selectedState' + selectedState);

        if (selectedState) {
            selectedState.districts.forEach(function(district) {
                districtDropdown.append($('<option>', {
                    value: district,
                    text: district
                }));
            });
        }

        // Clear taluka and organization dropdowns
        $('#editTaluka').empty().append('<option value="">Select Taluka</option>');
    });
    
    
    
 $('#editDistrict').change(function() {
        var state = $('#editState').val();
        var district = $(this).val();

        if (state && district) {
            // Fetch Talukas
            $.ajax({
                url: '{{ route('tehsils.get') }}',
                type: 'GET',
                data: { state: state, district: district },
                success: function(response) {
                    var talukaDropdown = $('#editTaluka');
                    talukaDropdown.empty().append('<option value="">Select Taluka</option>');

                    response.forEach(function(taluka) {
                        talukaDropdown.append($('<option>', {
                            value: taluka,
                            text: taluka
                        }));
                    });

                    // Now set the selected taluka
                    var selectedTaluka = $('#editTaluka').data('selected-taluka');
                    console.log('selectedTaluka' + selectedTaluka);
                    if (selectedTaluka) {
                    $('#editTaluka').val(selectedTaluka).trigger('change');
        console.log('Taluka after setting in dropdown:', $('#editTaluka').val());
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
        }

        });

    
    
    
    
$('#editTaluka').change(function () {
    console.log('enterrrrr');
    var state = $('#editState').val(); // Get selected state
    var district = $('#editDistrict').val(); // Get selected district
    var taluka = $('#editTaluka').val(); // Get selected district

    
    console.log('taluka' + taluka);

    if (state && district && taluka) {
        $.ajax({
            url: '{{ route('grams.get') }}', // Route for fetching grams
            type: 'GET',
            data: { state: state, district: district, taluka: taluka },
            success: function (response) {
                console.log(response);
                var gramDropdown = $('#editGramName'); // Target gram dropdown
                gramDropdown.empty().append('<option value="">Select Gram</option>');

                // Populate the gram dropdown
                response.forEach(function (gram) {
                    gramDropdown.append($('<option>', {
                        value: gram.id, // Assuming each gram has an `id` in the response
                        text: gram // Assuming each gram has a `name` in the response
                    }));
                });

                // Set the selected gram if available
var selectedGram = $('#editGramName').data('selected-gram');
if (selectedGram) {
    console.log('Setting selected gram:', selectedGram);
    $('#editGramName').val(selectedGram).trigger('change');
                        console.log('Gram after setting:', gramDropdown.val());

    
    
}            },
            error: function (xhr) {
                console.error('Error fetching grams:', xhr.responseText);
            }
        });
    } else {
        // Clear Gram dropdown if dependencies are not selected
        $('#editGramName').empty().append('<option value="">Select Gram</option>');
    }
});


    
    
    
    
    

      $('#editState').select2({
        placeholder: 'Select state',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

    $('#editDistrict').select2({
        placeholder: 'Select district',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

  $('#editTaluka').select2({
        placeholder: 'Select Taluka',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });


$('#editGramName').select2({
        placeholder: 'Select gram',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });

$('#editcategory').select2({
        placeholder: 'Select category',
        allowClear: true,
        dropdownParent: $('#editGramModal')
    });




// Handle Edit Gram Form Submission
$('#editGramForm').submit(function (event) {
    event.preventDefault(); // Prevent the default form submission

    var form = $(this);
    var actionUrl = form.attr('action');
    
    // Prepare form data
    var formData = new FormData(this);

    // Set up CSRF Token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // Perform the AJAX request
    $.ajax({
        url: actionUrl,
        type: 'POST', // Use POST with Laravel PUT methods
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting content type
        success: function (response) {
            // Update table row
            var id = response.id; 
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram);
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
            $('#gramRow' + id + ' td:nth-child(6)').text(response.population);
            $('#gramRow' + id + ' td:nth-child(7)').text(response.year);
            $('#gramRow' + id + ' td:nth-child(8)').text(response.confirm_by);

            // Hide modal and reload page
            $('#editGramModal').modal('hide');
            Swal.fire({
                title: 'Success!',
                text: 'Population updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload();
                }
            });
        },
        error: function (response) {
            // Handle errors
            var errors = response.responseJSON.errors;
            var errorMessage = 'An error occurred.\n\n';
            if (errors) {
                for (var field in errors) {
                    errorMessage += `${field}: ${errors[field].join(', ')}\n`;
                }
            } else {
                errorMessage += 'Unknown error.';
            }
            Swal.fire({
                title: 'Error!',
                text: errorMessage,
                icon: 'error',
                confirmButtonText: 'OK',
            });
        },
    });
});


       
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
