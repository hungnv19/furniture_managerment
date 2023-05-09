@extends('client.layouts.client')
@section('content')
    <br>
    {{-- <div class="container">
        <div class="row gutters">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="account-settings">
                            <div class="user-profile">
                                <div class="user-avatar">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Maxwell Admin">
                                </div>
                                <h5 class="user-name">Yuki Hayashi</h5>
                                <h6 class="user-email">yuki@Maxwell.com</h6>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <h6 class="mb-2 text-primary">Personal Details</h6>
                            </div>
                            <div class=" col-12">
                                <div class="form-group">
                                    <label for="fullName"> Name</label>
                                    <input type="text" class="form-control" id="name" placeholder="Enter full name">
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="form-group">
                                    <label for="eMail">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Enter email ID">
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone"
                                        placeholder="Enter phone number">
                                </div>
                            </div>
                            <div class=" col-12">
                                <div class="form-group">
                                    <label for="Address">Address</label>
                                    <input type="text" class="form-control" id="Address" placeholder="Enter Address">
                                </div>
                            </div>
                        </div>

                        <div class="row gutters">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="text-right">
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-secondary">Cancel</button>
                                    <button type="button" id="submit" name="submit"
                                        class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <user-profile :data="{{ json_encode([
        'user' => $user,
        'urlBack' => route('home'),
        'urlUpdate' => route('profile-update'),
    ]) }}">
    </user-profile>
    <br>
@endsection
