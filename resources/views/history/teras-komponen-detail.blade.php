@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    
    <div class="mt-1 mb-1 button-container">
    <h6 class="mb-3">Data Gangguan Komponen</h6>
        <div class="card shadow-sm">
        
            <div class="card-body">
                
                <div class="form-group row">
                    <label class="control-label mt-2 col-sm-2">Kode Komponen</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="{{$teras->nama_teras}}" disabled/>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label mt-2 col-sm-2">Nama Komponen</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="{{$komponen->nama_komponen}}" disabled/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-sm-12">
            
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-gangguan" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Gangguan</th>
                                <th>Deskripsi Gangguan</th>
                                <th>Status</th>
                                <th>Tanggal Perbaikan</th>
                                <th>Deskripsi Perbaikan</th>
                                <th>TTR</th>
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

@endsection
        
@section('script')
<script type="text/javascript">

    $(function () {
        var table = $('#data-gangguan').DataTable({
            "scrollX": true,
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'rownum'},
                {data: 'tanggal_gangguan'},
                {data: 'desc', name: 'desc'},
                {data: 'id_perbaikan', render: function (data) {
                    if(data == null){
                        return '<span class="badge badge-warning">' +'Belum dikerjakan'+'</span>';
                    }
                    else{
                        return '<span class="badge badge-primary">' +'Selesai'+'</span>'
                    }
                }},
                {data: 'tanggal_perbaikan'},
                {data: 'tindakan'},
                {data: 'ttr'},
                // {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
        
    });
</script>        
@endsection