<x-master-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12  mt-4">
                <h1 class="text-center">Prévision</h1>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="form-group">
                    <label for="structure_id">Structure</label>
                    <select class="form-control disabled" name="structure_id" id="structure_id">
                    @foreach ($structures as $structure )
                        <option {{ ($prevision->structure_id == $structure->id OR old('structure_id')==$structure->id) ? "selected" : ""}} value="{{ $structure->id }}">{{ $structure->nom_struct }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="commune_id">Commune</label>
                    <select class="form-control disabled" name="commune_id" id="commune_id">
                    @foreach ($communes as $commune )
                        <option {{ ($prevision->commune_id == $commune->id OR old('commune_id')==$commune->id) ? "selected" : ""}} value="{{ $commune->id }}">{{ $commune->nom_struct }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="sousIndicateur_id">Sous indicateur</label>
                    <select class="form-control disabled" name="sousIndicateur_id" id="sousindicateur_id">
                    @foreach ($sousIndicateurs as $sousIndicateur)
                        <option {{ ($prevision->sousIndicateur_id == $sousIndicateur->id OR old('sousIndicateur_id')==$sousIndicateur->id) ? "selected" : ""}} value="{{ $sousIndicateur->id }}">{{ $sousIndicateur->nom_struct }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="anneeExercice_id">Année d'exercice</label>
                    <select class="form-control disabled" name="anneeExercice_id" id="anneeExercice_id">
                    @foreach ($anneeExercices as $anneeExercice)
                        <option {{ ($prevision->anneeExercice_id == $anneeExercice->id OR old('anneeExercice_id')==$anneeExercice->id) ? "selected" : ""}} value="{{ $anneeExercice->id }}">{{ $anneeExercice->nom_struct }}</option>
                    @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="effectif_total_prevu">Effectif total prévu</label>
                    <input value= "{{ old('effectif_total_prevu') ?? $prevision->effectif_total_prevu}}" type="number" name="effectif_total_prevu" readonly>
                </div>

                <div class="form-group">
                    <label for="effectif_homme_prevu">Effectif homme prévu</label>
                    <input value= "{{ old('effectif_homme_prevu') ?? $prevision->effectif_homme_prevu}}" type="number" name="effectif_homme_prevu" readonly>
                </div>

                <div class="form-group">
                    <label for="effectif_femme_prevu">Effectif femme prévu</label>
                    <input value= "{{ old('effectif_femme_prevu') ?? $prevision->effectif_femme_prevu}}" type="number" name="effectif_femme_prevu" readonly>
                </div>

                <div class="form-group">
                    <label for="date_debut_prevu">Date debut prévu</label>
                    <input value= "{{ old('date_debut_prevu') ?? $prevision->date_debut_prevu}}" type="date" name="date_debut_prevu" readonly>
                </div>

                <div class="form-group">
                    <label for="date_fin_prevu">Date fin prévu</label>
                    <input value= "{{ old('date_fin_prevu') ?? $prevision->date_fin_prevu}}" type="date" name="date_fin_prevu" readonly>
                </div>

                <div class="form-group">
                    <label for="cout_prevu">Cout prévu</label>
                    <input value= "{{ old('cout_prevu') ?? $prevision->cout_prevu}}" type="number" name="cout_prevu" readonly>
                </div>

                <div class="form-group disabled">
                    <label for="valide_prevu">Valide prévu</label><br>
                    <select name="valide_prevu" id="valide_prevu">
                        <option selected value="false">Non</option>
                        <option value="true">Oui</option>
                    </select>
                </div>

                <div class="form-group disabled">
                    <label for="rejet_prevu">Rejet prévu</label><br>
                    <select name="rejet_prevu" id="rejet_prevu">
                        <option selected value="false">Non</option>
                        <option value="true">Oui</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="motif_prevu">Motif prévu</label>
                    <textarea class="form-control" name="motif_prevu" id="motif_prevu" rows="3" readonly>
                        {{ old('motif_prevu') ?? $prevision->motif_prevu }}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</x-master-layout>