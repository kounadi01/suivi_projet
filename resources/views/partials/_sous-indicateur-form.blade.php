@csrf

    <div class="form-group">
        <label for="indicateur_id">Indicateur</label>
        <select class="form-control" name="indicateur_id" id="indicateur_id">
        @foreach ($indicateurs as $indicateur )
            <option {{ ($sousIndicateur->indicateur_id == $indicateur->id OR old('indicateur_id')==$indicateur->id) ? "selected" : ""}} value="{{ $indicateur->id }}">{{ $indicateur->nom_struct }}</option>
        @endforeach
        </select>
        @error("indicateur_id")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="code_sous_ind">Code du sous indicateur</label>
        <input value= "{{ old('code_sous_ind') ?? $sousIndicateur->code_sous_ind}}" type="number" name="code_sous_ind" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("code_sous_ind")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="lib_sous_ind">Libéllé du sous indicateur</label>
        <input value= "{{ old('lib_sous_ind') ?? $sousIndicateur->lib_sous_ind}}" type="number" name="lib_sous_ind" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("lib_sous_ind")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>