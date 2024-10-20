@csrf

    <div class="form-group">
        <label for="programme_id">Programme</label>
        <select class="form-control" name="programme_id" id="programme_id">
        @foreach ($programmes as $programme )
            <option {{ ($indicateur->programme_id == $programme->id OR old('programme_id')==$programme->id) ? "selected" : ""}} value="{{ $programme->id }}">{{ $programme->nom_struct }}</option>
        @endforeach
        </select>
        @error("programme_id")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="code_ind">Code de l'indicateur</label>
        <input value= "{{ old('code_ind') ?? $indicateur->code_ind}}" type="number" name="code_ind" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("code_ind")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="lib_ind">Libéllé de l'indicateur</label>
        <input value= "{{ old('lib_ind') ?? $indicateur->lib_ind}}" type="number" name="lib_ind" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("lib_ind")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>