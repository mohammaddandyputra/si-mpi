@extends('layouts.app')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3" ><strong>Data Gangguan Komponen</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            <a href="javascript:void(0)" class="btn btn-primary mb-2 text-white" id="tambah-data"><i class="fa fa-plus"></i> Tambah Data</a>
            <a href="{{ route('history-teras') }}" class="btn btn-danger mb-2 text-white"><i class="fa fa-eye"></i> History Gangguan Teras</a>
            <a href="{{ route('history-komponen') }}" class="btn btn-danger mb-2 text-white"><i class="fa fa-eye"></i> History Gangguan Komponen</a>
            
            <!--Datatable-->
            
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-gangguan" class="table table-striped table-bordered">
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
                                <th>Tanggal Gangguan</th>
                                <th>Teras</th>
                                <th>Komponen</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Tindakan</th>
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

<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-black text-center">
                <h5 class="modal-title text-secondary" id="modal-header"><strong> Perbaikan Komponen</strong></h5>
                <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="GangguanForm" name="GangguanForm" class="form-horizontal">
                @csrf
                    <input type="hidden" id="id" name="id" class="form-control">

                    <div class="form-group">
                        <label for="kode_komponen" class="col-form-label">Komponen :</label><br>
                        <select id="kode_komponen" name="kode_komponen" data-live-search="true" style="width:50%">
                            @foreach ($komponens as $data)
                                <option value="{{$data->kode_komponen}}">{{$data->nama_komponen}}</option>
                            @endforeach
                        </select><br>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Teras :</label><br>
                        <select id="id_teras" name="id_teras"  data-live-search="true" style="width:50%">
                            {{-- <option value="" disabled>--Pilih teras--</option> --}}
                            @foreach ($teras as $data)
                                <option value="{{$data->id}}">{{$data->nama_teras}}</option>
                            @endforeach
                        </select><br>
                    </div>

                    <div class="form-group">
                        <label for="tanggal_gangguan" class="col-form-label">Tanggal Gangguan :</label>
                        <input type="text" id="tanggal_gangguan" value="" name="tanggal_gangguan" class="form-control" value="" style="width:50%">
                    </div>
                    
                    <div class="form-group">
                        <label for="desc" class="col-form-label">Deskripsi :</label>
                        <textarea id="desc" name="desc" value="" class="form-control"></textarea>
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
        $('#tanggal_gangguan').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(function () {
        $('#kode_komponen').selectpicker();
        $('#id_teras').selectpicker();
    });
    
    $(function () {
        var table = $('#data-gangguan').DataTable({
            processing: true,
            serverSide: true,
            // ajax: {
            //     url: "{{ route('gangguan.index') }}",
            //     data: function (d) {
            //         d.status = $('#status').val();
            //     }
            // },
            ajax: "",
            columns: [
                {data: 'rownum',  orderable: false, searchable: false},
                {data: 'tanggal_gangguan'},
                {data: 'nama_teras' , name: 'teras.nama_teras', searchable: true},
                {data: 'nama_komponen', name:'komponens.nama_komponen'},
                {data: 'desc', name: 'desc'},
                {data: 'id_perbaikan', searchable: false, render: function (data) {
                    if(data == null){
                        return '<span class="badge badge-warning">' +'Belum dikerjakan'+'</span>';
                    }
                    else{
                        return '<span class="badge badge-primary">' +'Selesai'+'</span>'
                    }
                }},
                {data: 'tanggal_perbaikan', name:'perbaikans.tanggal_perbaikan', render: function (data) {
                    if(data == ''){
                        return '-';
                    }
                    else{
                        return data;
                    }
                }},
                {data: 'tindakan', name:'perbaikans.tindakan', render: function (data) {
                    if(data == ''){
                        return '-';
                    }
                    else{
                        return data;
                    }
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // $("#status").change(function(){
        //     table.draw();
        // });
        
        $('#tambah-data').click(function () {
            $('#FormKomponen').trigger("reset");
            $('#modal-header').html("Membuat Laporan Gangguan Baru");
            $('#ajaxModal').modal('show');
            $('#id').val('');
            $('#kode_komponen').selectpicker('val', '');
            $('#id_teras').selectpicker('val', '');
            $('#tanggal_gangguan').val('');
            $('#desc').val('');
        });

        $('body').on('click', '#edit', function () {
            var id = $(this).data('id');
            $.get("{{route('gangguan.index')}}" +'/' + id +'/edit', function (data) {
                $('#modal-header').html("Ubah Gangguan");
                $('#saveBtn').val("Simpan");
                $('#ajaxModal').modal('show');
                $('#id').val(data.id);
                $('#kode_komponen').selectpicker('val', data.kode_komponen);
                $('#id_teras').selectpicker('val', data.id_teras);
                $('#tanggal_gangguan').val(data.tanggal_gangguan);
                $('#desc').val(data.desc);
            })
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();

            $.ajax({
                data: $('#GangguanForm').serialize(),
                url: "{{ route('gangguan.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(data.error){
                        printErrorMsg(data.error);
                    }
                    else{
                        $('#GangguanForm').trigger("reset");
                        $('#ajaxModal').modal('hide');
                        table.draw();
                        success(data.success);
                    }
                }
            });
        });

        function printErrorMsg (msg) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: msg
            })
        }

        function success (msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 2500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            
            Toast.fire({
                icon: 'success',
                title: msg
            })
        }

        $('body').on('click', '#delete', function () {
            $.ajaxSetup({

                headers:{
                    'X_CSRF_TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            var id = $(this).data('id');
                confirm("Are You sure want to delete !");

            $.ajax({
                type: "DELETE",
                url: "{{ route('gangguan.index') }}"+'/'+id,
                data: {
                    "id": id,
                    "_token": "{{ csrf_token() }}"
                    
                },
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