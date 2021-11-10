@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">
    
    <div class="row mt-1">
        <div class="col-sm-12">
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                
                <form method="POST" action="{{ route('scr.store') }}">
                @csrf
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">Komponen</label>
                        <div class="col-sm-10">
                            <select id="kode_komponen" name="kode_komponen" class="selectpicker" data-live-search="true">
                                <option value="" disabled selected>Pilih komponen...</option>
                                @foreach ($komponens as $data)
                                    <option value="{{$data->kode_komponen}}">{{$data->nama_komponen}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">SC</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sc" id="sc">
                                <option value="" disabled selected>-- Safety Class --</option>
                                <option value="3">A</option>
                                <option value="2">B</option>
                                <option value="1">C</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">QC</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="qc" id="qc" pla>
                                <option value="" disabled selected>-- Quality Class --</option>
                                <option value="3">Kelas 1 (3)</option>
                                <option value="2">Kelas 2 (2)</option>
                                <option value="1">Kelas 3 (1)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">OC</label>
                        <div class="col-sm-10">
                            <input type="text" name="oc" id="oc" class="form-control" value="" placeholder="Masukkan nilai OC (Operational Cost)"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">PT</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" name="pt" id="pt" class="form-control" value="" placeholder="Masukkan nilai PT (Proses Throughput)"/>
                                <div class="input-group-append">
                                    <span class="input-group-text">hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" id="btn-cancel">Cancel</button>
                        <button class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
        
@section('script')
<script type="text/javascript">
    $(function () {
        $('#kode_komponen').selectpicker();
    });

    $('#btn-cancel').click(function(e){
        e.preventDefault();
        window.location.href='{{route('scr.index')}}';
    });
</script>        
@endsection