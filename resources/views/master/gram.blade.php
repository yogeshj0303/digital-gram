@extends('layouts.master')
@section('title')
    @lang('translation.Grams')
@endsection

@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">

    <div class="row">
        <!-- List Categories -->
        <div class="col-xxl-7">
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
                    <h4 class="card-title mb-0 flex-grow-1">Gram</h4>
                </div>
                
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="gramTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Gram Name</th>
                                    <th>State</th>
                                    <th>District</th>
                                    <th>Taluka</th>
                                    <th>Village Address</th>
                                    <th>Pin Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($grams as $gram)
                                <tr id="gramRow{{ $gram->id }}">
                                    <td>{{ $gram->id }}</td>
                                    <td>{{ $gram->gram_name }}</td>
                                    <td>{{ $gram->state }}</td>
                                    <td>{{ $gram->district }}</td>
                                    <td>{{ $gram->taluka }}</td>
                                    <td>{{ $gram->address }}</td>
                                    <td>{{ $gram->pin_code }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-sm btn-primary editGram" data-id="{{ $gram->id }}">
                                         <i class="fa fa-edit"></i> Edit
                                     </button>
<button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" data-id="{{ $gram->id }}">
 Delete
</button>

                                     </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Grams found</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        @if($grams->isNotEmpty())
                            <div class="d-flex justify-content-center">
                                {!! $grams->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Category -->
        <div class="col-xxl-5">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Gram</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('grams.store') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <label for="state" class="form-label">State</label>
                            <select name="state" id="state" class="form-control js-example-basic-single
                            @error('state') is-invalid @enderror">
                            <option value="">Select State</option>
                            @foreach ($statesData['states'] as $state)
                                <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
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
                            <select name="district" id="district"
                                class="form-control @error('district') is-invalid @enderror">
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
                            <select name="taluka" id="taluka-field" class="form-select">
                                <option value="">Select Taluka</option>
                                <!-- Populate dynamically -->
                            </select>
                        </div>
                       
                       

                        <div class="col-md-12">
                            <label for="category_name" class="form-label">Gram Name</label>
                            <input type="text" name="gram_name" class="form-control @error('gram_name') is-invalid @enderror" id="gram_name" placeholder="Enter Gram Name">
                            @error('gram_name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label">Village Address</label>
                            <textarea name="address" id="address" class="form-control" rows="2" placeholder="Enter Address"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="pincode" class="form-label">Pin Code</label>
                            <input type="text" name="pin_code" class="form-control" id="pincode" placeholder="Enter Pin Code">
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
                            <h5 class="modal-title" id="editCategoryModalLabel">Edit Gram</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                        <label for="editState" class="form-label">State</label>
                        <select id="editState" name="state" class="form-select mb-3" required>
                            <option value="">Select state</option>
                            @foreach($statesData['states'] as $state)
                                <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Select for District -->
                    <div class="mb-3">
                        <label for="editDistrict" class="form-label">District</label>
                        <select name="district" id="editDistrict" class="form-control @error('district') is-invalid @enderror">
                            <option value="">Select District</option>
                            <!-- District options will be populated based on state selection -->
                        </select>
                        @error('district')
                            <div class="invalid-feedback" style="color: red;">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
 <div class="mb-3">
                                <label for="editTaluka" class="form-label">Taluka</label>
                                <select name="taluka" id="editTaluka" class="form-select">
                                    <option value="">Select Taluka</option>
                                    <!-- Populate dynamically -->
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editGramName" class="form-label">Gram Name</label>
                                <input type="text" name="gram_name" class="form-control @error('gram_name') is-invalid @enderror" id="editGramName" required>
                                @error('gram_name')
                                    <div class="invalid-feedback" style="color: red;">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="editAddress" class="form-label">Village Address</label>
                                <textarea name="address" id="editAddress" class="form-control" rows="2" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="editPincode" class="form-label">Pin Code</label>
                                <input type="text" name="pin_code" class="form-control" id="editPincode" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
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
     $(document).ready(function() {
            // Handle state selection change
            $('#state').change(function() {
                var state = $(this).val(); // Get the selected state value
                var statesData = @json($statesData['states']); // Pass states data to JavaScript

                var districtDropdown = $('#district');
                districtDropdown.empty().append(
                '<option value="">Select District</option>'); // Clear existing options

                // Find the selected state object from the statesData array
                var selectedState = statesData.find(function(item) {
                    return item.state === state; // Match the selected state
                });

                // Check if the selected state is found
                if (selectedState) {
                    // Populate the district dropdown with the districts of the selected state
                    selectedState.districts.forEach(function(district) {
                        districtDropdown.append($('<option>', {
                            value: district, // Use the district name as the value
                            text: district // Display the district name as the option text
                        }));
                    });
                } else {
                    districtDropdown.append('<option value="">No districts available</option>');
                }

                // Clear the taluka field dropdown
                $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
            });
        
            $('#district').change(function() {
                var state = $('#state').val();
                var district = $(this).val();

                if (state && district) {
                    $.ajax({
                        url: '{{ route('tehsils.get') }}',
                        type: 'GET',
                        data: { state: state, district: district },
                        success: function(response) {
                            var talukaDropdown = $('#taluka-field');
                            talukaDropdown.empty().append('<option value="">Select Taluka</option>'); 

                            response.forEach(function(taluka) {
                                talukaDropdown.append($('<option>', {
                                    value: taluka,
                                    text: taluka
                                }));
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching talukas:', xhr.responseText);
                        }
                        
                        
                    });
                
                    
                    
                    
                }
                
                
                
                
                
                
                        
                
                
            });

          
        });
</script>



<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
            var id = $(this).data('id');
            
         
            $.get('/gram/' + id + '/edit', function(data) {
                console.log(data);
                $('#editGramModal').modal('show');
               
                $('#editGramName').val(data.gram_name); // Correct ID
                $('#editState').val(data.state).change(); // Correct ID
            $('#editDistrict').val(data.district).change();
             
        $('#editTaluka').data('selected-taluka', data.taluka);
                $('#editAddress').val(data.address); // Correct ID
                $('#editPincode').val(data.pin_code); // Correct ID
                $('#editGramForm').attr('action', '/gram/' + id);
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
                        $('#editTaluka').val(selectedTaluka);
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching talukas:', xhr.responseText);
                }
            });
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


        // Handle Edit Gram Form Submission
        $('#editGramForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            var form = $(this);
            var actionUrl = form.attr('action');
            var formData = form.serialize();

            $.ajax({
                url: actionUrl,
                type: 'PUT',
                data: formData,
                success: function(response) {
                    var id = response.id;
                    $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name);
                    $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
                    $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
                    $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
                    $('#gramRow' + id + ' td:nth-child(6)').text(response.address);
                    $('#gramRow' + id + ' td:nth-child(7)').text(response.pin_code);
                    $('#editGramModal').modal('hide');
                    Swal.fire({
                        title: 'Success!',
                        text: 'Gram updated successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); // Reload after closing the success alert
                        }
                    });
                },
                error: function(response) {
                    alert('An error occurred while trying to update the gram.');
                }
            });
        });

           });
</script>


<script>
     // Handle Delete Gram
        $('.remove-item-btn').click(function() {
            var id = $(this).data('id');
            $('#deleteForm').attr('action', '/grams/' + id);
        });

        // Handle Delete Gram Form Submission
        $('#deleteForm').submit(function(event) {
            event.preventDefault();

            var form = $(this);
            var actionUrl = form.attr('action');
            var id = actionUrl.split('/').pop(); // Extract ID from URL

            $.ajax({
                url: actionUrl,
                type: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    $('#gramRow' + id).remove();
                    $('#deleteRecordModal').modal('hide');
                    alert('Gram deleted successfully.');
                    window.location.reload();
                },
                error: function(response) {
                    alert('An error occurred while trying to delete the gram.');
                }
            });
        });

</script>

@endsection
