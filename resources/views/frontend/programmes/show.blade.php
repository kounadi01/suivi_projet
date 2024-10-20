@csrf

    <div class="form-group">
        <label for="titre_prog">Titre du programme</label>
        <input value= "{{ old('titre_prog') ?? $programme->titre_prog}}" type="number" name="titre_prog" readonly>
    </div>

    <div class="form-group">
        <label for="code_prog">Code du programme</label>
        <input value= "{{ old('code_prog') ?? $programme->code_prog}}" type="number" name="code_prog" readonly>
    </div>

    <div class="form-group">
        <label for="object_strat_prog">Objectif stratégique du programme</label>
        <input value= "{{ old('object_strat_prog') ?? $programme->object_strat_prog}}" type="number" name="object_strat_prog" readonly>
    </div>