<table class="display text-sm data-table" id="photos-table">
    <thead>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Photo</th>
            <th>Publié ?</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($photos as $index => $photo)
        <tr>
            <td>{{ $index+1 }}</td>
            <td>{{ $photo->libelle }}</td>
            <td><img id="thumbnil" style="height:100px;" src="{{asset('uploads/photo')}}/{{$photo->photo}}" alt="image" /></td>
            <td>
                @if($photo->publier == 1)
                    Oui
                @else
                    Non
                @endif
            </td>
            <td>
                <div class='btn-group'>
                    <a href="{{route('photos.edit',$photo->id) }}" class="btn btn-info data-tooltip" data-tooltip="Modifier la photo">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#" data-url="{!! route('photos.delete', $photo->id) !!}" id="supprimerStruct" class="btn btn-info data-tooltip" data-tooltip="Supprimer la photo">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th>N°</th>
            <th>Libellé</th>
            <th>Photo</th>
            <th>Publié ?</th>
            <th>Action</th>
        </tr>
    </tfoot>
</table>