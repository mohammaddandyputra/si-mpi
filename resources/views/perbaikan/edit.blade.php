@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    <div class="row mt-1">
        <div class="col-sm-12">
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                
                <form method="POST" action="{{ route('perbaikan.updateGangguan', [$gangguan->id]) }}" id="PerbaikanForm" class="form-horizontal mt-3 mb-4">
                @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-3">ID Gangguan</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="id_gangguan" value="{{$gangguan->id}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3">Teras</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$gangguan->teras->nama_teras}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3">Komponen</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{$gangguan->komponens->nama_komponen}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-3">Tanggal Gangguan</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" value="{{$gangguan->tanggal_gangguan}}" disabled/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-3">Deskripsi Gangguan</label>
                        <div class="col-sm-9">
                            <textarea rows="5" class="form-control" disabled>{{$gangguan->desc}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-3" for="tanggal_perbaikan-2">Tanggal Perbaikan</label>
                        <div class="col-xl-9">
                            <input type="text" class="form-control" value="{{$gangguan->perbaikans->tanggal_perbaikan}}" name="tanggal_perbaikan" id="tanggal_perbaikan"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-3" for="tindakan-3">Tindakan Perbaikan</label>
                        <div class="col-sm-9">
                            <textarea rows="5" class="form-control" name="tindakan" id="tindakan">{{$gangguan->perbaikans->tindakan}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" id="btn-cancel">Cancel</button>
                        <button type="button" id="saveBtn" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
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
    $('#tanggal_perbaikan').datepicker({
        format: 'yyyy-mm-dd'
    });

    $(function(){
        $('#btn-cancel').click(function(e){
            e.preventDefault();
            window.location.href='{{route("perbaikan.index")}}';
        });

        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: $('#PerbaikanForm').serialize(),
                url: "{{route('perbaikan.update', [$gangguan->id])}}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if(data.error){
                        error(data.error);
                    }
                    else{
                        success(data.success);
                    }
                }
            });
        });

        function error(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: msg
            })
        }

        function success (msg) {
            Swal.fire({
                icon: 'success',
                text: msg
            }).then(function() {
                window.location = "{{route('perbaikan.index')}}";
            })
        }

    });
</script>        
@endsection