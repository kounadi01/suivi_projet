<div class="col-sm-12">
  <div class="row">
    <div class="required form-group {!! $errors->has('libelle') ? 'has-error' : '' !!} col-md-12">
      <label class="control-label" for="libelle">Libellé</label>
      {!! Form::text('libelle', $photo->libelle, ['class' => 'form-control', 'placeholder' => 'Libellé de la photo','id'=>'libelle','required']) !!}
      {!! $errors->first('libelle', '<small class="help-block">:message</small>') !!}
    </div>
  </div>

  <div class="row">
    <div class="form-group {!! $errors->has('photo') ? 'has-error' : '' !!} col-md-6">
      <label for="photo">Photo</label>
      <td><input type="file" class="form-control" name="photo" accept="image/*" onchange="showMyImage(this)" /></td>
      <td colspan="2" style="text-align: center;"><img id="thumbnil" style="height:100px;" src="{{asset('uploads/photo')}}/{{$photo->photo}}" alt="image" /></td>
      {!! $errors->first('photo', '<small class="help-block">:message</small>') !!}
    </div>

    <div class="form-group {!! $errors->has('publier') ? 'has-error' : '' !!} col-md-6">
      <label for="publier">Pubier</label>
      <select class="form-control" name="publier">
        <option value="{{$photo->publier}}">
          @if($photo->publier == 1)
          Oui
          @else
          Non
          @endif
        </option>
        <option value="1">Oui</option>
        <option value="0">Non</option>
      </select>
    </div>
  </div>

</div>