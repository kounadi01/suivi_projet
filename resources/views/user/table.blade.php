<table class="display text-sm data-table" style="width:100%"cellspacing="0" id="users-table">
    <thead>
    <tr class="text">
        <th>N°</th>
        <th>Nom</th>
        <th>Prenom</th>
        <!--th>Identifiant</th-->
        <th>Statut</th>
        <th>Email</th>
        <th>Profil</th>
        <th>Actions</th>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->prenom }}</td>
            <!--td>{{ $user->login }}</td-->
            <td>
                @if ($user->isenable == 1)
                    <span class="text-success ">compte activé</span>

                @else
                    <span class="text-danger">compte desactivé</span>
            @endif
            <td>{{ $user->email }}</td>
            <td>{{ $user->nom }}</td>
            <td>
                <div class='btn-group'>
                    @if($user->isenable==1)

                        <a  href="#"
                            data-url="{!! route('user.desactive',$user->id) !!}"
                            id="desactiveUser"
                            class="btn btn-info data-tooltip btn-sm btn-primary" data-tooltip="Activer compte utilisateur">

                            <i class="fas fa-lock">&nbsp;Desactiver</i>
                        </a>

                        @else
                        <a  href="#"
                            data-url="{!! route('user.reactive',$user->id) !!}"
                            id="reactiveUser"
                            class="btn btn-info data-tooltip btn-sm btn-primary" data-tooltip="Activer compte utilisateur">

                            <i class="fas fa-unlock ">&nbsp;Reactiver</i>
                        </a>


                        @endif

                    <a href="{{route('user.show',$user->id)}}"
                       class="btn btn-info data-tooltip" data-tooltip="Détails utilisateur">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{route('user.edit',[$user->id,'option'=>'edit'])}}"
                       class="btn btn-info data-tooltip" data-tooltip="Modifier l'utilisateur">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="#"
                       data-url="{!! route('user.delete',$user->id) !!}"
                       id="supprimerUser"
                       class="btn btn-danger data-tooltip" data-tooltip="Supprimer l'utilisateur">
                        <i class="fas fa-trash"></i>
                    </a>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class=" text">
        <th>N°</th>
        <th>Nom</th>
        <th>Prenom</th>
        <!--th>Identifiant</th-->
        <th>Statut</th>
        <th>Email</th>
        <th>Profil</th>
        <th>Actions</th>
    </tr>
    </tfoot>
</table>