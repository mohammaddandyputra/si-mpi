@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3" ><strong>History Gangguan Teras</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-teras" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Teras</th>
                                <th>Total Gangguan</th>
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
        var table = $('#data-teras').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'rownum'},
                {data: 'nama_teras'},
                {data: 'total_gangguan'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    
</script>        
@endsection