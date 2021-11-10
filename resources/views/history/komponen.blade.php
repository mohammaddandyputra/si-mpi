@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3" ><strong>Data Gangguan Komponen</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-komponen" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Total Gangguan</th>
                                {{-- <th>TTF</th> --}}
                                <th>TTR</th>
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

@endsection
        
@section('script')
<script type="text/javascript">

    $(function () {
        var table = $('#data-komponen').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'rownum'},
                {data: 'nama_komponen'},
                {data: 'total_gangguan'},
                // {data: 'ttf'},
                {data: 'ttr', render: function (data) {
                    if(data == '-'){
                        return '-';
                    }
                    else{
                        return data + ' hari';
                    }
                }},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    
</script>        
@endsection