@csrf

    <div class="form-group">
        <label for="nom_struct">Nom de la structure</label>
        <input value= "{{ old('nom_struct') ?? $structure->nom_struct}}" type="number" name="nom_struct" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("nom_struct")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="sigle_struct">Sigle de la structure</label>
        <input value= "{{ old('sigle_struct') ?? $structure->sigle_struct}}" type="number" name="sigle_struct" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("sigle_struct")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="type_struct">Type de la structure</label><br>
        <select name="type_struct" id="type_struct">
            <option selected="selected" value="1"></option>
            <option value="2">2</option>
        </select>
        @error("type_struct")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="tel_struct">Telephone de la structure</label>
        <input value= "{{ old('tel_struct') ?? $structure->tel_struct}}" type="tel" name="tel_struct" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("tel_struct")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="email_struct">Email</label>
        <input value= "{{ old('email_struct') ?? $structure->email_struct}}" type="date" name="email_struct" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("email_struct")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group">
        <label for="responsable_struct">Responsable de la structure</label>
        <input value= "{{ old('responsable_struct') ?? $structure->responsable_struct}}" type="number" name="responsable_struct" id="" class="form-control" placeholder="" aria-describedby="helpId">
        @error("responsable_struct")
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>