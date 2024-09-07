
@extends('layouts.app')

@section('content')
        <!-- Navbar -->
            <!-- Start Here  -->
            <div class="col-md-8 post-content" id="second" data-aos="fade-up" style="background: #f7f7f7;">
      
                <!-- ======= Single Post Content ======= -->
                <div class="mb-5 h1 text-muted">Person Profile</div>
                @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>          
                @endif
                <div class="tab">
                    <button id="defaultOpen" class="tablinks" onclick="openCity(event, 'profile')">Profile</button>
                    <button class="tablinks" onclick="openCity(event, 'edit')">Edit Profile</button>
                </div>
                <div id="profile" class="tabcontent">
                    
                    <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <img src="{{ asset('avatar/avatar-1577909_640.png') }}" width="100%" alt="Maxwell Admin">
                                    </div>
                                    <h5 class="user-name">{{ $user->name }}</h5>
                                    <h6 class="user-email">{{ $user->email }}</h6>
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
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" value="{{ $user->telegram->dob ?? '' }}" class="form-control" placeholder="Enter no dob" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>PHONE</label>
                                        <input type="text" value="{{ $user->telegram->phone ?? '' }}" class="form-control" placeholder="Enter full name" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>CITY</label>
                                        <input type="text" value="{{ $user->telegram->city ?? '' }}" class="form-control" placeholder="Enter full name" disabled>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                    <div class="form-group">
                                        <label>STATE</label>
                                        <input type="text" value="{{ $user->telegram->state ?? '' }}" class="form-control" placeholder="Enter full name" disabled>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mt-3 mb-2 text-primary">Documents</h6>
                                </div>
                                
                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12" id="admin">
                                    <style>
                                        .me{
                                            display: flex;
                                            flex-direction: row;
                                            height: 74px;
                                            width: 26vw;
                                            justify-content: space-between;
                                        }
                                        a{
                                            text-decoration: none;
                                        }
                                    </style>
                                    @foreach ( $docs as $doc )
                                    
                                    <div class="d-flex">
                                            <a href ="{{ asset('userfiles/'.$doc->file) }}" attributes-list download >
                                            <div class="card d-flex me p-2 bg-light">
                                                
                                                    <img src="{{ asset('uploads/pdf-svgrepo-com.svg') }}" width="20%" alt="Avatar">
                                               
                                                {{-- <img src="{{ asset('avatar/avatar-1577909_640.png') }}" class="rounded-circle" height="45" alt="Black and White Portrait of a Man" loading="lazy"/> --}}
                                                <div class="text-muted">
                                                  <h4><b>{{ $doc->file }}</b></h4> 
                                                  <p>Download your attachment </p> 
                                                </div>
                                            </div>
                                            </a>
                                            <div>
                                                <a href="{{ url('delete/doc/'.$doc->id) }}" class="btn btn-danger"><i class='far fa-trash-alt'></i></a
                                                {{-- <a href="{{ url('admin/delete-user/'.$doc->id) }}" class="btn btn-danger"><i class='far fa-trash-alt'></i></a> --}}
                                            </div>
                                    </div>
                                    @endforeach
                                </div>        
                            </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                <div id="edit" class="tabcontent">
                    
                    <div class="row gutters">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <img src="{{ asset('avatar/avatar-1577909_640.png') }}" width="100%" alt="Maxwell Admin">
                                    </div>
                                    <h5 class="user-name">{{ $user->name }}</h5>
                                    <h6 class="user-email">{{ $user->email }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <form action="store" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-2 text-primary">Personal Details</h6>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <input type="date" value="{{ $user->telegram->dob}}" name="dob" class="form-control" id="phone" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" value="{{ $user->telegram->phone ?? '' }}" name="phone" class="form-control" id="phone" placeholder="Enter phone number">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="ciTy">City</label>
                                            <input type="name" value="{{ $user->telegram->city ?? '' }}" name="city" class="form-control" id="ciTy" placeholder="Enter City">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="sTate">State</label>
                                            <input type="text" value="{{ $user->telegram->state ?? '' }}" name="state" class="form-control" id="sTate" placeholder="Enter State">
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="form-group">
                                            <label for="sTate">Document</label>
                                            <input type="file"  name="docs" class="form-control" id="docs">
                                        </div>
                                    </div>
                                </div>
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="text-right">
                                            <button type="submit" id="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
                <script>
                    function openCity(evt, cityName) {
                      var i, tabcontent, tablinks;
                      tabcontent = document.getElementsByClassName("tabcontent");
                      for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                      }
                      tablinks = document.getElementsByClassName("tablinks");
                      for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                      }
                      document.getElementById(cityName).style.display = "block";
                      evt.currentTarget.className += " active";
                    }
                    
                    // Get the element with id="defaultOpen" and click on it
                    document.getElementById("defaultOpen").click();
                    </script>
              </div>
          </div>
        </div>
            
    </section>
    @endsection    