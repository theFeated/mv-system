@extends('staff.views.layouts.app')

@section('title', '')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <h3 class="mb-0 mt-sm-3 mt-5">Profile</h3>
        <div>
            <a href="{{ route('dashboard') }}" class="btn btn-primary mt-sm-3 mt-5">Back</a>
        </div>
    </div>
    <hr>
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    @if(Session::has('error'))
        <div class="alert alert-danger" role="alert">
            {{ Session::get('error') }}
        </div>
    @endif
    <form method="POST" action="{{ route('profile.save') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body text-center">
                        @if(auth()->user()->profile_image)
                            <img src="{{ asset('profile_images/' . auth()->user()->profile_image) }}" class="card-img-top img-fluid rounded-circle profile-image" alt="Profile Image" style="width: 200px; height: 200px;">
                        @else
                            <img src="{{ asset('path/to/default/image.jpg') }}" class="card-img-top img-fluid rounded-circle profile-image" alt="Default Profile Image" style="width: 200px; height: 200px;">
                        @endif
                        <div class="mb-3 mt-sm-3 mt-3 d-flex mr-0 ml-1">
                            <div class="mt-3 mr-4">
                                <label for="profile_image" class="btn btn-primary edit-image-btn">Change</label>
                                <input type="file" id="profile_image" name="profile_image" class="form-control-file d-none">
                            </div>
                            <div class="mt-3">
                                <button id="btn" class="btn btn-primary profile-button" type="submit">Save Profile</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-2" onclick="$('#researchForm').show(); $('#monitoringsForm, #externalFundsForm, #roleResearchAssignedForm').hide();">User Info</button>
                    <button type="button" class="btn btn-outline-primary mb-2 mb-md-0 mr-md-2" onclick="$('#roleResearchAssignedForm').show(); $('#monitoringsForm, #externalFundsForm, #researchForm').hide();">Change Password</button>
                </div>
            </div>
                <div class="card">
                    <div class="card-body">
                        <div id="researchForm">
                            <h4 class="mb-3 mt-sm-3 mt-3">User Info</h4>
                            <div class="form-group">
                                <label class="labels">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your name" value="{{ auth()->user()->name }}">
                            </div>
                            <div class="form-group">
                                <label class="labels">Phone</label>
                                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" value="{{ auth()->user()->phone }}">
                            </div>
                            <div class="form-group">
                                <label class="labels">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ auth()->user()->email }}" placeholder="Email">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div id="roleResearchAssignedForm" style="display: none;">
                            <h4 class="mb-3 mt-sm-3 mt-3">Change Password</h4>
                            <div class="form-group">
                                <label class="labels">Old Password</label>
                                <input type="password" name="old_password" class="form-control" placeholder="Enter your old password">
                            </div>
                            <div class="form-group">
                                <label class="labels">New Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter your new password">
                            </div>
                            <div class="form-group mb-0">
                                <label class="labels">Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your new password">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection
