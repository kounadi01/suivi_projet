@csrf

    <div class="form-group">
        <label for="nom_region">Région</label>
        <input value= "{{ old('nom_region') ?? $region->nom_region}}" type="number" name="nom_region" readonly>
        @error("nom_region")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>