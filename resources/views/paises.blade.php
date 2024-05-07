<div>
    <ul>
        @foreach ($paises as $pais)
            <li>{{ $pais->nombrePais }} - {{ $pais->abreviaturaPais }}</li>
        @endforeach
    </ul>
</div>
