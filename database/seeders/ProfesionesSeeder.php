<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfesionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('profesiones')->insert([
            ['nombreProfesion' => 'Ingeniero en Sistemas Informáticos', 'descripcion' => 'Profesional Ingeniero en Sistemas Informáticos.'],
            ['nombreProfesion' => 'Ingeniero de desarrollo', 'descripcion' => 'Profesional responsable de la gestión y administración de proyectos de desarrollo.'],
            ['nombreProfesion' => 'Arquitecto de Software', 'descripcion' => 'Profesional responsable de la gestión y diseño de la arquitectura de software.'],
            ['nombreProfesion' => 'Ingeniero Quimico', 'descripcion' => 'Profesional Ingeniero Quimico.'],
            ['nombreProfesion' => 'Gerente', 'descripcion' => 'Profesional responsable de la gestión y administración de una empresa o departamento.'],
            ['nombreProfesion' => 'Financiero', 'descripcion' => 'Profesional encargado de la gestión de recursos financieros.'],
            ['nombreProfesion' => 'Marketero', 'descripcion' => 'Profesional especializado en marketing y estrategias comerciales.'],
            ['nombreProfesion' => 'Recursos Humanos', 'descripcion' => 'Profesional encargado de la gestión del personal y relaciones laborales.'],
            ['nombreProfesion' => 'Tecnología', 'descripcion' => 'Profesional responsable de la gestión de tecnología y sistemas informáticos.'],
            ['nombreProfesion' => 'Operaciones', 'descripcion' => 'Profesional encargado de la supervisión y coordinación de las operaciones diarias.'],
            ['nombreProfesion' => 'Ventas', 'descripcion' => 'Profesional especializado en la comercialización y venta de productos o servicios.'],
            ['nombreProfesion' => 'Producción', 'descripcion' => 'Profesional encargado de la gestión de procesos de producción.'],
            ['nombreProfesion' => 'Logística', 'descripcion' => 'Profesional encargado de la gestión y optimización de la cadena de suministro.'],
            ['nombreProfesion' => 'Analista', 'descripcion' => 'Profesional encargado del análisis de datos y sistemas.'],
            ['nombreProfesion' => 'Administrador', 'descripcion' => 'Profesional encargado de la administración de recursos y sistemas.'],
            ['nombreProfesion' => 'Diseñador', 'descripcion' => 'Profesional especializado en el diseño gráfico y visual.'],
            ['nombreProfesion' => 'Soporte Técnico', 'descripcion' => 'Profesional encargado de brindar soporte técnico y soluciones informáticas.'],
            ['nombreProfesion' => 'Redes Sociales', 'descripcion' => 'Profesional encargado de la gestión de redes sociales y comunidades en línea.'],
            ['nombreProfesion' => 'Asistente Administrativo', 'descripcion' => 'Profesional encargado de tareas administrativas y de apoyo.'],
            ['nombreProfesion' => 'Secretario', 'descripcion' => 'Profesional encargado de asistir a ejecutivos y realizar tareas de oficina.'],
            ['nombreProfesion' => 'Recepcionista', 'descripcion' => 'Profesional encargado de la atención y recepción de visitantes.'],
            ['nombreProfesion' => 'Contador', 'descripcion' => 'Profesional especializado en la contabilidad y gestión financiera.'],
            ['nombreProfesion' => 'Auditor', 'descripcion' => 'Profesional encargado de realizar auditorías y revisiones financieras.'],
            ['nombreProfesion' => 'Asesor Legal', 'descripcion' => 'Profesional encargado de brindar asesoría legal.'],
            ['nombreProfesion' => 'Consultor', 'descripcion' => 'Profesional especializado en brindar consultoría en diversas áreas.'],
            ['nombreProfesion' => 'Atención al Cliente', 'descripcion' => 'Profesional encargado de brindar atención y soporte a los clientes.'],
            ['nombreProfesion' => 'Ingeniero Civil', 'descripcion' => 'Profesional encargado del diseño y construcción de infraestructuras.'],
            ['nombreProfesion' => 'Arquitecto', 'descripcion' => 'Profesional encargado del diseño y planificación de edificaciones.'],
            ['nombreProfesion' => 'Médico', 'descripcion' => 'Profesional encargado de la atención médica y cuidado de la salud.'],
            ['nombreProfesion' => 'Enfermero', 'descripcion' => 'Profesional encargado del cuidado y atención de pacientes.'],
            ['nombreProfesion' => 'Farmacéutico', 'descripcion' => 'Profesional encargado de la dispensación y gestión de medicamentos.'],
            ['nombreProfesion' => 'Psicólogo', 'descripcion' => 'Profesional encargado de brindar atención y terapia psicológica.'],
            ['nombreProfesion' => 'Bibliotecario', 'descripcion' => 'Profesional encargado de la gestión y organización de bibliotecas.'],
            ['nombreProfesion' => 'Supervisor', 'descripcion' => 'Profesional encargado de supervisar y coordinar actividades y personal.'],
            ['nombreProfesion' => 'Técnico', 'descripcion' => 'Profesional especializado en mantenimiento y reparación de equipos.'],
            ['nombreProfesion' => 'Bombero', 'descripcion' => 'Profesional encargado de la extinción de incendios y rescates.'],
            ['nombreProfesion' => 'Policía', 'descripcion' => 'Profesional encargado de la seguridad y orden público.'],
            ['nombreProfesion' => 'Soldado', 'descripcion' => 'Profesional encargado de la defensa y seguridad militar.'],
            ['nombreProfesion' => 'Desarrollador', 'descripcion' => 'Profesional especializado en el desarrollo de software y aplicaciones.'],
            ['nombreProfesion' => 'Especialista en Calidad', 'descripcion' => 'Profesional encargado de asegurar la calidad en procesos y productos.'],
            ['nombreProfesion' => 'Especialista en Comercio Exterior', 'descripcion' => 'Profesional encargado de la gestión del comercio internacional.'],
            ['nombreProfesion' => 'Científico', 'descripcion' => 'Profesional especializado en investigación científica en diversas áreas.'],
            ['nombreProfesion' => 'Profesor', 'descripcion' => 'Profesional encargado de la enseñanza y educación en diferentes niveles.'],
            ['nombreProfesion' => 'Proyectos', 'descripcion' => 'Profesional especializado en la planificación y ejecución de proyectos.']
        ]);
    }
}
