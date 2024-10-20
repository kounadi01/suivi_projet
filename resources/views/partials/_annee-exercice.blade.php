@csrf

    <div class="form-group">
        <label for="annee_exerc">Annee d'exercice</label>
        <input value= "{{ old('annee_exerc') ?? $prevision->annee_exerc}}" type="number" name="annee_exerc" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("annee_exerc")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="cloture">Cloture d'exercice</label><br>
        <select name="cloture" id="cloture">
            <option selected="selected" value="false">Non</option>
            <option value="true">Oui</option>
        </select>
        @error("cloture")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>