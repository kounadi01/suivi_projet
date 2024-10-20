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
            <h3 class="mt-auto text-center font-weight-bold" style="font-family: 'Adamina' ">Les détails de l'approvisionnement de {{$structure->nom_struct}}</h3>
        </div>
    </div>
</section>

<section class="defaut py-4" id="aide" style="min-height: 85vh;">
    <div class="container">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <table class="display text-sm data-table" id="reponse-table">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Catégorie</th>
                        <th>Libelle</th>
                        <th>Montant total</th>
                        <th>Montant local</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $i=>$produit)
                    <tr>
                        <td>{{$i+1}}</td>
                        <td>{{$produit->type}}</td>
                        <td>{{$produit->libelle}}</td>
                        <td style="text-align:center">{{number_format($produit->montant_total, 0, ',', ' ')}}</td>
                        <td style="text-align:center">{{number_format($produit->montant_local, 0, ',', ' ')}}</td>
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