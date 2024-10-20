@extends('layouts.footer')
@extends('layouts.master')
@extends('layouts.header')
@section('contenu')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }
</style>

<section class="defaut" id="aide">
    <div class="container-fluid">
        <div class="col-md-12">
            <h6 class="mt-auto text-center font-weight-bold" style="font-family: 'Adamina' ">BIENVENUE SUR LA PLATEFORME DU CONTENU LOCAL DU BURKINA FASO</h6>
        </div>
    </div>
</section>

<section class="defaut " id="aide">
    <div class="">
        <div class="">
            <!-- Small boxes (Stat box) -->
            <div class="row">
            <!-- <img src="{{asset('images/back1.jpeg')}}" alt="" style="width:100%"> -->
            <img src="{{asset('uploads/photo')}}/{{$photo_max->photo}}" alt="">
            
            </div>
        </div>
    </div>
</section>




@endsection

@section('scripts')

<script>

</script>
@endsection