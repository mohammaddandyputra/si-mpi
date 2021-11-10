@extends('layouts.app')

@section('content')

<!--Content right-->
<div class="col-sm-9 col-xs-12 content pt-3 pl-0">

    <div class="row mt-1">
        <div class="col-sm-12">
            <div class="mt-1 mb-3 p-3 button-container bg-white border shadow-sm">
                
                <form method="POST" action="{{route('scr.update', [$scr->id])}}">
                @csrf
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">Komponen</label>
                        <div class="col-sm-10">
                            <select id="kode_komponen" name="kode_komponen" class="selectpicker" data-live-search="true">
                                <option value="">Pilih komponen</option>
                                    @foreach ($komponens as $komponen)
                                        <option value="{{$komponen->kode_komponen}}" {{$komponen->kode_komponen == $scr->kode_komponen ? 'selected' : ''}}>{{$komponen->nama_komponen}}</option>
                                    @endforeach
                                
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">SC</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="sc" id="sc">
                                <option {{$scr->sc == '' ? 'selected' : ''}} value="">--Select--</option>
                                <option {{$scr->sc == '3' ? 'selected' : ''}} value="3">A</option>
                                <option {{$scr->sc == '2' ? 'selected' : ''}} value="2">B</option>
                                <option {{$scr->sc == '1' ? 'selected' : ''}} value="1">C</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">QC</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="qc" id="qc">
                                <option {{$scr->qc == '' ? 'selected' : ''}} value="">--Select--</option>
                                <option {{$scr->qc == '3' ? 'selected' : ''}} value="3">Kelas 1</option>
                                <option {{$scr->qc == '2' ? 'selected' : ''}} value="2">Kelas 2</option>
                                <option {{$scr->qc == '1' ? 'selected' : ''}} value="1">Kelas 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">OC</label>
                        <div class="col-sm-10">
                            <input type="text" name="oc" id="oc" class="form-control" value="{{$scr->oc}}" placeholder="Masukkan nilai aspek pembiayaan"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label mt-2 col-sm-2">PT</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <input type="text" name="pt" id="pt" class="form-control" value="{{$scr->pt}}" placeholder="Masukkan nilai aspek sistem"/>
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