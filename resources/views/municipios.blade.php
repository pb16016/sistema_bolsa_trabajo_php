<div>
    <ul>
        @foreach ($municipios as $municipio)
            <li>{{ $municipio->codMunicipio }} - {{ $municipio->nombreMunicipio }}</li>
        @endforeach
    </ul>
</div>
