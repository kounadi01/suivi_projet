@csrf

    <div class="form-group">
        <label for="region_id">Région</label>
        <select class="form-control" name="region_id" id="region_id">
        @foreach ($regions as $region )
            <option {{ ($province->region_id == $region->id OR old('region_id')==$region->id) ? "selected" : ""}} value="{{ $region->id }}">{{ $region->nom_struct }}</option>
        @endforeach
        </select>
        @error("region_id")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="nom_province">Province</label>
        <input value= "{{ old('nom_province') ?? $province->nom_province}}" type="number" name="nom_province" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("nom_province")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>