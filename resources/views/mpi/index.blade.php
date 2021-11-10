@extends('layouts.app')

@section('content')
<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <form enctype="multipart/form-data" action="{{route('mpi.index')}}" method="GET">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="form-group row">

                    <div class="col-sm-2">
                        <select id="filter_komponen" name="filter_komponen[]" multiple class="selectpicker form-control" data-live-search="true" title="Pilih komponen ....">
                            @foreach ($komponens as $data)
                                <option value="{{$data->kode_komponen}}">
                                    {{$data->nama_komponen}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2 ml-5">
                        <select id="filter_teras1" name="filter_teras1" class="selectpicker form-control" data-live-search="true" title="Pilih teras ....">
                            @foreach ($teras as $dataTeras)
                                <option value="{{$dataTeras->nama_teras}}">
                                    {{$dataTeras->nama_teras}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <h6 class="text-center mt-2 ml-4">s.d</h6>
                    
                    <div class="col-sm-2">
                        <select id="filter_teras2" name="filter_teras2" class="selectpicker form-control" data-live-search="true" title="Pilih teras ....">
                            @foreach ($teras as $dataTeras)
                                <option value="{{$dataTeras->nama_teras}}">
                                    {{$dataTeras->nama_teras}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-sm-1 ml-3">
                        <input type="submit" type="button" id="search" class="btn btn-primary" value="Cari">
                    </div>
                </div>
            </div>
        </div>
	</form>

    <div class="row mt-3">
        <div class="col-sm-12">

            <!--Datatable-->
            <div class="mt-1 p-3 button-container bg-white border shadow-sm">          
                <div class="table-responsive">
                    <table id="data-mpi" class="table table-striped table-bordered">
                        <div class="row">
                            <div class="col-sm-2">
                                <h5><strong>Table MPI</strong></h5>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Komponen</th>
                                <th>OCR</th>
                                <th>OCR1</th>
                                <th>SCR</th>
                                <th>ACR</th>
                                <th>freq</th>
                                <th>freq%</th>
                                <th>AFPF</th>
                                <th>MPI</th>
                                <th>Kategori</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!--/Datatable-->

            <div class="row mt-3">
                <div class="col-sm-12">
                    <div class="mt-1 mb-3 p-3 button-container bg-white shadow-sm border">
                        <h6 class="mb-2 text-center">Grafik MPI</h6>
                        <canvas class="mt-4" id="tes"  height="125px"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="ajaxModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark text-black text-center">
                <h5 class="modal-title text-secondary" id="modal-header"><strong> SCR</strong></h5>
                <button type="button" class="close pull-right" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="MpiForm" name="MpiForm" class="form-horizontal">
                @csrf
                    <input type="hidden" id="id" name="id" class="form-control">
                    
                    <div class="form-group">
                        <label for="teras" class="col-form-label">Teras :</label>
                        <input type="text" id="teras" value="" name="teras" class="form-control" value="" style="width:50%">
                    </div>
                    
                    <div class="form-group">
                        <label for="komponen" class="col-form-label">Komponen :</label>
                        <input type="text" id="komponen" value="" name="komponen" class="form-control" value="" style="width:50%">
                    </div>
                    
                    <div class="form-group">
                        <label for="oc" class="col-form-label">OC :</label>
                        <textarea id="oc" name="oc" value="" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="pt" class="col-form-label">PT :</label>
                        <textarea id="pt" name="pt" value="" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="sf" class="col-form-label">SF :</label>
                        <textarea id="sf" name="sf" value="" class="form-control"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="qc" class="col-form-label">QC :</label>
                        <textarea id="qc" name="qc" value="" class="form-control"></textarea>
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
        $('#komponen').selectpicker();
    });

    $(document).ready(function(){
        $('#search').click(function() {
            const komponen1 = $("#filter_komponen").val();
            const teras1 = $("#filter_teras1").val();
            const teras2 = $("#filter_teras2").val();
            
            if([komponen1] == ''){
                var msg = 'Komponen kosong!';
                printErrorMsg(msg);
                return false;
            }
            else if(teras1 == ''){
                var msg = 'Teras1 kosong!';
                printErrorMsg(msg);
                return false;
            }
            else if(teras2 == ''){
                var msg = 'Teras2 kosong!';
                printErrorMsg(msg);
                return false;
            }
        
        });

        function printErrorMsg (msg) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: msg
            })
        }
    });

    $(function () {
        $.ajax({
            url : '',
            method : 'GET',
            dataType : 'json',
            success : function(){
                $('#data-mpi').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '',
                    columns: [
                        {data: 'rownum', orderable: false, searchable: false},
                        {data: 'nama_komponen'},
                        {data: 'ocr'},
                        {data: 'ocr1'},
                        {data: 'scr'},
                        {data: 'acr'},
                        {data: 'freq'},
                        {data: 'freq%'},
                        {data: 'afpf'},
                        {data: 'mpi'},
                        {data: 'kategori'},
                    ]
                });
            },
            error : function(){
                $('#data-mpi').DataTable({
                    serverSide: false
                });
            }
        });

        
        $.ajax({
            url: '',
            method : 'GET',
            dataType : 'json',
            success : function(){

                const year = <?php echo $year; ?>;
                const user = <?php echo $user; ?>;

                const backgroundColor = 'rgba(255, 99, 132, 0.2)'
                const borderColor = 'rgba(255,99,132,1)'

                var canvas = document.getElementById('tes').getContext('2d');
                var myChart = new Chart(canvas, {
                    type: 'bar',
                    data: {
                        labels: year,
                        datasets: [{
                            label: 'Nilai MPI',
                            data: user,
                            backgroundColor: backgroundColor,
                            borderColor: borderColor,
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            },
            error : function(){
                var canvas = document.getElementById('tes').getContext('2d');
                var myChart = new Chart(canvas, {
                    type: 'bar',
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });
            }
        });

    });

    

</script>
@endsection