@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    
    <div class="mt-1 mb-1 button-container">
    <h6 class="mb-3">Data Gangguan Komponen</h6>
        <div class="card shadow-sm">
        
            <div class="card-body">
                <div class="form-group row">
                    <label class="control-label mt-2 col-sm-2">Nama Komponen</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" value="{{$komponen->nama_komponen}}" disabled/>
                    </div>
                    <label class="control-label mt-2 col-sm-1">TTF</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" value="" disabled/>
                    </div>
                    <label class="control-label mt-2 col-sm-1">TTR</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control" value="{{$ttr->total_gangguan}} Hari" disabled/>
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
                                <th>Teras</th>
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
                {data: 'teras'},
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
            ]
        });
        
    });
</script>        
@endsection