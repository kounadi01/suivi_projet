
    <div class="form-group">
        <label for="nom_struct">Nom de la structure</label>
        <input value= "{{ old('nom_struct') ?? $structure->nom_struct}}" type="number" name="nom_struct" readonly>
    </div>

    <div class="form-group">
        <label for="sigle_struct">Sigle de la structure</label>
        <input value= "{{ old('sigle_struct') ?? $structure->sigle_struct}}" type="number" name="sigle_struct" readonly>
    </div>

    <div class="form-group">
        <label for="type_struct">Type de la structure</label><br>
        <select name="type_struct" id="type_struct">
            <option selected="selected" value="1"></option>
            <option value="2">2</option>
        </select>
    </div>

    <div class="form-group">
        <label for="tel_struct">Telephone de la structure</label>
        <input value= "{{ old('tel_struct') ?? $structure->tel_struct}}" type="tel" name="tel_struct" readonly>
    </div>

    <div class="form-group">
        <label for="email_struct">Email</label>
        <input value= "{{ old('email_struct') ?? $structure->email_struct}}" type="date" name="email_struct" readonly>
    </div>

    <div class="form-group">
        <label for="responsable_struct">Responsable de la structure</label>
        <input value= "{{ old('responsable_struct') ?? $structure->responsable_struct}}" type="number" name="responsable_struct" readonly>
    </div>