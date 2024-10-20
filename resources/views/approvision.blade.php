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
            <h3 class="mt-auto text-center font-weight-bold" style="font-family: 'Adamina' ">Plan d'approvisionnement du secteur minier pour l'année {{$annee}}</h3>
        </div>
    </div>
</section>

<section class="defaut " id="aide">
    <div class="container">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{number_format($prevision->montant_total, 0, ',', ' ')}}</h3>

                            <p>Montant total prévu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <div class="row justify-content-md-center">
                        </div>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#exampleModalCenter2" title="Cliquer pour en savoir d'avantage">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{number_format($prevision->montant_local, 0, ',', ' ')}}<sup style="font-size: 20px"></sup></h3>

                            <p>Montant local prévu</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer" data-toggle="modal" data-target="#exampleModalCenter1" title="Cliquer pour en savoir d'avantage">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{number_format($prevision->nombre_produit, 0, ',', ' ')}}</h3>

                            <p>Nombre total des produits/Services</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" data-toggle="modal" data-target="#exampleModalCenter" class="small-box-footer">En savoir plus <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- ./col -->
            </div>
        </div>
    </div>
</section>

<section class="defaut" id="aide">
    <div class="container-fluid">
        <div class="col-md-12">
            <h3 class="mt-auto text-center font-weight-bold" style="font-family: 'Adamina' ">La répartition par structure</h3>
        </div>
    </div>
</section>

<section class="defaut py-4" id="aide" style="min-height: 60vh;">
    <div class="container" >
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <table class="display text-sm data-table" id="reponse-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Catégorie</th>
                        <th>Denomination</th>
                        <th>Nombre</th>
                        <th>Montant total</th>
                        <th>Montant local</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i=>$structure)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$structure->type_struct}}</td>
                        <td>{{$structure->nom_struct}}</td>
                        <td style="text-align:center">{{number_format($structure->nombre_produit, 0, ',', ' ')}}</td>
                        <td style="text-align:center">{{number_format($structure->montant_total, 0, ',', ' ')}}</td>
                        <td style="text-align:center">{{number_format($structure->montant_local, 0, ',', ' ')}}</td>
                        <td>
                            <a href="{!! route('details', [$structure->reponse_id,'option'=>'prevision']) !!}" target="_blank id=" showList" class="btn btn-info data-tooltip" data-tooltip="Voir la liste">
                                <i class="fas fa-eye"></i> Voir details
                            </a>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</section>



@endsection

@section('scripts')

<script>

</script>
@endsection