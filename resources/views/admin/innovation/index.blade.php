@extends('admin.layout.master')
@section('container')

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
            <div style="display: flex;align-items: baseline;flex-direction: row;justify-content: space-between;">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{ __('Admin') }} /</span> {{ __('Innovation') }} </h4>
              @can('innovation-create')
              <a class="btn btn-success" href="{{ route('admin.innovation.create') }}"> {{ __('Create') }}  </a>
              @endcan
          </div>
              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">{{ __('Innovation') }} </h5>
                
                <div class="table-responsive text-nowrap">
                  <table  id="dataTable"  class="table table-striped " style="width:100%">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>{{ __('Name') }} </th>
                        <th>{{ __('Action') }}</th>
                      </tr>
                    </thead>
                    <tbody >
                    </tbody>
                  </table>
                </div>
              </div>
              <!--/ Basic Bootstrap Table -->

              <hr class="my-5" />
            </div>
            <!-- / Content -->

      

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    
    

    @section('js')
    <script src="{{ asset('app/assets/js/vendor/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/buttons.html5.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/buttons.flash.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/buttons.print.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('app/assets/js/vendor/dataTables.select.min.js') }}"></script>

    <script type="text/javascript">
    $(function () {
          var table = $('#dataTable').DataTable({
            paging: true,
        lengthChange : true,
        pageLength : 10,
        searching: true,
        recordsFiltered : 10,
        ordering: true,
              ajax: "{{ route('admin.innovation.index') }}",
              columns: [
                {data: 'id', name: 'id'},
                  {data: 'name', name: 'name'},
                  {data: 'action', name: 'action'},
              ]
          });
        });
</script>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
<script>
 $(document).on('click','.delete-confirm',function(e){
          
            event.preventDefault();
              const url = $(this).attr('href');
              swal({
                  title: 'Silmək istədiyinə əminsən?',
                  text: 'Data həmişəlik silinəcək!',
                  icon: 'warning',
                  buttons: ["Cancel", "Yes!"],
              }).then(function(value) {
                  if (value) {
                      window.location.href = url;
                  }
              });
        });

</script>


    @endsection



@endsection