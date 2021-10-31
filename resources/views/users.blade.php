@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3" ><strong>Data User</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            <a href="javascript:void(0)" class="btn btn-primary mb-2 text-white" id="tambah-data"><i class="fa fa-plus"></i> Add User</a>
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-user" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/Datatable-->

        </div>
    </div>

    <!--Footer-->
    <div class="row mt-5 mb-4 footer">
        <div class="col-sm-8">
            <span>&copy; All rights reserved 2019 designed by <a class="text-info" href="#">A-Fusion</a></span>
        </div>
        <div class="col-sm-4 text-right">
            <a href="#" class="ml-2">Contact Us</a>
            <a href="#" class="ml-2">Support</a>
        </div>
    </div>
    <!--Footer-->

</div>

<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-black text-center">
                <h5 class="modal-title text-secondary" id="modal-header"><strong> Add User</strong></h5>
                <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="UserForm" name="UserForm" class="form-horizontal">
                @csrf
                    <input type="hidden" id="id" name="id" class="form-control">
                    <div class="form-group">
                        <label for="name" class="col-form-label">Name :</label>
                        <input type="text" id="name" name="name" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-form-label">Email :</label>
                        <input type="text" id="email" name="email" value="" class="form-control">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="saveBtn" class="btn btn-primary" value="create">Simpan</button>
            </div>
        </div>
    </div>
</div>
@endsection
        
@section('script')
<script type="text/javascript">
    $(function () {
        var table = $('#data-user').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'email', name: 'email', render: function (data) {
                    return '<span class="badge badge-warning">' +data+'</span>';}
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#tambah-data').click(function () {
            $('#saveBtn').val("Simpan");
            $('#id').val('');
            $('#UserForm').trigger("reset");
            $('#modal-header').html("Membuat User Baru");
            $('#ajaxModal').modal('show');
        });

        $('body').on('click', '#edit', function () {
            var id = $(this).data('id');
            $.get("{{route('users.index')}}" +'/' + id +'/edit', function (data) {
                $('#modal-header').html("Ubah User");
                $('#saveBtn').val("Simpan");
                $('#ajaxModal').modal('show');
                $('#id').val(data.id);
                $('#name').val(data.name);
                $('#email').val(data.email);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
                data: $('#UserForm').serialize(),
                url: "{{ route('users.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#UserForm').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    table.draw();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        $('body').on('click', '#delete', function () {

            var id = $(this).data("id");
                confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: ""+'/'+id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });

    });
</script>        
@endsection