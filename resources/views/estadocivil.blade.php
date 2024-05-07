<div>
    <ul>
        @foreach ($estadoCivil as $estCivil)
            <li>{{ $estCivil->codEstadoCivil }} - {{ $estCivil->EstadoCivil }}</li>
        @endforeach
    </ul>
</div>
