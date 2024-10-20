<x-master-layout title="">
    <div class="container">
        
        <div class="row">
            <div class="col-md-12  mt-4">
                <h1 class="text-center">Prévisions</h1>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
            @if (session("statut"))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                {{ session("statut") }}
                </div>
                
            @endif
            
            <div>
                <a class="btn btn-success btn-sm" href="{{ route('prevision.create') }}"><i class="fas fa-plus"></i> Ajouter</a>
            </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Structure</th>
                            <th>Commune</th>
                            <th>Sous indicateur</th>
                            <th>Année d'exercice</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($previsions as $prevision)
                            <tr>
                                <td>{{ $prevision->structure->nom_struct }}</td>
                                <td>{{ $prevision->commune->nom_commune }}</td>
                                <td>{{ $prevision->sousIndicateur->lib_sous_ind }}</td>
                                <td>{{ $prevision->anneeExercice->annee_exerc }}</td>
                                <td><a href="{{ route('previsions.edit', $prevision) }}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit    "></i></a></td>
                                <td><a href="{{ route('previsions.show', $prevision) }}" class="btn btn-warning btn-sm mr-2"><i class="fas fa-eye    "></i></a></td>
                                <td><a href="#" class="btn btn-danger btn-sm mr-2" onClick="event.preventDefault(); deleteConfirm('{{ $prevision->id }}')"><i class="fas fa-trash"></i></a></td>
                            <form id="{{ $prevision->id }}" method="post" action="{{ route('previsions.destroy', $prevision) }}">
                            @csrf
                            @method("DELETE")

                            </form>
                            </tr> 

                        @endforeach
                    </tbody>
                </table>
                <div class="mt-5 d-flex justify-content-center">
                    {{ $previsions->links() }}
                </div>
            </div>
        </div>
    </div>
</x-master-layout>