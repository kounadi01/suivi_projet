@csrf

    <div class="form-group">
        <label for="province_id">Province</label>
        <select class="form-control" name="province_id" id="province_id">
        @foreach ($provinces as $province )
            <option {{ ($commune->province_id == $province->id OR old('province_id')==$province->id) ? "selected" : ""}} value="{{ $province->id }}">{{ $province->nom_struct }}</option>
        @endforeach
        </select>
        @error("province_id")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="nom_commune">Commune</label>
        <input value= "{{ old('nom_commune') ?? $commune->nom_commune}}" type="number" name="nom_commune" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("nom_commune")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>