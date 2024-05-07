<div>
    <ul>
        @foreach ($tipoDocumento as $tipoDoc)
            <li>{{ $tipoDoc->tipoDocumento }} - {{ $tipoDoc->descripcion }}</li>
        @endforeach
    </ul>
</div>
