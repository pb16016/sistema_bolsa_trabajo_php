<div>
    <ul>
        @foreach ($municipalities as $municipio)
            <li>{{ $municipio->codMunicipio }} - {{ $municipio->nombreMunicipio }}</li>
        @endforeach
    </ul>
</div>
