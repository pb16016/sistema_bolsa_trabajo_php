<div>
    <ul>
        @foreach ($departamentos as $departamento)
            <li>{{ $departamento->codDepartamento }} - {{ $departamento->nombreDepartamento }}</li>
        @endforeach
    </ul>
</div>
