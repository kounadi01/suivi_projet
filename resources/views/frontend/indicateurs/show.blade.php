@csrf

    <div class="form-group">
        <label for="programme_id">Programme</label>
        <select class="form-control disabled" name="programme_id" id="programme_id">
        @foreach ($programmes as $programme )
            <option {{ ($indicateur->programme_id == $programme->id OR old('programme_id')==$programme->id) ? "selected" : ""}} value="{{ $programme->id }}">{{ $programme->nom_struct }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="code_ind">Code de l'indicateur</label>
        <input value= "{{ old('code_ind') ?? $indicateur->code_ind}}" type="number" name="code_ind" readonly>
    </div>

    <div class="form-group">
        <label for="lib_ind">Libéllé de l'indicateur</label>
        <input value= "{{ old('lib_ind') ?? $indicateur->lib_ind}}" type="number" name="lib_ind" readonly>
    </div>