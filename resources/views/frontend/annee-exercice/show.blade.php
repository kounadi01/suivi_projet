@csrf

    <div class="form-group">
        <label for="annee_exerc">Annee d'exercice</label>
        <input value= "{{ old('annee_exerc') ?? $anneeExercice->annee_exerc}}" type="number" name="annee_exerc" readonly>
    </div>

    <div class="form-group">
        <label for="cloture_exerc">Cloture d'exercice</label><br>
        <select class="form-control disabled" name="cloture_exerc" id="cloture_exerc">
            <option selected="selected" value="false">Non</option>
            <option value="true">Oui</option>
        </select>
    </div>