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
<div style="margin-bottom:5px">
    <!-- <div class=" {!! $errors->has('type') ? 'has-error' : '' !!}" style="display: inline-block;width: 49%;">
        <label for="type" style="font-weight: bold;">Type</label>
        <select class="" name="type" id="type" onChange="getOption(this.value);">
            <option value="tout" @if ($type=="tout" ) selected @endif>Tout</option>
            <option value="service" @if ($type=="service" ) selected @endif>Service</option>
            <option value="bien" @if ($type=="bien" ) selected @endif>Bien</option>
        </select>
        {!! $errors->first('type', '<small class="help-block">:message</small>') !!}
    </div> -->

    <!-- <div style="float: right;margin-right: 5px;">
        <label for="reference" style="font-weight: bold;">Réference</label>
        <input type="text" id="reference" value="" name="reference" disabled>
    </div> -->
</div>


<div class="card card-info card-tabs">
    <div class="card-header p-0 pt-1">
        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">

            <li class="nav-item">
                <a class="nav-link  active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#oui" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">
                    Les produits dans l'arreté
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-one-home-tab" data-toggle="pill" href="#non" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">
                    Les produits hors arreté
                </a>
            </li>

        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-one-tabContent">

            <div class="tab-pane fade show echo active" id="oui" role="tabpanel" aria-labelledby="oui-tab">

                <div class="card-body table-responsive p-0" style="height: 550px;">

                    <table id="tableEditable" class="display text-sm data-table">
                        <thead>
                            <tr>
                                <th hidden>Id</th>
                                <th>N°</th>
                                <th>Produits</th>
                                <th>Taux min. (%)</th>
                                <th>Montant total</th>
                                <th>Montant local</th>
                                <!-- <th>Total</th> -->
                                <th>Action</th>
                                <th hidden>ID Prod.</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($options as $index=>$produit)
                            <tr>
                                <td contenteditable="false" hidden>{{$produit->id}}</td>
                                <td contenteditable="false">{{$index +1}}</td>
                                <td contenteditable="false">{{$produit->libelle}}</td>
                                <td contenteditable="false">{{\App\Models\ListeProduit::getPourcentage($ae, $produit->produit_id, $phase)}}</td>
                                <td contenteditable="true">
                                    @if (\App\Models\Reponse::getReponse($produit->produit_id, $reponse_id, 'montant_total') != "")
                                    {{number_format(\App\Models\Reponse::getReponse($produit->produit_id, $reponse_id, 'montant_total'), 0, ',', ' ')}}
                                    @endif

                                </td>
                                <td contenteditable="false">
                                    @if (\App\Models\Reponse::getReponse($produit->produit_id, $reponse_id, 'montant_local') != "")
                                    {{number_format(\App\Models\Reponse::getReponse($produit->produit_id, $reponse_id, 'montant_local'), 0, ',', ' ')}}
                                    @endif

                                </td>
                                <!-- <td contenteditable="true"></td> -->
                                <td>
                                    <button class="btn btn-danger" onclick="supprimerLigne(this)">Supprimer</button>
                                </td>
                                <td contenteditable="false" hidden>{{$produit->produit_id}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>

            <div class="tab-pane fade show echo active" id="non" role="tabpanel" aria-labelledby="non-tab">

                <div class="card-body table-responsive p-0" style="height: 550px;">

                    <table id="tableEditable1" class="display text-sm data-table">
                        <thead>
                            <tr>
                                <td hidden>Id</td>
                                <td>N°</td>
                                <td>Produits</td>
                                <td>Taux min. (%)</td>
                                <td>Montant total</td>
                                <td>Montant local</td>
                                <td>Action</td>
                                <td hidden>ID Prod.</td>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($autresOptions as $index =>$produit)

                            <tr>
                                <td contenteditable="false" hidden>{{$produit->id}}</td>
                                <td contenteditable="false">{{$options->count() + $index +2}}</td>
                                <td contenteditable="false">{{$produit->libelle}}</td>
                                <td contenteditable="false">0</td>
                                <td contenteditable="true">
                                    @if (\App\Models\Reponse::getAutreReponse($produit->id, $reponse_id, 'montant_total') != "")
                                    {{number_format(\App\Models\Reponse::getAutreReponse($produit->id, $reponse_id, 'montant_total'), 0, ',', ' ')}}
                                    @endif
                                </td>
                                <td contenteditable="false">0</td>
                                <!-- <td contenteditable="true"></td> -->
                                <td>
                                    <button class="btn btn-danger" onclick="supprimerLigne(this)">Supprimer</button>
                                </td>
                                <td contenteditable="false" hidden>{{$produit->id}}</td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- /.card -->
</div>


<!-- <button class="btn btn-primary" onclick="getOption('null');">Ajouter une ligne</button> -->

<button class="btn btn-success" onclick="sauvegarderDonnees()">Sauvegarder les données</button>