@extends('layouts.app')
@section('titre' , 'Rapports par province' )
@section('breadcrumb')
    <li class="breadcrumb-item main-form">
        <a>
            Rapports
        </a>
    </li>
@endsection

@section('main')
    <div class="content">
        <div class="card card-primary">
            <div class="card-header bg-light">

                <div class="row float-left" style="width: 400px;border:2px double blue;color: white">
                    <select class="form-control" name="province_id" id="id_province" onChange="getPrevision(this.value);" required  >
                        <option value="">Sélectionnez la province</option>
                        @foreach(\App\Models\Province::all() as $province )
                            <option style="" value="{{$province->id}}">{{$province->nom_province}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="code_progSpan" > </small>
                </div>
                <div class="row float-left" style="width: 200px;border:2px double blue;margin-left: 2%">
                    <select class="form-control" name="annee" id="annee" onChange="getPrevisionAnnee(this.value);" required  >
                        <option value="{{\App\Models\AnneeExercice::anneeEnCours()->annee_exercice}}">{{\App\Models\AnneeExercice::anneeEnCours()->annee_exercice}}</option>
                        @foreach(\App\Models\AnneeExercice::all() as $annee )
                            <option style="" value="{{$annee->annee_exercice}}">{{$annee->annee_exercice}}</option>
                        @endforeach
                    </select>
                    <small class="text-danger" id="code_progSpan" > </small>
                </div>
                <h1 class="row float-right">
                    <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">Exporter <i class="fa fa-share-square-o"></i></button>
                    <ul class="dropdown-menu">
                        <li><a href="#" onClick ="$('#rapports-table').tableExport({type:'excel',escape:'false'});" style="color: black"><img src="{{asset('images/icons/xls.png')}}" width="24"/> EXCEL</a></li>
                        <li><a href="#" onClick ="$('#rapports-table').tableExport({type:'doc',escape:'false'});" style="color: black"><img src="{{asset('images/icons/word.png')}}" width="24"/> WORD</a></li>
                    </ul>
                    <a href="{!! route('pdf-provinces') !!}"
                       data-url="{!! route('pdf-provinces') !!}"
                       id="provincePdf"
                       target="_blank" class="btn btn-primary float-right ml-4" >
                        <i class="fa fa-file-import"></i> Imprimer</a>
                    <a href="{!! route('pdf-provinces-g') !!}"
                       data-url="{!! route('pdf-provinces-g') !!}"
                       id="provincePdfg"
                       target="_blank" class="btn btn-primary float-right ml-4" >
                        <i class="fa fa-file-import"></i> Imprimer Tout</a>
                </h1>
            </div>
            <div class="card-body">
                @include('rapports.table')
            </div>
        </div>
    </div>
@endsection

@include('partials.main-modal', ['id' => 'createProg'])
@include('partials.main-modal', ['id' => 'showProg'])
@include('partials.main-modal', ['id' => 'editProg'])

@section('scripts')
    <script type ="text/javascript">
        function getPrevision(val) {
            var annee = document.getElementById('annee').value;
            $.ajax({
                type: "GET",
                url: "{{ route('rapports.filtre-provinces') }}",
                data:{id_province :val,annee: annee},
                success: function(data){
                    //$("#id_body").html(data);
                    $('#rapports-table').html(data);
                    //clientSideDataTable.destroy();
                    makeClientSideDataTable();
                }
            });
        }

        function getPrevisionAnnee(val) {
            var province = document.getElementById('id_province').value;
            $.ajax({
                type: "GET",
                url: "{{ route('rapports.filtre-provinces') }}",
                data:{id_province :province,annee: val},
                success: function(data){
                    //$("#id_body").html(data);
                    $('#rapports-table').html(data);
                    //clientSideDataTable.destroy();
                    makeClientSideDataTable();
                }
            });
        }

        $(document).on('click', '#provincePdf', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.get(url+'?idProvince='+document.getElementById('id_province').value+'&annee='+document.getElementById('annee').value)
                .done(function (data) {
                    document.location.href = url+'?idProvince='+document.getElementById('id_province').value+'&annee='+document.getElementById('annee').value;
                })
        });

        $(document).on('click', '#provincePdfg', function (e) {
            e.preventDefault();
            var url = $(this).attr('data-url');
            $.get(url+'?annee='+document.getElementById('annee').value)
                .done(function (data) {
                    document.location.href = url+'?annee='+document.getElementById('annee').value;
                })
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script type="text/javascript" src="{{asset('js/tableexport/tableExport.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tableexport/jquery.base64.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tableexport/html2canvas.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tableexport/jspdf/libs/sprintf.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tableexport/jspdf/jspdf.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/tableexport/jspdf/libs/base64.js')}}"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
@endsection
