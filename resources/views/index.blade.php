@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
<h4 class="fs-16 mb-1">Good Morning, {{ Auth::user()->name }}, </h4><p class ="text-muted mb-0" id="current-time" class="fs-14"></p>



                        </div>
                      
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Register To Gram</p>
                                </div>
                               
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                
    <select id="categoryDropdown" class="form-select mb-3">
        <option value="" disabled selected>Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->category_name }}">{{ $category->category_name }}</option>
        @endforeach
    </select>

    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
        <span id="categoryCount" class="text-primary">0</span>
    </h4>
                                    <a href="{{route('register-to-gram.index')}}" class="text-decoration-none text-muted">View Users</a>
                                </div>
                                
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Gram Bills</p>
                                </div>
                               
                            </div>
                            
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                    
   <div class="d-flex align-items-center flex-wrap">

    <select id="gramDropdown" class="form-select  mb-3">
        <option value="" disabled selected>Select Gram</option>
        @foreach($grams as $gram)
            <option value="{{ $gram->gram_name }}">{{ $gram->gram_name }}</option>
        @endforeach
    </select>

<!-- Pending Section -->
<div class="text-center mx-2">
  <h4 class="fs-22 fw-semibold ff-secondary mb-4">
        <span id="pendingCount" class="text-primary">0</span>
    </h4>
    <a href="{{route('gram-bills.index')}}" class="text-decoration-none text-muted">Pending</a>
</div>

<!-- Completed Section -->
<div class="text-center mx-2">
    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
        <span id="completeCount" class="text-success">0</span>
    </h4>
    <a href="{{route('gram-bills.index')}}" class="text-decoration-none text-muted">Completed</a>
</div>

<!-- Total Amount Section -->
<div class="text-center mx-2">
  <h4 class="fs-22 fw-semibold ff-secondary mb-4">
        <span id="totalAmount" class="text-danger">0</span>
    </h4>
    <a href="{{route('gram-bills.index')}}" class="text-decoration-none text-muted">Total Amount</a>
</div>


</div>


                            
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                 <div class="card card-animate">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1 overflow-hidden">
                <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                    Total Pending Gharpatti/Panipatti
                </p>
            </div>
        </div>

        <div class="d-flex align-items-end justify-content-between mt-4">
            <div class="d-flex">
                <!-- Pending Section -->
                <div class="text-center mx-2">
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                        <span id="pendingGharPattiCount" class="text-primary">0</span>
                    </h4>
                    <a href="javascript:void(0)" class="text-decoration-none text-muted" id="showGharPattiUsers">See Gharpatti User</a>
                </div>

                <!-- Completed Section -->
                <div class="text-center mx-2">
                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                        <span id="pendingPaniPattiCount" class="text-success">0</span>
                    </h4>
                    <a href="javascript:void(0)" class="text-decoration-none text-muted" id="showPanipattiUsers">See Panipatti User</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end card body -->
</div>

<!-- Modal for displaying users -->
<div class="modal fade" id="usersModal" tabindex="-1" aria-labelledby="usersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="usersModalLabel">Users List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="userList" class="list-group">
                    <!-- Users will be displayed here -->
                </ul>
            </div>
        </div>
    </div>
</div>

                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
    <div class="card-body">
    <div class="d-flex align-items-center">
        <div class="flex-grow-1 overflow-hidden">
            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                Total Gram Bill</p>
        </div>
    </div>

    <!-- Container for filters and bill count -->
    <div class="d-flex align-items-end justify-content-between mt-3">
        <!-- Dropdown for Gram Type (e.g., Gharpatti, Panipatti) -->
        <select class="form-select mb-2" id="billType" aria-label="Bill Type" style="width: auto;">
            <option value="" selected>Select Gram Type</option>
            @foreach($grams as $gram)
                <option value="{{ $gram->gram_name }}">{{ $gram->gram_name }}</option>
            @endforeach
        </select><br>

   
    </div>
     <div class="d-flex align-items-end justify-content-between mt-2">
         <!-- From Date Selector -->
         <input type="date" id="fromDate" class="form-control mb-2" placeholder="From Date" style="width: auto;">

        <!-- To Date Selector -->
        <input type="date" id="toDate" class="form-control mb-2" placeholder="To Date" style="width: auto;">
    </div>
    <!-- Display Total Gram Bill Count -->
    <div>
        <h4 class="fs-22 fw-semibold ff-secondary mb-4">
            <span id="totalGramBillCount" class="text-primary">0</span>
        </h4>
        <a href="{{ route('gram-bills.index') }}" class="text-decoration-none text-muted">
            See All Bills
        </a>
    </div>
</div>


                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->

</div>

<!-- Modal Structure -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Users List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="userList" class="list-unstyled">
                    <!-- User list will be populated here -->
                </ul>
            </div>
        </div>
    </div>
</div>


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    function updateCurrentTime() {
        const now = new Date();

        // Get date components
        const day = String(now.getDate()).padStart(2, '0'); // Two-digit day
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const month = monthNames[now.getMonth()]; // Month as name
        const year = now.getFullYear();

        // Get time components
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12 || 12; // Convert to 12-hour format

        // Format date and time
        const formattedDateTime = `${day} ${month} ${year} ${hours}:${minutes} ${ampm}`;

        // Display the formatted date and time
        document.getElementById('current-time').innerText = formattedDateTime;
    }

    // Update the time every minute
    setInterval(updateCurrentTime, 60000);

    // Initial call to display time immediately
    updateCurrentTime();
</script>

<script>
    document.getElementById('categoryDropdown').addEventListener('change', function() {
        const categoryId = this.value;

        // Make an AJAX request to fetch the count
        fetch('{{ route("get.category.count") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ category_id: categoryId })
        })
        .then(response => response.json())
        .then(data => {
            // Update the count in the span
            document.getElementById('categoryCount').textContent = data.count;
        })
        .catch(error => console.error('Error:', error));
    });
</script>
<script>
    $(document).ready(function() {
        $('#gramDropdown').change(function() {
            var selectedGram = $(this).val();  // Get the selected gram

            // Check if a gram is selected
            if (selectedGram) {
                $.ajax({
                    url: '{{ route("get.gram.details") }}',  // Use the route defined above
                    type: 'POST',
                    data: {
                        gram_name: selectedGram,
                        _token: '{{ csrf_token() }}'  // Include CSRF token
                    },
                    success: function(response) {
                        // Update the counts and total amount with the response data
                        $('#pendingCount').text(response.pendingCount);
                        $('#completeCount').text(response.completedCount);
                        $('#totalAmount').text(response.totalAmount);
                    },
                    error: function() {
                        alert('Error fetching data.');
                    }
                });
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        // Fetch counts for the current year
        $.ajax({
            url: '{{ route("get.ghar-panipatti.counts") }}',
            type: 'GET',
            success: function(response) {
                // Update the counts
                $('#pendingGharPattiCount').text(response.gharPattiNotRegisteredCount);
                $('#pendingPaniPattiCount').text(response.panipattiNotRegisteredCount);
            },
            error: function() {
                alert('Error fetching data.');
            }
        });

        // Fetch Gharpatti users and show in modal
        $('#showGharPattiUsers').click(function() {
            $.ajax({
                url: '{{ route("get.ghar-patti-users") }}',
                type: 'GET',
                success: function(response) {
                    var userList = '';
                    $.each(response, function(index, user) {
                        userList += '<li class="list-group-item">' + user.name + '</li>';
                    });
                    $('#userList').html(userList);
                    $('#usersModal').modal('show');
                },
                error: function() {
                    alert('Error fetching Gharpatti users.');
                }
            });
        });

        // Fetch Panipatti users and show in modal
        $('#showPanipattiUsers').click(function() {
            $.ajax({
                url: '{{ route("get.panipatti-users") }}',
                type: 'GET',
                success: function(response) {
                    var userList = '';
                    $.each(response, function(index, user) {
                        userList += '<li class="list-group-item">' + user.name + '</li>';
                    });
                    $('#userList').html(userList);
                    $('#usersModal').modal('show');
                },
                error: function() {
                    alert('Error fetching Panipatti users.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
    // Trigger AJAX on change of any filter (dropdown or date)
    $('#billType, #fromDate, #toDate').change(function() {
        var billType = $('#billType').val();
        var fromDate = $('#fromDate').val();
        var toDate = $('#toDate').val();

        // Make an AJAX call with the selected filters
        $.ajax({
            url: '{{ route("get.gram-bills.count") }}', // Define the route for fetching filtered data
            type: 'GET',
            data: {
                billType: billType,
                fromDate: fromDate,
                toDate: toDate
            },
            success: function(response) {
                // Update the displayed count based on the response
                $('#totalGramBillCount').text(response.totalGramBillCount);
            },
            error: function() {
                alert('Error fetching data.');
            }
        });
    });
});

</script>

@endsection
