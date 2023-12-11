@extends('admin.layout.master')
@section('container')
@php
$id=auth()->id();
$admin=App\Models\User::find($id);
@endphp

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 mb-4 order-0">
                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                  <div class="card">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-7">
                        <div class="card-body">
                          <h5 class="card-title text-primary">Welcome to Admin panel , {{$admin->name}} 🎉</h5>
                          <p class="mb-4">
                            Check your new badge in your profile.
                          </p>
                        </div>
                      </div>
                      <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                          <img
                            src="{{asset('/admin/assets/img/illustrations/man-with-laptop-light.png')}}"
                            height="140"
                            alt="View Badge User"
                            data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png"
                          />
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                  </div>
                </div>
              </div>
           
            </div>
            <!-- / Content -->

       

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
    

  
  
 <!-- Vendors JS -->
 <script src="{{asset('/admin/assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>


@endsection