@extends('layouts.master')
@section('title')
    @lang('translation.update-user')
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit User</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row gy-4">
                                <!-- Row 1 -->
                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-control select2 @error('state') is-invalid @enderror" id="state" name="state">
                                        <option value="">Select State</option>
                                        @foreach($statesData['states'] as $state)
                                            <option value="{{ $state['state'] }}" {{ $user->state === $state['state'] ? 'selected' : '' }}>
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
                                        <option value="{{ $user->district }}">{{ $user->district }}</option>
                                    </select>
                                    @error('district')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="taluka" class="form-label">Taluka</label>
                                    <select id="taluka-field" name="taluka" class="form-control select2">
                                        <option value="{{ $user->taluka }}">{{ $user->taluka }}</option>
                                    </select>
                                    @error('taluka')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                  <div class="col-md-4">
                                    <label for="gram" class="form-label">Gram</label>
                                    <select name="gram" id="gram-field"
                                        class="form-control select2 @error('gram') is-invalid @enderror">
                                        <option value="">Select Gram</option>
                                       
                                    </select>
                                    @error('gram')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
    
                                
                                
                                <!-- Additional Fields -->
                                <div class="col-md-4">
                                    <label for="user_name" class="form-label">User Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="contact_no" class="form-label">Contact No</label>
                                    <input type="text" class="form-control @error('contact_no') is-invalid @enderror" id="contact_no" name="contact_no" value="{{ $user->contact_no }}">
                                    @error('contact_no')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Row 3 -->
                                <div class="col-md-4">
                                    <label for="gate_no" class="form-label">Gate Number</label>
                                    <input type="text" class="form-control @error('gate_no') is-invalid @enderror" id="gate_no" name="gate_no"
                                           placeholder="Gate Number" value="{{ old('gate_no' , $user->gate_no ) }}">
                                    @error('gate_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                             
                                <div class="col-md-4">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control  @error('gender') is-invalid @enderror" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                        <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                  <div class="col-md-4">
                                    <label for="dob" class="form-label">Date Of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror" id="dob" name="dob" value="{{ old('dob' , $user->dob) }}">
                                    @error('dob')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                               <div class="col-md-4">
    <label for="age" class="form-label">Age</label>
    <input type="number" 
           class="form-control @error('age') is-invalid @enderror" 
           id="age" 
           name="age" 
           placeholder="Enter Age" 
           value="{{ old('age', $user->age) }}">
    @error('age')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="land_area" class="form-label">Land Area</label>
    <input type="text" 
           class="form-control @error('land_area') is-invalid @enderror" 
           id="land_area" 
           name="land_area" 
           placeholder="Enter Land Area" 
           value="{{ old('land_area', $user->land_area) }}">
    @error('land_area')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="farm_area" class="form-label">Farm Area</label>
    <input type="text" 
           class="form-control @error('farm_area') is-invalid @enderror" 
           id="farm_area" 
           name="farm_area" 
           placeholder="Enter Farm Area" 
           value="{{ old('farm_area', $user->farm_area) }}">
    @error('farm_area')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="gharpatti_annual" class="form-label">Gharpatti Annual</label>
    <input type="number" 
           class="form-control @error('gharpatti_annual') is-invalid @enderror" 
           id="gharpatti_annual" 
           name="gharpatti_annual" 
           value="{{ old('gharpatti_annual', $user->gharpatti_annual) }}">
    @error('gharpatti_annual')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="home_type" class="form-label">Home Type</label>
    <input type="text" 
           class="form-control @error('home_type') is-invalid @enderror" 
           id="home_type" 
           name="home_type" 
           placeholder="Enter Home Type" 
           value="{{ old('home_type', $user->home_type) }}">
    @error('home_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="panipatti_annual" class="form-label">Panipatti Annual</label>
    <input type="number" 
           class="form-control @error('panipatti_annual') is-invalid @enderror" 
           id="panipatti_annual" 
           name="panipatti_annual" 
           value="{{ old('panipatti_annual', $user->panipatti_annual) }}">
    @error('panipatti_annual')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="user_type" class="form-label">User Type</label>
    <select class="form-control @error('user_type') is-invalid @enderror" id="user_type" name="user_type">
        <option value="">Select User Type</option>
        <option value="Gram_Sevak" {{ old('user_type', $user->user_type) == 'Gram_Sevak' ? 'selected' : '' }}>Gram Sevak</option>
        <option value="Clark" {{ old('user_type', $user->user_type) == 'Clark' ? 'selected' : '' }}>Clark</option>
        <option value="Sarpanch" {{ old('user_type', $user->user_type) == 'Sarpanch' ? 'selected' : '' }}>Sarpanch</option>
        <option value="Sadsy" {{ old('user_type', $user->user_type) == 'Sadsy' ? 'selected' : '' }}>Sadsy</option>
        <option value="Public" {{ old('user_type', $user->user_type) == 'Public' ? 'selected' : '' }}>Public</option>
    </select>
    @error('user_type')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

                                
                                
                                <div class="col-md-4">
                                    <label for="profile_pic" class="form-label">Profile Photo</label>
                                    <input type="file" class="form-control @error('profile_pic') is-invalid @enderror" id="profile_pic" name="profile_pic">
                                    @if ($user->profile_pic)
                                        <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile Photo" width="50">
                                    @endif
                                    @error('profile_pic')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                                <div class="col-md-6 text-end">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
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
                $('#district').val('{{ $user->district }}').trigger('change');
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
                    $('#taluka-field').val('{{ $user->taluka }}').trigger('change');
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
                    $('#gram-field').val('{{ $user->gram }}').trigger('change'); // Pre-select value for gram
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
