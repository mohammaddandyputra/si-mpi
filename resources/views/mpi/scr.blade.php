@extends('layouts.app')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <h5 class="mb-3" ><strong>SCR Komponen</strong></h5>
    <a href="{{ route('scr.create') }}" class="btn btn-primary mb-2 text-white" id="tambah-data"><i class="fa fa-plus"></i> Tambah Data</a>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            
            <!--Datatable-->
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-scr" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Komponen</th>
                                <th>SC</th>
                                <th>SC1</th>
                                <th>QC</th>
                                <th>SF</th>
                                <th>PT</th>
                                <th>PT1</th>
                                <th>OC</th>
                                <th>OC1</th>
                                <th>SCR</th>
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

@include('sweetalert::alert')
@endsection
        
@section('script')
<script type="text/javascript">
    
    $(function () {
        var table = $('#data-scr').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'rownum'},
                {data: 'nama_komponen', name:'komponens.nama_komponen'},
                {data: 'sc', render: function (data) {
                    if(data === 3){
                        return 'A';
                    }
                    else if(data === 2){
                        return 'B';
                    }
                    else if(data === 1){
                        return 'C';
                    }
                    else{
                        return '-';
                    }
                }},
                {data: 'sc1', render: function (data) {
                    if(data !== null){
                        return data;
                    }
                    else{
                        return '-';
                    }
                }},
                {data: 'qc1', render: function (data) {
                    if(data !== null){
                        return data;
                    }
                    else{
                        return '-';
                    }
                }},
                {data: 'sf'},
                {data: 'pt1'},
                {data: 'pt', render: function (data) {
                    if(data == null){
                        return '-';
                    }
                    else if(data == 0){
                        return '1';
                    }
                    else if(data >= 1 && data <= 7){
                        return '2';
                    }
                    else if(data > 7 && data <= 15){
                        return '3';
                    }
                    else if(data > 15 && data <= 30){
                        return '4';
                    }
                    else if(data > 30){
                        return '5';
                    }
                }},
                {data: 'oc1'},
                {data: 'oc', render: function (data) {
                    if(data == null){
                        return '-';
                    }
                    else if(data > 100000000 && data <= 200000000){
                        return '5';
                    }
                    else if(data > 50000000 && data <= 100000000){
                        return '4';
                    }
                    else if(data > 10000000 && data <= 50000000){
                        return '3';
                    }
                    else if(data >= 1000000 && data <= 10000000){
                        return '2';
                    }
                    else if(data < 1000000){
                        return '1';
                    }
                }},
                {data: 'scr'},
                {data: 'action'},
            ]
        });

    });
</script>        
@endsection