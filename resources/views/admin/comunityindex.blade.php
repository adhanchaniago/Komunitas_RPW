@extends('template.app')
@section('content')
<br>
<div class="card col-md-6">
    <a class="btn btn-outline-dark" href="{{ route('community.create') }}">
        <span data-feather="plus-circle"></span>
        Tambah<span class="sr-only">(current)</span>
    </a>
</div><br>
<div id="success-massage">
    
</div>
<div class="table-responsive card">
    <table class="table" id="data-table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Type</th>
                <th scope="col">Follower</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
<div class="modal fade" id="ajaxModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="validation-errors">
                
            </div>
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="form" name="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="com_id" id="com_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama Komunitas" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-sm-2 control-label">Type</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="type" name="type" placeholder="Masukkan Tipe Komunitas" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div class="custom-file form-group">
                        <label for="banner" class="custom-file-label">Banner Komunitas</label>
                        <input type="file" class="custom-file-input {{$errors->first('banner') ? "is-invalid": ""}}" name="banner" id="banner">
                    </div>
                    <div class="col-sm-offset-2 col-sm-10 mt-3">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('sidebar')
<br>
<nav class="col-md-12 d-none d-md-block bg-light sidebar card">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('user.index') }}">
                    <span class="fas fa-user"></span>
                    Pengguna
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('community.index') }}">
                    <span class="fa fa-object-group"></span>
                    Komunitas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('posts.index') }}">
                    <span class="fas fa-sticky-note"></span>
                    Post
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reply.index') }}">
                    <span class="fas fa-comment"></span>
                    Reply
                </a>
            </li>
        </ul>
    </div>
</nav>
<br>
@endsection
@section('js')
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#data-table').DataTable({
        ajax: {
            url: "{{ route('community.index') }}",
            dataSrc: ''
        },
        columns: [
            {data: 'id'},
            {
                data: 'name',
                render: function(data) {
                    return '<a href="/community/'+data+'">'+data+'</a>'
                }
            },
            {data: 'type'},
            {data: 'followers'},
            {
                data: 'id',
                render: function(id) {
                    var btn = '<a href="javascript:void(0)" class="btn btn-primary mb-2 w-100 edit" data-id="'+id+'"><i class="fas fa-edit mr-2"></i>Edit</a>'+
                        '<a href="javascript:void(0)" class="btn btn-danger w-100 hapus" data-id="'+id+'"><i class="fas fa-trash mr-2"></i>Hapus</a>';
                    return btn;
                }
            }
        ]
    });

    $('body').on('click','.hapus', function () {
        var community = $(this).data("id");
        var x = confirm("Apakah anda yakin ingin menghapus data ini !");
        if (x) {
            $.ajax({
                type: "DELETE",
                url: '/admin/comunity/'+community+'/delete',
                success: function () {
                    table.ajax.reload();
                    $('#success-massage').html('<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">'+'<strong>Data berhasil dihapus</strong>'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span></button></div>');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    });

    $('body').on('click', '.edit', function () {
        var community = $(this).data("id");
        $.get('/admin/comunity/'+community+'/edit', function (data) {
            $('#modelHeading').html("Edit Komunitas");
            $('#saveBtn').val("edit-comunity");
            $('#ajaxModel').modal('show');
            $('#com_id').val(data.id);
            $('#name').val(data.name);
            $('#type').val(data.type);
            // $('#banner').val(data.banner);
        });
        // });
    });

    $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                data: $('#form').serialize(),
                url: '/admin/comunity/update',
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#form').trigger("reset");
                    $('#ajaxModel').modal('hide');
                    table.ajax.reload();
                    $('#success-massage').html('<div class="alert alert-success alert-dismissible fade show mt-2" role="alert">'+'<strong>Data berhasil diupdate</strong>'+
                        '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                        '<span aria-hidden="true">&times;</span></button></div>');
                },
                error: function (xhr) {
                    $('#validation-errors').html('');
                    $('#validation-errors').append('<div class="alert alert-danger alert-dismissible fade show"><ul id="err"></ul><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $.each(xhr.responseJSON.errors, function (key, value) {
                        $('#err').append('<li>'+value+'</li>');
                    })
                    console.log(xhr);
                }
            });
        });

});
</script>
@endsection