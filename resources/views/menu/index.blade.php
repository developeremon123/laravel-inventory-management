@extends('layouts.app')

@push('styles')
  {{-- datatable button css link --}}
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
  {{-- datatable responsive css link --}}
  <link rel="stylesheet" type="text/css"
      href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  {{-- datatable jquery css link --}}
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
@endpush
@section('title')
    {{ $page_title }}
@endsection
@section('content')
  <div class="dt-content">
    <!-- Grid -->
    <div class="row">
        <div class="col-xl-12">
            <ol class="breadcrumb bg-white">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                <li class="active breadcrumb-item">{{ $sub_title }}</li>
            </ol>
        </div>
      <!-- Grid Item -->
      <div class="col-xl-12">

        <!-- Entry Header -->
        <div class="dt-entry__header">

          <!-- Entry Heading -->
          <div class="dt-entry__heading">
            <h2 class="dt-page__title mb-0 text-primary"><i class="{{ $page_icon }}"></i> {{ $sub_title }}</h2>
          </div>
          <!-- /entry heading -->

            <button class="btn btn-primary btn-sm" onclick="showFormModal('Add New Menu','Save')">
                <i class="fa-solid fa-square-plus"></i> Add New
            </button>
        </div>
        <!-- /entry header -->

        <!-- Card -->
        <div class="dt-card">

          <!-- Card Body -->
          <div class="dt-card__body">

            <!-- Tables -->
            <table id="dataTable" class="table table-striped table-bordered table-hover">
                <thead class="bg-primary">
                    <tr>
                        <th>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="select_all"
                                    onchange="select_all()">
                                <label class="form-check-label" for="select_all">
                                </label>
                            </div>
                        </th>
                        <th>SL</th>
                        <th>Menu Name</th>
                        <th>Deletable</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            <!-- /tables -->

          </div>
          <!-- /card body -->

        </div>
        <!-- /card -->

      </div>
      <!-- /grid item -->

    </div>
    <!-- /grid -->

  </div>
  @include('menu.modal')
  @push('scripts')
    {{-- <script src="{{ asset('assets/js/custom.js') }}"></script> --}}
    {{-- datatable jquery script link --}}
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    {{-- datatable responsive script link --}}
    <script type="text/javascript" charset="utf8"
      src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    {{-- datatable buttons script links --}}
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>

    <script>
        let table;
        // server side datatable show information with ajax request
        $(document).ready(function(){
            table = $('#dataTable').DataTable({
                "processing": true, //Features control the processing indicator
                "serverSide": true, //Features control datatable server side processing mode
                "order": [], //initial no order
                "responsive": true, // make table responsive in mobile devices
                "bInfo": true, // To show the total number of data
                "bFilter": false, // for default default search box show/hide 
                "lengthMenu": [
                    [5, 10, 25, 50, 100, 1000, 10000, -1],
                    [5, 10, 25, 50, 100, 1000, 10000, "All"],
                ],
                "pageLength": 5,
                "language": {
                    processing: '<i class="fa-solid fa-spinner fa-spin fa-3x fa-fw text-primary"></i>',
                    emptyTable: '<strong class="text-danger">No Data Found</strong>',
                    infoEmpty: '',
                    zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                },
                "ajax": {
                    "url": "{{ route('menu.datatable.data') }}",
                    "type": "POST",
                    "data": function(data) {
                        data._token = _token;
                    },
                },
                "columnDefs": [{
                    'targets': [0, 4],
                    'orderable': false,
                    "className": "text-center",
                }, {
                    "targets": [1, 3],
                    "className": "text-center",
                }],
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6' <'float-right'B>>>" +
                    "<'row'<'col-sm-12 col-md-12'tr>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>", // Add B to the dom option for buttons
                "buttons": [
                    {
                        'extend': 'colvis',"className": "btn bg-primary text-white", 'text':'Column'
                    },
                    {
                        "extend": 'print',
                        "className": "btn bg-primary text-white",
                        "title": "Menu List",
                        "orientation": "landscape",
                        "pageSize": "A4",
                        "exportOptions": {
                            columns: function(index, data, node) {
                                return table.column(index).visible();
                            }
                        },
                        customize: function(win) {
                            $(win.document.body).addClass('bg-white');
                        }
                    },
                    {
                        "extend": 'csv',
                        "className": "btn bg-primary text-white",
                        "title": "Menu List",
                        "filename": "menu-list",
                        "exportOptions": {
                            columns: function(index, data, node) {
                                return table.column(index).visible();
                            }
                        }
                    },
                    {
                        "extend": 'excel',
                        "className": "btn bg-primary text-white",
                        "title": "Menu List",
                        "filename": "menu-list",
                        "exportOptions": {
                            columns: function(index, data, node) {
                                return table.column(index).visible();
                            }
                        }
                    },
                    {
                        "extend": 'pdf',
                        "className": "btn bg-primary text-white",
                        "title": "Menu List",
                        "filename": "menu-list",
                        "orientation": "landscape",
                        "pageSize": "A4",
                        "exportOptions": {
                            columns: [1, 2, 3]
                        },
                    },
                    {
                        "className": "btn bg-danger text-white delete_btn d-none",
                        'text': 'Delete',
                        action:function(e, dt, node, config){
                            multi_delete();
                        }
                    },
                ],
            });
            // btn-filter for custom search
            $('#btn-filter').click(function() {
                table.ajax.reload();
            });
            // btn-reset for custom search
            $('#btn-reset').click(function() {
                $('#form-filter')[0].reset();
                table.ajax.reload();
            });
        });
        // global store funtion with image using ajax, jquery
        $(document).on('click', '#save_btn', function() {
            let form = document.getElementById('store_or_update_form');
            let formData = new FormData(form);
            let url = "{{ route('menu.store.or.update') }}";
            let id = $('#update_id').val();
            let method;
            if (id) {
                method = 'update';
            } else {
                method = 'add';
            }
            store_or_update_data(table, method, url, formData);
        });
        // edit data catch with ajax 
        $(document).on('click', '.edit_data', function() {
            let id = $(this).data('id');
            $("#store_or_update_form .select").val("").trigger("change");
            if (id) {
                $.ajax({
                    url: "{{ route('menu.edit') }}",
                    type: "POST",
                    data: { id: id, _token: _token},
                    dataType: "JSON",
                    success: function(data) {
                        $("#store_or_update_form #update_id").val(data.data.id);
                        $("#store_or_update_form #menu_name").val(data.data.menu_name);
                        $("#store_or_update_form #deletable").val(data.data.deletable).trigger('change');

                        $('#store_or_update_modal').modal({
                            keyboard: false,
                            backdrop: 'static'
                        }).modal('show');
                        $('#store_or_update_modal .modal-title').html(
                            '<i class="fa-solid fa-pen-to-square"></i> <span>Edit ' + data.data.menu_name + 
                            '</span>');
                        $('#store_or_update_modal #save_btn').text('Update');
                    },
                    error: function(xhr, ajaxOption, thrownError) {
                        console.log(thrownError + '\r\ n' + xhr.statusText + '\r\ n' +
                            xhr.responseText);
                    }
                });
            }
        });
        // catch id for delete data
        $(document).on('click', '.delete_data', function() {
            let id   = $(this).data('id');
            let url  = "{{ route('menu.delete') }}";
            let row  = table.row($(this).parent('tr'));
            let name = $(this).data('name');
            delete_data(id, url, table, row, name);
        });

        function multi_delete(){
            let ids = [];
            let rows;
            $('.select_data:checked').each(function() {
                ids.push($(this).val());
                rows = table.rows($('.select_data:checked').parents('tr'));
            });
            if (ids.length == 0) {
                Swal.fire({
                    type: 'error',
                    title: 'Error',
                    text: 'Please checked at least one row of table!',
                });
            } else {
                let url = "{{ route('menu.bulk.delete') }}";
                bulk_delete(ids, table, url, rows);
            }
        }
    </script>
  @endpush
@endsection