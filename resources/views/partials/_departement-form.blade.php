@csrf

<div class="form-group">
    <label for="programme_id">Responsable</label>
    <select class="form-control" name="programme_id" id="programme_id">
        @foreach ($employers as $employer )
            <option {{ ($departement->responsable_id == $employer->id OR old('responsable_id')==$employer->id) ? "selected" : ""}} value="{{ $employer->id }}">{{ $employer->nom }}</option>
        @endforeach
    </select>
    @error("responsable_id")
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="code_ind">Nom du departement</label>
    <input value= "{{ old('nom') ?? $departement->nom}}" type="text" name="nom" id="" class="form-control" placeholder="" aria-describedby="helpId">
    @error("nom")
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    <label for="lib_ind">Contact</label>
    <input value= "{{ old('contact') ?? $departement->contact}}" type="text" name="contact" id="" class="form-control" placeholder="" aria-describedby="helpId">
    @error("contact")
    <small class="text-danger">{{ $message }}</small>
    @enderror
</div>