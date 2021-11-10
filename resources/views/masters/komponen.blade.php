@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3" ><strong>Data Master Komponen</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            <a href="javascript:void(0)" class="btn btn-primary mb-2 text-white" id="tambah-data"><i class="fa fa-plus"></i> Tambah Data</a>
            
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-komponen" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Komponen</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/Datatable-->

        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-black text-center">
                <h5 class="modal-title text-secondary" id="modal-header"></h5>
                <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="FormKomponen" name="FormKomponen" class="form-horizontal class="bg-white">
                @csrf
                    <input type="hidden" id="kode_komponen" name="kode_komponen" class="form-control">

                    <div class="form-group">
                        <label for="nama_komponen">Nama komponen :</label>
                        <input class="form-control" type="text" id="nama_komponen" name="nama_komponen"/>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="saveBtn" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

@include('sweetalert::alert')
@endsection
        
@section('script')
<script type="text/javascript">
    
    $(function () {
        var table = $('#data-komponen').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'rownum', orderable: false, searchable: false},
                {data: 'nama_komponen'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $('#tambah-data').click(function () {
            $('#saveBtn').val("Simpan");
            $('#kode_komponen').val('');
            $('#FormKomponen').trigger("reset");
            $('#modal-header').html("Membuat Komponen Baru");
            $('#ajaxModal').modal('show');
        });

        $('body').on('click', '#edit', function () {
            var kode_komponen = $(this).data('id');

            $.get("{{route('komponen.index')}}" +'/' + kode_komponen +'/edit', function (data) {
                $('#modal-header').html("Ubah Komponen");
                $('#saveBtn').val("Simpan");
                $('#ajaxModal').modal('show');
                $('#kode_komponen').val(data.kode_komponen);
                $('#nama_komponen').val(data.nama_komponen);
            })
        });

        $('#saveBtn').click(function () {
            event.preventDefault();

            $.ajax({
                data: $('#FormKomponen').serialize(),
                url: "",
                type: "POST",
                dataType: 'json',
                success: function(res){
                    if(res.error){
                        printErrorMsg(res.error);
                    }else{
                        $('#FormKomponen').trigger("reset");
                        $('#ajaxModal').modal('hide');
                        table.draw();
                        success(res.success);
                    }
                }
            });
        });

        $('body').on('click', '#delete', function () {
            $.ajaxSetup({

                headers:{
                    'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var kode_komponen = $(this).data("id");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('komponen.index') }}"+'/'+kode_komponen,
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function (data) {
                                table.draw();
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Data berhasil dihapus',
                                    showConfirmButton: false,
                                    timer: 1500
                                })
                            }
                        });
                    }
                })
            }); 

        });
</script>        
@endsection