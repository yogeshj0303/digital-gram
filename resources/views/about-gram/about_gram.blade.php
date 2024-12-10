@extends('layouts.master')
@section('title')
    @lang('translation.list-js2')
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
            @if (session('success'))
                <div class="alert alert-success alert-border-left alert-dismissible fade show" role="alert">
                    <i class="ri-notification-off-line me-3 align-middle fs-16"></i><strong>Success</strong>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-border-left alert-dismissible fade show mb-xl-0" role="alert">
                    <i class="ri-error-warning-line me-3 align-middle fs-16"></i><strong>Danger</strong>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
       
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">About Gram</h4>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($aboutGrams as $gram)
                                    <tr>
                                        <td>{{ $gram->id }}</td>
                                        <td>{{ $gram->state }}</td>
                                        <td>{{ $gram->district }}</td>
                                        <td>{{ $gram->taluka }}</td>
                                        <td>{{ $gram->gram }}</td>
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
                        @if ($aboutGrams->isNotEmpty())
                            <div class="d-flex justify-content-center">
                                {!! $aboutGrams->links() !!}
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
                    <h4 class="card-title mb-0 flex-grow-1">Add About Gram</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('about-gram.store') }}" method="POST" class="row g-3"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-12">
                            <label for="state" class="form-label">State</label>
                            <select name="state" id="state"
                                class="form-control js-example-basic-single @error('state') is-invalid @enderror">
                                <option value="">Select State</option>
                                @foreach ($statesData['states'] as $state)
                                    <option value="{{ $state['state'] }}"
                                        {{ old('state') == $state['state'] ? 'selected' : '' }}>{{ $state['state'] }}
                                    </option>
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
                                class="form-control js-example-basic-single @error('district') is-invalid @enderror">
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
                            <select name="taluka" id="taluka-field"
                                class="form-select js-example-basic-single @error('taluka') is-invalid @enderror">
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
                            <label for="category_name" class="form-label">Gram Name</label>
                            <select class="form-control js-example-basic-single @error('gram') is-invalid @enderror"
                                id="gram-field" name="gram">
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
                            <label for="gram" class="form-label">About Gram</label>
                            <textarea id="aboutGram" class="form-control" name="about_gram" rows="5" maxlength="5000"></textarea>
                            <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                            @error('about_gram')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <div class="col-md-12">
                            <label for="pdf" class="form-label">Select PDF</label>
                            <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf"
                                name="pdf" onchange="handleFileSelect(event)">
                        </div>

                        <div id="fileList" class="mt-3"></div>




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
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body text-center">
                    <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                        colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
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
                    <form id="editGramForm" method="POST" enctype="multipart/form-data">
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
        
                            
                                                    <div class="col-md-12 mb-3">
                            <label for="gram" class="form-label">About Gram</label>
                            <textarea id="aboutGramedit" class="form-control" name="about_gram" rows="5" maxlength="5000"></textarea>
                            <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>
                            @error('about_gram')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

        
                         <div class="col-md-12 mb-3">
    <label for="pdf" class="form-label">Select PDF </label>
    <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdfedit" name="pdf[]" multiple onchange="handleFileSelectEdit(event)">
</div>

<div id="filePreview" class="mt-3">
    
   
</div>


<div id="fileListedit" class="mt-3"></div>

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

    <!--<div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">-->
    <!--    <div class="modal-dialog">-->
    <!--        <div class="modal-content">-->
    <!--            <form id="editGramForm" method="POST" enctype="multipart/form-data">-->
    <!--                @csrf-->
    <!--                @method('PUT')-->
    <!--                <div class="modal-header">-->
    <!--                    <h5 class="modal-title" id="editGramModalLabel">Edit About Gram</h5>-->
    <!--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
    <!--                </div>-->
    <!--                <div class="modal-body">-->
                        <!-- State Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="state" class="form-label">State</label>-->
    <!--                        <select name="state" id="state"-->
    <!--                            class="form-control js-example-basic-single @error('state') is-invalid @enderror">-->
    <!--                            <option value="">Select State</option>-->
    <!--                            @foreach ($statesData['states'] as $state)-->
    <!--                                <option value="{{ $state['state'] }}"-->
    <!--                                    {{ old('state') == $state['state'] ? 'selected' : '' }}>{{ $state['state'] }}-->
    <!--                                </option>-->
    <!--                            @endforeach-->
    <!--                        </select>-->
    <!--                        @error('state')-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                {{ $message }}-->
    <!--                            </div>-->
    <!--                        @enderror-->
    <!--                    </div>-->

                        <!-- District Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="district" class="form-label">District</label>-->
    <!--                        <select name="district" id="district"-->
    <!--                            class="form-control @error('district') is-invalid @enderror">-->
    <!--                            <option value="">Select District</option>-->
                                <!-- District options will be populated dynamically -->
    <!--                        </select>-->
    <!--                        @error('district')-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                {{ $message }}-->
    <!--                            </div>-->
    <!--                        @enderror-->
    <!--                    </div>-->

                        <!-- Taluka Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="taluka" class="form-label">Taluka</label>-->
    <!--                        <select name="taluka" id="taluka"-->
    <!--                            class="form-select @error('taluka') is-invalid @enderror">-->
    <!--                            <option value="">Select Taluka</option>-->
                                <!-- Taluka options will be populated dynamically -->
    <!--                        </select>-->
    <!--                        @error('taluka')-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                {{ $message }}-->
    <!--                            </div>-->
    <!--                        @enderror-->
    <!--                    </div>-->

                        <!-- Gram Name Selection -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="gram" class="form-label">Gram Name</label>-->
    <!--                        <select class="form-control @error('gram') is-invalid @enderror" id="gram-field"-->
    <!--                            name="gram">-->
    <!--                            <option value="">Select Gram</option>-->
                                <!-- Gram options will be added dynamically -->
    <!--                        </select>-->
    <!--                        @error('gram')-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                {{ $message }}-->
    <!--                            </div>-->
    <!--                        @enderror-->
    <!--                    </div>-->

    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="gram" class="form-label">About Gram</label>-->
    <!--                        <textarea id="aboutGram" class="form-control" name="about_gram" rows="5" maxlength="5000"></textarea>-->
    <!--                        <div id="charCountIndicator" class="mt-2 text-muted">Characters: 0 / 5000</div>-->
    <!--                        @error('about_gram')-->
    <!--                            <div class="invalid-feedback">-->
    <!--                                {{ $message }}-->
    <!--                            </div>-->
    <!--                        @enderror-->
    <!--                    </div>-->




                        <!-- PDF Upload -->
    <!--                    <div class="col-md-12 mb-3">-->
    <!--                        <label for="pdf" class="form-label">Select PDF (Multiple)</label>-->
    <!--                        <input type="file" class="form-control @error('pdf') is-invalid @enderror" id="pdf"-->
    <!--                            name="pdf[]" multiple onchange="handleFileSelect(event)">-->
    <!--                    </div>-->

                        <!-- File Preview -->
    <!--                    <div id="fileList" class="mt-3"></div>-->

    <!--                </div>-->
    <!--                <div class="modal-footer">-->
    <!--                    <div class="text-end">-->
    <!--                        <button type="submit" class="btn btn-primary">Submit</button>-->
    <!--                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>-->
    <!--                    </div>-->
    <!--                </div>-->
    <!--            </form>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
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
    
                $.get('/about-gram/' + id + '/edit', function(data) {
        console.log(data);

        $('#editGramModal').modal('show');
                $('#editState').val(data.gram.state).change(); 
            $('#editDistrict').val(data.gram.district).change();
             
$('#editTaluka').data('selected-taluka', data.gram.taluka).trigger('change'); // Set selected taluka in memory
$('#editTaluka').val(data.gram.taluka); // Set dropdown value and trigger change

        var talukaa = $('#editTaluka').val();
        console.log('taluka after set' + talukaa);


        $('#editGramName').data('selected-gram', data.gram.gram); 

console.log('About Gram:', data.gram.about_gram);

$('#aboutGramedit').val(data.gram.about_gram);

        
        $('#editGramForm').attr('action', '/about-gram/' + id); // Set the form action URL
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






    $('#editGramForm').submit(function(event) {
        event.preventDefault(); // Prevent default form submission
        var form = $(this);
        var actionUrl = form.attr('action');

        // Prepare form data
        var formData = new FormData(this);

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false, // For FormData
            contentType: false, // For FormData
            success: function(response) {
                var id = response.id;
                // Update the table with the new data (example)
            $('#gramRow' + id + ' td:nth-child(2)').text(response.gram_name);
            $('#gramRow' + id + ' td:nth-child(3)').text(response.state);
            $('#gramRow' + id + ' td:nth-child(4)').text(response.district);
            $('#gramRow' + id + ' td:nth-child(5)').text(response.taluka);
            $('#gramRow' + id + ' td:nth-child(6)').text(response.about_gram);
            $('#gramRow' + id + ' td:nth-child(7)').text(response.pdf_files); 

                // Hide the modal
                $('#editGramModal').modal('hide');

                // Success message with SweetAlert
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
                Swal.fire({
                    title: 'Error!',
                    text: 'An error occurred while trying to update the gram.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        });
    });


       
    });
</script>
    
    
    <script>
          $('.remove-item-btn').click(function() {
                var id = $(this).data('id');
                $('#deleteForm').attr('action', '/about-gram/' + id);
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
                        Swal.fire({ // Use SweetAlert2 for better notifications
                        title: 'Deleted!',
                        text: 'About Gram deleted successfully.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); // Reload page after user acknowledges the notification
                    });
                    },
                    error: function(response) {
                        alert('An error occurred while trying to delete the gram.');
                    }
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
        $(document).ready(function() {
            // Handle state selection change
            $('#state').change(function() {
                var state = $(this).val();
                var statesData = @json($statesData['states']); // Pass states data to JavaScript

                var districtDropdown = $('#district');
                districtDropdown.empty().append(
                '<option value="">Select District</option>'); // Clear existing options

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

                $('#taluka-field').empty().append('<option value="">Select Taluka</option>');
                $('#name').empty().append(
                '<option value="">Select Profile Name</option>'); // Clear existing options
                $('#gram-field').empty().append(
                '<option value="">Select Gram</option>'); // Clear grams dropdown
            });

            // Handle district selection change
            $('#district').change(function() {
                var state = $('#state').val();
                var district = $(this).val();

                if (state && district) {
                    $.ajax({
                        url: '{{ route('tehsils.get') }}', // Ensure this matches your route
                        type: 'GET',
                        data: {
                            state: state,
                            district: district
                        },
                        success: function(response) {
                            var talukaDropdown = $('#taluka-field');
                            talukaDropdown.empty().append(
                                '<option value="">Select Taluka</option>');

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
                $('#gram-field').empty().append(
                '<option value="">Select Gram</option>'); // Clear grams dropdown
            });

            // Handle taluka selection change
            $('#taluka-field').change(function() {
                var state = $('#state').val();
                var district = $('#district').val();
                var taluka = $(this).val();

                if (state && district && taluka) {
                    $.ajax({
                        url: '{{ route('grams.get') }}', // Route for fetching grams
                        type: 'GET',
                        data: {
                            state: state,
                            district: district,
                            taluka: taluka
                        },
                        success: function(response) {
                            var gramDropdown = $('#gram-field');
                            gramDropdown.empty().append(
                            '<option value="">Select Gram</option>');

                            response.forEach(function(gram) {
                                gramDropdown.append($('<option>', {
                                    value: gram,
                                    text: gram
                                }));
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching grams:', xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>


    <script>
        let fileUpload = null; // To store the upload data for the single file

        function handleFileSelect(event) {
            const file = event.target.files[0]; // Get the first (and only) file selected
            const fileListContainer = document.getElementById('fileList');

            // Check if a file was selected
            if (!file) {
                return; // Do nothing if no file is selected
            }

            // If a file is already being uploaded, do not process another one
            if (fileUpload && fileUpload.isUploading) {
                return;
            }

            // If a file is already uploaded, remove the previous one
            if (fileUpload) {
                removeFile();
            }

            // Add the selected file to the fileUpload object
            fileUpload = {
                file: file,
                progressBar: null,
                percentageText: null,
                uploaded: 0,
                isUploading: false // Track whether the file is currently being uploaded
            };

            // Re-render the file list UI
            renderFileList();

            // Start uploading simulation (replace with actual upload logic)
            simulateFileUpload(file);
        }

        function renderFileList() {
            const fileListContainer = document.getElementById('fileList');
            fileListContainer.innerHTML = ''; // Clear the file listings before re-rendering

            if (fileUpload) {
                const fileItem = document.createElement('div');
                fileItem.classList.add('file-item', 'mb-3');

                // File name
                const fileName = document.createElement('span');
                fileName.textContent = `${fileUpload.file.name} (${(fileUpload.file.size / 1024).toFixed(2)} KB)`;
                fileItem.appendChild(fileName);

                // Progress Bar
                const progress = document.createElement('progress');
                progress.value = fileUpload.uploaded;
                progress.max = 100;
                progress.style.width = '100%';
                fileItem.appendChild(progress);

                // Percentage text
                const percentage = document.createElement('span');
                percentage.textContent = `${fileUpload.uploaded}%`;
                percentage.classList.add('ms-2', 'font-weight-bold');
                fileItem.appendChild(percentage);

                // Total size info (optional)
                const sizeInfo = document.createElement('div');
                sizeInfo.classList.add('mt-1');
                const totalSize = document.createElement('span');
                totalSize.textContent = `Total size: ${(fileUpload.file.size / 1024).toFixed(2)} KB`;
                sizeInfo.appendChild(totalSize);
                fileItem.appendChild(sizeInfo);

                // Delete button
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
                deleteButton.onclick = removeFile;
                fileItem.appendChild(deleteButton);

                // Store references to progress, percentage, and remaining size text for later updates
                fileUpload.progressBar = progress;
                fileUpload.percentageText = percentage;

                // Append file item to the container
                fileListContainer.appendChild(fileItem);
            }
        }

        function simulateFileUpload(file) {
            if (fileUpload.isUploading) return; // Prevent multiple uploads for the same file
            fileUpload.isUploading = true; // Mark file as uploading

            const totalSize = file.size;
            let uploaded = fileUpload.uploaded; // Start from the previously uploaded progress

            // Set progress to initial uploaded value
            fileUpload.progressBar.value = uploaded;
            fileUpload.percentageText.textContent = `${uploaded}%`;

            const interval = setInterval(() => {
                // Simulate upload progress (replace this with actual upload logic)
                uploaded += totalSize / 10; // Simulate 10% increment per interval
                if (uploaded > totalSize) uploaded = totalSize;

                const progress = Math.min((uploaded / totalSize) * 100, 100);
                fileUpload.progressBar.value = progress;
                fileUpload.percentageText.textContent = `${Math.round(progress)}%`;

                if (progress >= 100) {
                    clearInterval(interval);
                    fileUpload.percentageText.textContent = `Upload complete!`; // Only show "Upload complete!"
                    fileUpload.percentageText.classList.add('text-success');
                    fileUpload.uploaded = 100; // Mark as fully uploaded
                    fileUpload.isUploading = false; // Mark file as not uploading
                }
            }, 500); // Increase progress every 500ms (you can adjust for actual file upload)
        }

        function removeFile() {
            // Mark the file as removed and reset fileUpload
            fileUpload = null;

            // Re-render the file list UI
            renderFileList();
        }
    </script>

    <script>
        const textarea = document.getElementById('aboutGram');
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
    let fileUploadsEdit = null; // To store the upload data for the single file

function handleFileSelectEdit(event) {
    const fileList = event.target.files[0]; // Get the first (and only) file selected

    const fileListContainer = document.getElementById('fileListedit');
    // Check if a file was selected
    if (!fileList) {
        return; // Do nothing if no file is selected
    }

    if (fileUploadsEdit && fileUploadsEdit.isUploading) {
        return;
    }

    // If there's already a file uploaded, remove it before adding the new one
    if (fileUploadsEdit) {
        removeFile();
    }

    // Only allow the first selected file
    const file = fileList;

    // Add the file to the upload data array (we'll just have one file in the array)
    fileUploadsEdit = [{
        file: file,
        progressBar: null,
        percentageText: null,
        remainingSizeText: null,
        uploaded: 0,
        isUploading: false // Track whether the file is currently being uploaded
    }];

    // Re-render the file list UI with the single file
    renderFileListEdit();

    // Start uploading simulation for the new file (or replace this with actual upload logic)
    simulateFileUploadEdit(file, fileUploadsEdit[0]);
}

function renderFileListEdit() {
    const fileListContainer = document.getElementById('fileListedit');
    fileListContainer.innerHTML = ''; // Clear the file listings before re-rendering

    // Only display the one file that is currently uploaded
    if (fileUploadsEdit && fileUploadsEdit.length > 0) {
        const uploadData = fileUploadsEdit[0]; // There should only be one file
        const fileItem = document.createElement('div');
        fileItem.classList.add('file-item', 'mb-3');

        // File name
        const fileName = document.createElement('span');
        fileName.textContent = `${uploadData.file.name} (${(uploadData.file.size / 1024).toFixed(2)} KB)`;
        fileItem.appendChild(fileName);

        // Progress Bar
        const progress = document.createElement('progress');
        progress.value = uploadData.uploaded;
        progress.max = 100;
        progress.style.width = '100%';
        fileItem.appendChild(progress);

        // Percentage text
        const percentage = document.createElement('span');
        percentage.textContent = `${uploadData.uploaded}%`;
        percentage.classList.add('ms-2', 'font-weight-bold');
        fileItem.appendChild(percentage);

        // Total size info (optional)
        const sizeInfo = document.createElement('div');
        sizeInfo.classList.add('mt-1');
        const totalSize = document.createElement('span');
        totalSize.textContent = `Total size: ${(uploadData.file.size / 1024).toFixed(2)} KB`;
        sizeInfo.appendChild(totalSize);

        fileItem.appendChild(sizeInfo);

        // Delete button
        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Delete';
        deleteButton.classList.add('btn', 'btn-danger', 'btn-sm', 'ms-2');
        deleteButton.onclick = () => removeFileEdit(0); // Remove the single file
        fileItem.appendChild(deleteButton);

        // Store references to progress, percentage, and remaining size text for later updates
        uploadData.progressBar = progress;
        uploadData.percentageText = percentage;

        // Append file item to the container
        fileListContainer.appendChild(fileItem);
    }
}

function simulateFileUploadEdit(file, uploadData) {
    if (uploadData.isUploading) return; // Prevent multiple uploads for the same file
    uploadData.isUploading = true; // Mark file as uploading

    const totalSize = file.size;
    let uploaded = uploadData.uploaded; // Start from the previously uploaded progress

    // Set progress to initial uploaded value
    uploadData.progressBar.value = uploaded;
    uploadData.percentageText.textContent = `${uploaded}%`;

    const interval = setInterval(() => {
        // Simulate upload progress (replace this with actual upload logic)
        uploaded += totalSize / 10; // Simulate 10% increment per interval
        if (uploaded > totalSize) uploaded = totalSize;

        const progress = Math.min((uploaded / totalSize) * 100, 100);
        uploadData.progressBar.value = progress;
        uploadData.percentageText.textContent = `${Math.round(progress)}%`;

        if (progress >= 100) {
            clearInterval(interval);
            uploadData.percentageText.textContent = `Upload complete!`; // Only show "Upload complete!"
            uploadData.percentageText.classList.add('text-success');
            uploadData.uploaded = 100; // Mark as fully uploaded
            uploadData.isUploading = false; // Mark file as not uploading
        }
    }, 500); // Increase progress every 500ms (you can adjust for actual file upload)
}

function removeFileEdit(index) {
    // Mark the file as removed but don't change the progress of other files
    fileUploadsEdit.splice(index, 1); // Remove file from fileUploads array

    // Re-render the file list UI (which will be empty if no files are left)
    renderFileListEdit();
}

</script>
    
    
    
@endsection
