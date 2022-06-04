$('#create').click(function () {
    $('#simpan').val("create-data");
    $('#id').val('');
    $('#form-input').trigger("reset");
    $('.modal-title').html("Tambah Data baru");
    $('#univ-modal').modal('show');
});

$('#univ-modal').on('hidden.bs.modal', function(e) {
    $(this).find('#form-input')[0].reset();
});


$('#saveBtn').click(function (e) {
    e.preventDefault();
    $(this).html('Sending..');

    $.ajax({
        data: $('#form-input').serialize(),
        url: "/Admin/Daerah",
        type: "POST",
        dataType: 'json',
        success: function (data) {
            $('#form-input').trigger("reset");
            $('#univ-modal').modal('hide');
            var table = $('#datatables').datatable();
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Success',
                showConfirmButton: false,
                timer: 1500
            });
            table.draw();
        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
    });
});

$('body').on('click', '.edit', function(){
    let dataId = $(this).data('id');
    $.get(base_url + '/letters/In/'+ dataId + '/edit', function (data) {
        $('#univ-modal').modal('show');
        $('#id').val(data.id);
        $('#index_number').val(data.index_number);
        $('#queue_number').val(data.queue_number);
        $('#address').val(data.address);
        $('#mail-in-date').val(formateDateUseDash(data.date));
        $('#subject').val(data.subject);
        $('#form-input').attr('action','/letters/In/update');
    })
});