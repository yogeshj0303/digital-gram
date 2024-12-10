@extends('layouts.master')
@section('title')
    @lang('translation.profile')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.10/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />


@endsection
@section('content')

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>

    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <img src="@if (Auth::user()->profile_pic != '') {{ URL::asset('storage/' . Auth::user()->profile_pic) }}@else{{ URL::asset('build/icons/user.png') }} @endif" alt="user-img" class="img-thumbnail rounded-circle" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{Auth::user()->name}}</h3>
                    <p class="text-white text-opacity-75">Owner & Founder</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{Auth::user()->state}},
                            {{Auth::user()->district}},{{Auth::user()->taluka}}</div>
                        
                    </div>
                </div>
            </div>
          
        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex profile-wrapper">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span
                                    class="d-none d-md-inline-block">Overview</span>
                            </a>
                        </li>
                        
                                                <li class="nav-item">
                            <a class="nav-link fs-14" data-bs-toggle="tab" href="#password-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i>
                                <span class="d-none d-md-inline-block">Change Password</span>
                            </a>
                        </li>

                        </ul>
                        
                        
                    
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                          
                            <div class="col-xxxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Profile Details</h5>
                                               <div class="d-flex justify-content-end"> 
        <button class="btn btn-primary editGram" data-id="{{ Auth::user()->id }}">
            <i class="fa fa-edit"></i> Edit
        </button>
    </div>

                                       
                                        <div class="row">
    <!-- State -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-2-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">State:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->state }}</h6>
            </div>
        </div>
    </div>
    <!-- District -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-community-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">District:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->district }}</h6>
            </div>
        </div>
    </div>
    <!-- Taluka -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-map-pin-range-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Taluka:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->taluka }}</h6>
            </div>
        </div>
    </div>
    <!-- Name -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-user-2-fill"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Name:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->name }}</h6>
            </div>
        </div>
    </div>
    <!-- Contact Number -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-phone-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Contact No:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->contact_no }}</h6>
            </div>
        </div>
    </div>
    <!-- Gender -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-gender-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Gender:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->gender }}</h6>
            </div>
        </div>
    </div>
    <!-- DOB -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-calendar-2-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Date of Birth:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->dob }}</h6>
            </div>
        </div>
    </div>
    <!-- Age -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-user-star-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Age:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->age }}</h6>
            </div>
        </div>
    </div>
    <!-- Land Area -->
    <div class="col-6 col-md-4">
        <div class="d-flex mt-4">
            <div class="flex-shrink-0 avatar-xs align-self-center me-3">
                <div class="avatar-title bg-light rounded-circle fs-16 text-primary">
                    <i class="ri-landscape-line"></i>
                </div>
            </div>
            <div class="flex-grow-1 overflow-hidden">
                <p class="mb-1">Land Area:</p>
                <h6 class="text-truncate mb-0">{{ Auth::user()->land_area }}</h6>
            </div>
        </div>
    </div>
</div>

                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->
                                
                                

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    
                    
                    
                    
                    
                                        <div class="tab-pane" id="password-tab" role="tabpanel">
    <!-- Card for Change Password -->
    <div class="card" style="width:40rem;">
        <div class="card-header">
            <h5 class="card-title mb-0">Change Password</h5>
        </div>
        <div class="card-body ">
<form action="{{ route('updatePassword', Auth::user()->id) }}" method="post">
    @csrf
    <div class="mb-3">
        <label for="currentPassword" class="form-label">Current Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" name="current_password" required>
            <button type="button" class="btn" onclick="togglePasswordVisibility('currentPassword', 'toggleCurrentPasswordIcon')">
                <i id="toggleCurrentPasswordIcon" class="fa fa-eye"></i>
            </button>
            @error('current_password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="newPassword" class="form-label">New Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" name="password" required>
            <button type="button" class="btn" onclick="togglePasswordVisibility('newPassword', 'toggleNewPasswordIcon')">
                <i id="toggleNewPasswordIcon" class="fa fa-eye"></i>
            </button>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <div class="input-group">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" required>
            <button type="button" class="btn" onclick="togglePasswordVisibility('password_confirmation', 'toggleConfirmPasswordIcon')">
                <i id="toggleConfirmPasswordIcon" class="fa fa-eye"></i>
            </button>
            @error('password_confirmation')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Change Password</button>
</form>
        </div>
    </div>
</div>
 <script>
    function togglePasswordVisibility(inputId, iconId) {
        var input = document.getElementById(inputId);
        var icon = document.getElementById(iconId);

        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>


                   
                    <!--end tab-pane-->
                </div>

                
                
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    
    
<div class="modal fade" id="editGramModal" tabindex="-1" aria-labelledby="editGramModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="editGramForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editGramModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- State -->
                        <div class="col-md-6 mb-3">
                            <label for="state" class="form-label">State</label>
                            <select id="editState" name="state" class="form-select" required>
                                <option value="">Select state</option>
                                @foreach($statesData['states'] as $state)
                                    <option value="{{ $state['state'] }}">{{ $state['state'] }}</option>
                                @endforeach
                            </select>
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- District -->
                        <div class="col-md-6 mb-3">
                            <label for="district" class="form-label">District</label>
                            <select id="editDistrict" name="district" class="form-select">
                                <option value="">Select District</option>
                                <!-- Dynamically populated -->
                            </select>
                            @error('district')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Taluka -->
                        <div class="col-md-6 mb-3">
                            <label for="taluka" class="form-label">Taluka</label>
                            <select id="editTaluka" name="taluka" class="form-select">
                                <option value="">Select Taluka</option>
                                <!-- Dynamically populated -->
                            </select>
                            @error('taluka')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- User Name -->
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">User Name</label>
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Contact No -->
                        <div class="col-md-6 mb-3">
                            <label for="contact_no" class="form-label">Contact No</label>
                            <input type="text" id="contact_no" name="contact_no" class="form-control @error('contact_no') is-invalid @enderror" value="">
                            @error('contact_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Gate Number -->
                        <div class="col-md-6 mb-3">
                            <label for="gate_no" class="form-label">Gate Number</label>
                            <input type="text" id="gate_no" name="gate_no" class="form-control @error('gate_no') is-invalid @enderror" value="">
                            @error('gate_no')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Gender -->
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select id="gender" name="gender" class="form-select @error('gender') is-invalid @enderror">
                                <option value="">Select Gender</option>
                                <option >Male</option>
                                <option >Female</option>
                            </select>
                            @error('gender')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Date of Birth -->
                        <div class="col-md-6 mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="">
                            @error('dob')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Age -->
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" id="age" name="age" class="form-control @error('age') is-invalid @enderror" value="">
                            @error('age')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- Land Area -->
                        <div class="col-md-6 mb-3">
                            <label for="land_area" class="form-label">Land Area</label>
                            <input type="text" id="land_area" name="land_area" class="form-control @error('land_area') is-invalid @enderror" value="">
                            @error('land_area')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


    
    <!--end row-->
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
    
    

   
   <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('build/js/pages/select2.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}'
        });
    </script>
@endif


<script>
    $(document).ready(function() {
        // Handle Edit Gram Modal
        $('.editGram').click(function() {
    var id = $(this).data('id');
    
    $.get('/editprofile/' + id, function(data) {
console.log(data);

        $('#editGramModal').modal('show');
        var stateValue = data.user.state;
        $('#editState').val(stateValue).trigger('change');
            $('#editDistrict').val(data.user.district).change();
             
$('#editTaluka').data('selected-taluka', data.user.taluka).trigger('change'); // Set selected taluka in memory
$('#editTaluka').val(data.taluka); // Set dropdown value and trigger change

        var talukaa = $('#editTaluka').val();
        
        
                $('#name').val(data.user.name);
        $('#contact_no').val(data.user.contact_no);
        $('#gate_no').val(data.user.gate_no);
        $('#gender').val(data.user.gender);
        $('#dob').val(data.user.dob);
        $('#age').val(data.user.age);
        $('#land_area').val(data.user.land_area);

        $('#editGramForm').attr('action', '/profileupdate/' + id); 


    });
});


   $('#editState').change(function() {
        var state = $(this).val();
        console.log('state issss' +state );
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

    
    
    
    


    
    $('#editGramForm').submit(function (event) {
    event.preventDefault(); // Prevent default form submission

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
        type: 'POST', // Use POST for compatibility with Laravel's PUT
        data: formData,
        processData: false, // Prevent jQuery from processing the data
        contentType: false, // Prevent jQuery from setting content type
        success: function (response) {
            // Update table row with the new data
            var id = response.id; // Ensure the response includes the ID
            $(`#gramRow${id} td:nth-child(2)`).text(response.gram);
            $(`#gramRow${id} td:nth-child(3)`).text(response.state);
            $(`#gramRow${id} td:nth-child(4)`).text(response.district);
            $(`#gramRow${id} td:nth-child(5)`).text(response.taluka);
            $(`#gramRow${id} td:nth-child(6)`).text(response.name);
            $(`#gramRow${id} td:nth-child(7)`).text(response.contact_no);
            $(`#gramRow${id} td:nth-child(8)`).text(response.gender);
            $(`#gramRow${id} td:nth-child(9)`).text(response.dob);
            $(`#gramRow${id} td:nth-child(10)`).text(response.age);
            $(`#gramRow${id} td:nth-child(11)`).text(response.land_area);

            // Hide modal
            $('#editGramModal').modal('hide');

            // Show success message
            Swal.fire({
                title: 'Success!',
                text: 'Profile updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Optional: Reload page if necessary
                    window.location.reload();
                }
            });
        },
        error: function (response) {
            // Handle validation errors
            var errors = response.responseJSON.errors || {};
            var errorMessage = 'An error occurred.\n\n';

            for (var field in errors) {
                errorMessage += `${field}: ${errors[field].join(', ')}\n`;
            }

            Swal.fire({
                title: 'Error!',
                text: errorMessage || 'Unknown error.',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        },
    });
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


       
    });
</script>















        <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the stored active tab from localStorage
        var activeTab = localStorage.getItem('activeTab');
        
        // If an active tab is stored, show it
        if (activeTab) {
            // Use the correct selector to find the tab link and show it
            var tabLink = document.querySelector('a[href="' + activeTab + '"]');
            if (tabLink) {
                var tab = new bootstrap.Tab(tabLink);
                tab.show();
            }
        }

        // Add event listener to store the active tab in localStorage when a tab is clicked
        document.querySelectorAll('a[data-bs-toggle="tab"]').forEach(function (tabLink) {
            tabLink.addEventListener('shown.bs.tab', function (e) {
                localStorage.setItem('activeTab', e.target.getAttribute('href'));
            });
        });
    });
</script>

@endsection
