<x-master-layout>
    <div class="container">
        
        <div class="row">
            <div class="col-md-12  mt-4">
                <h1 class="text-center">Ajouter une commune</h1>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form method="POST" action="{{ route('communes.store') }}" enctype="multipart/form-data">
                  @method("POST")
                  @include("partials._commune-form")

                  <button type="submit" class="btn btn-primary btn-block btn-lg">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</x-master-layout>