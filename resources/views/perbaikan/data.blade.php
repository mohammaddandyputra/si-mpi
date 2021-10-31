@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    
    <h5 class="mb-3" ><strong>Data Gangguan Komponen</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
        
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-perbaikan" class="table table-striped table-bordered">
                        <thead>
                            <div class="row col-sm-7">
                                <h6 class="mt-2">Filter By :</h6>
                                <div class="ml-2">
                                    <select id="status" name="status" class="form-control" style="width: 150px">
                                        <option value="">--All status--</option>
                                        <option value="SELESAI">SELESAI</option>
                                        <option value="TIDAK">BELUM SELESAI</option>
                                    </select>
                                </div>
                            </div>
                        
                            <tr>
                                <th>#</th>
                                <th>Teras</th>
                                <th>Komponen</th>
                                <th>Tanggal Gangguan</th>
                                <th>Deskripsi Gangguan</th>
                                <th>Status</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Tindakan Perbaikan</th>
                                <th>Action</th>
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

@include('sweetalert::alert')

@endsection
        
@section('script')
<script type="text/javascript">    

    $(function(){

        var table = $('#data-perbaikan').DataTable({
            
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('perbaikan.index') }}",
                data: function (d) {
                    d.status = $('#status').val();
                }
            },
            columns: [
                {data: 'rownum'},
                {data: 'nama_teras'},
                {data: 'nama_komponen'},
                {data: 'tanggal_gangguan'},
                {data: 'desc'},
                {data: 'status', render: function (data) {
                    if(data == 'SELESAI'){
                        return '<span class="badge badge-primary">' +'Selesai'+'</span>';
                    }
                    else{
                        return '<span class="badge badge-warning">' +'Belum dikerjakan'+'</span>'
                    }
                }},
                {data: 'tanggal_perbaikan'},
                {data: 'tindakan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        $("#status").change(function(){
            table.draw();
        });

        $('#tambah-data').click(function () {
            $('#saveBtn').val("Simpan");
            $('#id').val('');
            $('#PerbaikanForm').trigger("reset");
            $('#modal-header').html("Membuat Perbaikan Baru");
            $('#ajaxModal').modal('show');
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
                data: $('#PerbaikanForm').serialize(),
                url: "{{ route('perbaikan.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {

                    $('#PerbaikanForm').trigger("reset");
                    $('#ajaxModal').modal('hide');
                    table.draw();

                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }
            });
        });

        // $('body').on('click', '#delete', function () {

        //     var id = $(this).data("id");
        //         confirm("Are You sure want to delete !");

        //     $.ajax({
        //         type: "DELETE",
        //         url: ""+'/'+id,
        //         success: function (data) {
        //             table.draw();
        //         },
        //         error: function (data) {
        //             console.log('Error:', data);
        //         }
        //     });
        // });

    });
</script>        
@endsection