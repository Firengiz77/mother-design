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
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Account Settings') }} /</span> {{ __('Account') }}</h4>

              <div class="row">
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">{{ __('Profile Details') }}</h5>
                    <!-- Account -->
                    <div class="card-body">
                    @if(session()->has('message'))
                      <div class="alert alert-success">
                          {{ session()->get('message') }}
                      </div>
                  @endif

                    <form enctype="multipart/form-data" id="formAccountSettings" method="POST"  action="{{route('admin.update_image')}}">
                   @csrf
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <img
                          src="{{  (!empty($admin->image)? url('upload/admin_images/'.$admin->image):asset('/admin/assets/img/avatars/1.png')  )}}"
                          alt="user-avatar"
                          class="d-block rounded"
                          height="100"
                          width="100"
                          id="uploadedAvatar"
                        />
                        <div class="button-wrapper">
                          <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">{{ __('Upload new photo') }}</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              class="account-file-input"
                              hidden
                              name="image"
                              accept="image/png,image/jpeg,image/svg,image/jpg"
                            />
                          </label>
                          <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4 mt-2 mt-2">
                            <i class="bx bx-reset d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">{{ __('Reset') }}</span>
                          </button>

                          <p class="text-muted mb-0">{{ __('Allowed') }} JPG, GIF, JPEG, SVG or PNG. Max size of 150K</p>
                        </div>
                      </div>
                       </form>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                      <form  id="formAccountSettings" method="POST" action="{{route('admin.update')}}">
                      @csrf 
                      <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="firstName" class="form-label">{{ __('Name') }}</label>
                            <input
                              class="form-control"
                              type="text"
                              id="firstName"
                              name="name"
                              value="{{ $admin->name}}"
                              placeholder="{{ $admin->name }}"
                              autofocus
                            />
                          </div>

                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input
                              class="form-control"
                              type="text"
                              id="email"
                              name="email"
                              value="{{ $admin->email }}"
                              placeholder="{{ $admin->email }}"
                            />
                          </div>
                       
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">{{ __('Save changes') }}</button>
                          <button type="reset" class="btn btn-outline-secondary">{{ __('Cancel') }}</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                  <div class="card">
                    <h5 class="card-header">{{ __('Change Password') }}</h5>

                    <div class="card-body">
                      <form id="formAccountSettings" method="POST" action="{{route('admin.admin_password')}}">
                      @csrf
                      <div class="row">

                          <div class="mb-3 form-password-toggle">
                           <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('Old Password') }}</label>
                          </div>
                          <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="old_password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                <div class="mb-3 form-password-toggle">
                           <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('New Password') }}</label>
                          </div>
                          <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>

                           <div class="mb-3 form-password-toggle">
                           <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">{{ __('Confirm New Password') }}</label>
                          </div>
                          <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="confirm_password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                       
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">{{ __('Save changes') }}</button>
                        </div>
                      </form>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->


            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->


@endsection