<div>
    <ul>
        @foreach ($departments as $departamento)
            <li>{{ $departamento->codDepartamento }} - {{ $departamento->nombreDepartamento }}</li>
        @endforeach
    </ul>
</div>