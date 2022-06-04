@extends('layout.base')
@section('title')
Dashboard
@endsection
@section('content')
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2 class="float-left">Data Daerah</h2>
            <button id="create" class="btn btn-primary btn-sm float-right"><i class="fa fa-plus"></i> Tambah</button>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatables" class="table table-striped table-bordered table-daerah" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%">No</th>
                                    <th>Daerah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.modal.daerah_modal')
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $('#datatables').DataTable({
        "language": {
            "emptyTable": "Belum ada data, silahkan tambahkan data baru!"
          },
        processing: true,
        serverSide: true,
        ajax: {
            url:  '/Admin/Daerah',
            type: 'GET'
        },
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
            },
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        order: [
            [0, 'desc']
        ]
    });

    $('#create').click(function () {
        $('#simpan').val("create-Item");
        $('#id').val('');
        $('#ItemForm').trigger("reset");
        $('#modelheader').html("Tambah Data Baru");
        $('#univModal').modal('show');
    });

    $('body').on('click', '.editItem', function () {
        var Item_id = $(this).data('id');
        $.get("/Admin/Daerah" + '/' + Item_id + '/edit', function (data) {
            $('#modelheader').html("Edit Data");
            $('#simpan').val("edit-user");
            $('#univModal').modal('show');
            $('#id').val(data.id);
            $('#name').val(data.name);
        })
    });

    $('#simpan').click(function (e) {
        e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
            data: $('#ItemForm').serialize(),
            url: "/Admin/Daerah",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#ItemForm').trigger("reset");
                $('#simpan').html("simpan");
                $('#univModal').modal('hide');
                var table = $('#datatables').DataTable();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Data berhasil di simpan !',
                    showConfirmButton: false,
                    timer: 1500
                });
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
                $('#simpan').html('Save Changes');
            }
        });
    });

    $('#batal').on('click',function(){
        location.reload();
    });

    $('body').on('click', '.deleteItem', function () {
        var Item_id = $(this).data("id");
        $.get("/Admin/Daerah" + '/' + Item_id + '/edit', function (data) {
            $('#deleteModal').modal('show');
            $('#dt').html(data.religionName)
            $('#deletebutton').attr('href', '/Admin/Religion/Destroy/'+data.id);
        });
    });

    
});
</script>
{{-- <script>
    $(function () {

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

var table = $('.table-daerah').DataTable({
  processing: true,
  serverSide: true,
  ajax: "/Admin/Daerah",
  columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'name', name: 'name'},
      {data: 'action', name: 'action', orderable: false, searchable: false},
  ]
});

$('#create').click(function () {
  $('#saveBtn').val("create-Customer");
  $('#id').val('');
  $('#CustomerForm').trigger("reset");
  $('#modelHeading').html("Create New Customer");
  $('#univ-modal').modal('show');
});

$('body').on('click', '.editCustomer', function () {
var Customer_id = $(this).data('id');
$.get("" +'/' + Customer_id +'/edit', function (data) {
    $('#modelHeading').html("Edit Customer");
    $('#saveBtn').val("edit-user");
    $('#ajaxModel').modal('show');
    $('#Customer_id').val(data.id);
    $('#name').val(data.name);
    $('#detail').val(data.detail);
})
});

$('#saveBtn').click(function (e) {
  e.preventDefault();
  $(this).html('Sending..');

  $.ajax({
    data: $('#CustomerForm').serialize(),
    url: "",
    type: "POST",
    dataType: 'json',
    success: function (data) {

        $('#CustomerForm').trigger("reset");
        $('#ajaxModel').modal('hide');
        table.draw();

    },
    error: function (data) {
        console.log('Error:', data);
        $('#saveBtn').html('Save Changes');
    }
});
});

$('body').on('click', '.deleteCustomer', function () {

  var Customer_id = $(this).data("id");
  confirm("Are You sure want to delete !");

  $.ajax({
      type: "DELETE",
      url: ""+'/'+Customer_id,
      success: function (data) {
          table.draw();
      },
      error: function (data) {
          console.log('Error:', data);
      }
  });
});

});
</script> --}}
@endsection
