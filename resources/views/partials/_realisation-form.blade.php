@csrf

    <div class="form-group">
        <label for="prevision_id">Prévision</label>
        <select class="form-control" name="prevision_id" id="prevision_id">
        @foreach ($previsions as $prevision )
            <option {{ ($realisation->prevision_id == $prevision->id OR old('prevision_id')==$prevision->id) ? "selected" : ""}} value="{{ $prevision->id }}">{{ $prevision->nom_struct }}</option>
        @endforeach
        </select>
        @error("prevision_id")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="effectif_total_realise">Effectif total réalisé</label>
        <input value= "{{ old('effectif_total_realise') ?? $realisation->effectif_total_realise}}" type="number" name="effectif_total_realise" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("effectif_total_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="effectif_homme_realise">Effectif homme réalisé</label>
        <input value= "{{ old('effectif_homme_realise') ?? $realisation->effectif_homme_realise}}" type="number" name="effectif_homme_realise" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("effectif_homme_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="effectif_femme_realise">Effectif femme réalisé</label>
        <input value= "{{ old('effectif_femme_realise') ?? $realisation->effectif_femme_realise}}" type="number" name="effectif_femme_realise" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("effectif_femme_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="date_debut_realise">Date début réalisée</label>
        <input value= "{{ old('date_debut_realise') ?? $realisation->date_debut_realise}}" type="date" name="date_debut_realise" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("date_debut_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="date_fin_realise">Date fin réalisée</label>
        <input value= "{{ old('date_fin_realise') ?? $realisation->date_fin_realise}}" type="date" name="date_fin_realise" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("date_fin_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="cout_realise">Cout réalisée</label>
        <input value= "{{ old('cout_realise') ?? $realisation->cout_realise}}" type="number" name="cout_realise" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("cout_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="valide_realise">Valide réalisée</label><br>
        <select name="valide_realise" id="valide_realise">
            <option selected="selected" value="false">Non</option>
            <option value="true">Oui</option>
        </select>
        @error("valide_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="rejet_realise">Rejet réalisée</label><br>
        <select name="rejet_realise" id="rejet_realise">
            <option selected="selected" value="false">Non</option>
            <option value="true">Oui</option>
        </select>
        @error("rejet_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="motif_realise">Motif réalisée</label>
        <textarea class="form-control" name="motif_realise" id="motif_realise" rows="3">
            {{ old('motif_realise') ?? $realisation->motif_realise }}
        </textarea>
        @error("motif_realise")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>