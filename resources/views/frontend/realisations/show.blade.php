@csrf

    <div class="form-group">
        <label for="prevision_id">Prévision</label>
        <select class="form-control disabled" name="prevision_id" id="prevision_id">
        @foreach ($previsions as $prevision )
            <option {{ ($realisation->prevision_id == $prevision->id OR old('prevision_id')==$prevision->id) ? "selected" : ""}} value="{{ $prevision->id }}">{{ $prevision->nom_struct }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="effectif_total_realise">Effectif total réalisé</label>
        <input value= "{{ old('effectif_total_realise') ?? $realisation->effectif_total_realise}}" type="number" name="effectif_total_realise" id="" readonly>
    </div>

    <div class="form-group">
        <label for="effectif_homme_realise">Effectif homme réalisé</label>
        <input value= "{{ old('effectif_homme_realise') ?? $realisation->effectif_homme_realise}}" type="number" name="effectif_homme_realise" id="" readonly>
    </div>

    <div class="form-group">
        <label for="effectif_femme_realise">Effectif femme réalisé</label>
        <input value= "{{ old('effectif_femme_realise') ?? $realisation->effectif_femme_realise}}" type="number" name="effectif_femme_realise" id="" readonly>
    </div>

    <div class="form-group">
        <label for="date_debut_realise">Date début réalisée</label>
        <input value= "{{ old('date_debut_realise') ?? $realisation->date_debut_realise}}" type="date" name="date_debut_realise" readonly>
    </div>

    <div class="form-group">
        <label for="date_fin_realise">Date fin réalisée</label>
        <input value= "{{ old('date_fin_realise') ?? $realisation->date_fin_realise}}" type="date" name="date_fin_realise" readonly>
    </div>

    <div class="form-group">
        <label for="cout_realise">Cout réalisée</label>
        <input value= "{{ old('cout_realise') ?? $realisation->cout_realise}}" type="number" name="cout_realise" id="" readonly>
    </div>

    <div class="form-group">
        <label for="valide_realise">Valide réalisée</label><br>
        <select class="form-control disabled" name="valide_realise " id="valide_realise">
            <option selected="selected" value="false">Non</option>
            <option value="true">Oui</option>
        </select>
    </div>

    <div class="form-group">
        <label for="rejet_realise">Rejet réalisée</label><br>
        <select class="form-control disabled" name="rejet_realise" id="rejet_realise">
            <option selected="selected" value="false">Non</option>
            <option value="true">Oui</option>
        </select>
    </div>

    <div class="form-group">
        <label for="motif_realise">Motif réalisée</label>
        <textarea class="form-control disabled" name="motif_realise" id="motif_realise" rows="3">
            {{ old('motif_realise') ?? $realisation->motif_realise }}
        </textarea>
    </div>