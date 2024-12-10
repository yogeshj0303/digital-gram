@extends('layouts.master')
@section('title')
    @lang('translation.basic-elements2')
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Gharpatti Panipatti</h4>
                </div>
                <!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('gharpatti-panipatti.update', $record->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- For edit/update -->
                            <div class="row gy-4">
                                <!-- State -->
<div class="col-md-4">
    <label for="state" class="form-label">State</label>
    <input type="text" name="state" id="state" class="form-control @error('state') is-invalid @enderror" value="{{ old('state', $record->state) }}" /readonly>
    @error('state')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="district" class="form-label">District</label>
    <input type="text" name="district" id="district" class="form-control @error('district') is-invalid @enderror" value="{{ old('district', $record->district) }}" /readonly>
    @error('district')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="taluka" class="form-label">Taluka</label>
    <input type="text" name="taluka" id="taluka-field" class="form-control @error('taluka') is-invalid @enderror" value="{{ old('taluka', $record->taluka) }}" /readonly>
    @error('taluka')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<div class="col-md-4">
    <label for="gram" class="form-label">Gram</label>
    <input type="text" name="gram" id="gram-field" class="form-control @error('gram') is-invalid @enderror" value="{{ old('gram', $record->gram) }}" /readonly>
    @error('gram')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

@php
    $user = DB::table('users')->where('id', $record->username)->first();
@endphp

<div class="col-md-4">
    <label for="username" class="form-label">User Name</label>
    <input type="text"  id="username" class="form-control" value="{{ old('username', $user ? $user->name : '') }}" readonly />
</div>

                                <!-- Type -->
                                <div class="col-md-4">
                                    <label for="type" class="form-label">Type</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="">--Select Type--</option>
                                        <option value="gharpatti" {{ old('type', $record->type) == 'gharpatti' ? 'selected' : '' }}>Gharpatti</option>
                                        <option value="panipatti" {{ old('type', $record->type) == 'panipatti' ? 'selected' : '' }}>Panipatti</option>
                                    </select>
                                </div>
    
                                <!-- Amount Type -->
                                <div class="col-md-4">
                                    <label for="amount_type" class="form-label">Amount Type</label>
                                    <input type="text" name="amount_type" class="form-control"
                                        value="{{ old('amount_type', $record->amount_type) }}" placeholder="Amount Type">
                                </div>
    
                                <!-- Paid Type -->
                                <div class="col-md-4">
                                    <label for="paid_type" class="form-label">Paid Type</label>
                                    <select name="paid_type" id="paid_type" class="form-control">
                                        <option value="cash" {{ old('paid_type', $record->paid_type) == 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="online" {{ old('paid_type', $record->paid_type) == 'online' ? 'selected' : '' }}>Online</option>
                                        <option value="rtgs" {{ old('paid_type', $record->paid_type) == 'rtgs' ? 'selected' : '' }}>RTGS</option>
                                        <option value="check" {{ old('paid_type', $record->paid_type) == 'check' ? 'selected' : '' }}>Check</option>
                                    </select>
                                </div>
    
                                <!-- Paid Amount -->
                                <div class="col-md-4">
                                    <label for="paid_amount" class="form-label">Paid Amount</label>
                                    <input type="number" name="paid_amount" class="form-control"
                                        value="{{ old('paid_amount', $record->paid_amount) }}" placeholder="Paid Amount">
                                </div>
    
                                <!-- Paid Date -->
                                <div class="col-md-4">
                                    <label for="paid_date" class="form-label">Paid Date</label>
                                    <input type="datetime-local" name="paid_date" class="form-control"
                                        value="{{ old('paid_date', $record->paid_date) }}">
                                </div>
    
                                <!-- Remaining Amount -->
                                <div class="col-md-4">
                                    <label for="remaining_amount" class="form-label">Remaining Amount</label>
                                    <input type="number" name="remaining_amount" class="form-control"
                                        value="{{ old('remaining_amount', $record->remaining_amount) }}" placeholder="Remaining Amount">
                                </div>
    
                                <!-- Send Bill -->
                                <div class="col-md-4">
                                    <label for="send_bill" class="form-label">Send Bill on WhatsApp</label>
                                    <div class="form-check">
                                        <input type="checkbox" name="send_bill" class="form-check-input" value="1"
                                            {{ old('send_bill', $record->send_bill) == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label" for="send_bill">Yes</label>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Submit Button -->
                            <div class="row mt-4">
                                <div class="col-md-12 d-flex justify-content-between">
                                    <a href="{{ route('gharpatti-panipatti.index') }}" class="btn btn-secondary">Back</a>
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

@endsection
