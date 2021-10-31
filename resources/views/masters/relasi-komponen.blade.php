@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <h5 class="mb-3" ><strong>Relasi Komponen</strong></h5>
                
    <div class="row mt-3">
        <div class="col-sm-12">
            
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-komponen-teras" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Komponen</th>
                                <th>Relasi</th>
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

@endsection
        
@section('script')
<script type="text/javascript">

    $(function () {
        var table = $('#data-komponen-teras').DataTable({
            processing: true,
            serverSide: true,
            ajax: "",
            columns: [
                {data: 'nama_komponen'},
                {data: 'relasi'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });
    });
    
</script>        
@endsection