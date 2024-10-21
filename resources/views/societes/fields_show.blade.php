<table class="table table-striped">
    <tbody>
        <tr>
            <td>code</td>
            <td>{{ $sous_indicateur->code_sous_ind }}</td>
        </tr>
        <tr>
            <td>Libellé</td>
            <td>{{ $sous_indicateur->lib_sous_ind }}</td>
        </tr>
        <tr>
            <td>Indicateur</td>
            <td>{{ $sous_indicateur->indicateur->lib_ind }}</td>
        </tr>
    </tbody>
</table>

