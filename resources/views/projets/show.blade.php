@extends('layouts.app')
@section('titre', 'Détails du projet')
@section('breadcrumb')
<li class="breadcrumb-item main-form">
    <a>
        Projets
    </a>
</li>
@endsection

@section('main')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="clearfix"></div>
            <div class="card card-light">
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card-header text-center">Détails du projet</div>
                <div class="card-body">
                    @include('projets.fields_show')
                </div>
                <div class="card-footer row justify-content-center" style="float: right;">
                    <a href="javascript:history.back()" class="btn btn-primary ml-0 mb-5">
                        <span class="glyphicon glyphicon-circle-arrow-left"></span><i class="fa fa-arrow-left fa-fw"
                            aria-hidden="true"></i>&nbsp; Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    })
</script>
@endsection