@extends('admin.layout.master')

@section('container')

<link rel="stylesheet" href="{{ asset('/admin/assets/css/choise.css')}}">

  <!-- Content wrapper -->
  <div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Admin') }} /</span> {{ __('Work Attribute') }}</h4>

      <!-- Basic Layout & Basic with Icons -->
      <div class="row">

        <!-- Basic with Icons -->
        <div class="col-lg-12">
          <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between" style="display: flex;align-items: baseline;flex-direction: row;justify-content: space-between;">
              <h5 class="mb-0">{{ __('Create') }}</h5>
            

            </div>
            <div class="card-body">
              @if(session()->has('message'))
              <div class="alert alert-success">
                  {{ session()->get('message') }}
              </div>
          @endif


          @if($errors->any())

          @foreach($errors->all() as $error)
        <div class="alert alert-danger" role="alert" > {{$error}} </div>
          @endforeach

          @endif

          <form enctype="multipart/form-data" id="formAccountSettings" method="POST" action="{{ route('admin.workAttribute.store',$work_id) }}">
            @csrf
             <div class="d-flex align-items-start align-items-sm-center gap-4">
                 <div class="container">

              <div class="row">
              <div class="mb-3 col-md-6">
                    <label for="type" class="form-label"> {{ __('Type') }} 1:</label>
                    <select name="type_1" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1">Şəkil/Gif</option>
                      <option value="2">Video</option>
                    </select>
                  </div>


                 <div class="col-md-6 mb-3 mt-1">
                      <label>{{ __('File') }} 1:</label>
                        <input type="file" class="form-control" name="file_1" 
                         >
                       @error('image')
                                    <span class="text-danger" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                 
                 </div>
                 




                 <div class="mb-3 col-md-6 ">
                    <label for="type" class="form-label"> {{ __('Type') }} 2:</label>
                    <select name="type_2" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1">Şəkil/Gif</option>
                      <option value="2">Video</option>
                    </select>
                  </div>


                 <div class="col-md-6 mb-3 mt-1">
                      <label>{{ __('File') }} 1:</label>
                        <input type="file" class="form-control" name="file_2" 
                        >
                       @error('image')
                                    <span class="text-danger" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                      
                 </div>





                 <div class="mb-3 col-md-6 ">
                    <label for="type" class="form-label"> {{ __('Type') }} 3:</label>
                    <select name="type_3" id="" class="form-control">
                    <option value="0">Seçin</option>
                      <option value="1">Şəkil/Gif</option>
                      <option value="2">Video</option>
                    </select>
                  </div>


                 <div class="col-md-6 mb-3 mt-1">
                      <label>{{ __('File') }} 1:</label>
                        <input type="file" class="form-control" name="file_3" 
                         >
                       @error('image')
                                    <span class="text-danger" role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                         
                 </div>



              </div>

             
               
        



            

                
                   <button type="submit" class="btn btn-outline-secondary account-image-reset mb-4 mt-2">
                     <i class="bx bx-reset d-block d-sm-none"></i>
                     <span class="d-none d-sm-block">{{ __('Create') }}</span>
                   </button>

                   
                 </div>
               </div>
                </form>

    
            </div>
          </div>
        </div>


      </div>
    </div>
    <!-- / Content -->



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" ></script>
    <script src="{{ asset('/admin/vendors/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/admin/assets/js/cketditor.js') }}"></script>
    <script src="{{ asset('/admin/js/choise.js')}} "></script>

  


@endsection
