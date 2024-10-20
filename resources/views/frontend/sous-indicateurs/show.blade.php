@csrf

    <div class="form-group">
        <label for="indicateur_id">Indicateur</label>
        <select class="form-control disabled" name="indicateur_id" id="indicateur_id">
        @foreach ($indicateurs as $indicateur )
            <option {{ ($sousIndicateur->indicateur_id == $indicateur->id OR old('indicateur_id')==$indicateur->id) ? "selected" : ""}} value="{{ $indicateur->id }}">{{ $indicateur->nom_struct }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="code_sous_ind">Code du sous indicateur</label>
        <input value= "{{ old('code_sous_ind') ?? $sousIndicateur->code_sous_ind}}" type="number" name="code_sous_ind" readonly>
    </div>

    <div class="form-group">
        <label for="lib_sous_ind">Libéllé du sous indicateur</label>
        <input value= "{{ old('lib_sous_ind') ?? $sousIndicateur->lib_sous_ind}}" type="number" name="lib_sous_ind" readonly>
    </div>