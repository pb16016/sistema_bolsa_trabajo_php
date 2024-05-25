<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insertar cargos
        DB::table('cargos')->insert([
            ['nombreCargo' => 'Gerente General', 'descripcion' => 'Responsable de la gestión general de la empresa.', 'idProfesion' => 5],
            ['nombreCargo' => 'Director Financiero', 'descripcion' => 'Responsable de la gestión financiera.', 'idProfesion' => 6],
            ['nombreCargo' => 'Director de Marketing', 'descripcion' => 'Responsable de las estrategias de marketing.', 'idProfesion' => 7],
            ['nombreCargo' => 'Director de Recursos Humanos', 'descripcion' => 'Responsable de la gestión del personal.', 'idProfesion' => 8],
            ['nombreCargo' => 'Director de Tecnología', 'descripcion' => 'Responsable de la tecnología y sistemas informáticos.', 'idProfesion' => 9],
            ['nombreCargo' => 'Director de Operaciones', 'descripcion' => 'Responsable de las operaciones diarias.', 'idProfesion' => 10],
            ['nombreCargo' => 'Gerente de Ventas', 'descripcion' => 'Responsable de la gestión de ventas.', 'idProfesion' => 11],
            ['nombreCargo' => 'Gerente de Proyectos', 'descripcion' => 'Responsable de la gestión de proyectos.', 'idProfesion' => 44],
            ['nombreCargo' => 'Gerente de Producción', 'descripcion' => 'Responsable de la gestión de la producción.', 'idProfesion' => 12],
            ['nombreCargo' => 'Gerente de Logística', 'descripcion' => 'Responsable de la gestión de la logística.', 'idProfesion' => 13],
            ['nombreCargo' => 'Ingeniero de Sistemas', 'descripcion' => 'Responsable del diseño de sistemas.', 'idProfesion' => 1],
            ['nombreCargo' => 'Analista de Datos', 'descripcion' => 'Responsable del análisis de datos.', 'idProfesion' => 14],
            ['nombreCargo' => 'Administrador de Base de Datos', 'descripcion' => 'Responsable de la gestión de bases de datos.', 'idProfesion' => 9],
            ['nombreCargo' => 'Administrador de Redes', 'descripcion' => 'Responsable de la gestión de redes.', 'idProfesion' => 9],
            ['nombreCargo' => 'Soporte Técnico', 'descripcion' => 'Responsable de brindar soporte técnico.', 'idProfesion' => 17],
            ['nombreCargo' => 'Diseñador Gráfico', 'descripcion' => 'Responsable del diseño gráfico.', 'idProfesion' => 16],
            ['nombreCargo' => 'Especialista en Redes Sociales', 'descripcion' => 'Responsable de la gestión de redes sociales.', 'idProfesion' => 18],
            ['nombreCargo' => 'Asistente Administrativo', 'descripcion' => 'Responsable de tareas administrativas.', 'idProfesion' => 19],
            ['nombreCargo' => 'Secretario Ejecutivo', 'descripcion' => 'Responsable de asistir a ejecutivos.', 'idProfesion' => 20],
            ['nombreCargo' => 'Recepcionista', 'descripcion' => 'Responsable de la recepción de visitantes.', 'idProfesion' => 21],
            ['nombreCargo' => 'Contador', 'descripcion' => 'Responsable de la contabilidad.', 'idProfesion' => 22],
            ['nombreCargo' => 'Auditor', 'descripcion' => 'Responsable de las auditorías.', 'idProfesion' => 23],
            ['nombreCargo' => 'Analista Financiero', 'descripcion' => 'Responsable del análisis financiero.', 'idProfesion' => 14],
            ['nombreCargo' => 'Asesor Legal', 'descripcion' => 'Responsable de brindar asesoría legal.', 'idProfesion' => 24],
            ['nombreCargo' => 'Consultor de Negocios', 'descripcion' => 'Responsable de la consultoría de negocios.', 'idProfesion' => 25],
            ['nombreCargo' => 'Ejecutivo de Ventas', 'descripcion' => 'Responsable de la ejecución de ventas.', 'idProfesion' => 11],
            ['nombreCargo' => 'Representante de Atención al Cliente', 'descripcion' => 'Responsable de la atención al cliente.', 'idProfesion' => 26],
            ['nombreCargo' => 'Ingeniero Civil', 'descripcion' => 'Responsable del diseño y construcción de infraestructuras.', 'idProfesion' => 27],
            ['nombreCargo' => 'Arquitecto', 'descripcion' => 'Responsable del diseño de edificaciones.', 'idProfesion' => 28],
            ['nombreCargo' => 'Médico General', 'descripcion' => 'Responsable de la atención médica general.', 'idProfesion' => 29],
            ['nombreCargo' => 'Enfermero', 'descripcion' => 'Responsable del cuidado de pacientes.', 'idProfesion' => 30],
            ['nombreCargo' => 'Farmacéutico', 'descripcion' => 'Responsable de la dispensación de medicamentos.', 'idProfesion' => 31],
            ['nombreCargo' => 'Psicólogo', 'descripcion' => 'Responsable de la atención psicológica.', 'idProfesion' => 32],
            ['nombreCargo' => 'Bibliotecario', 'descripcion' => 'Responsable de la gestión de bibliotecas.', 'idProfesion' => 33],
            ['nombreCargo' => 'Supervisor de Producción', 'descripcion' => 'Responsable de la supervisión de la producción.', 'idProfesion' => 34],
            ['nombreCargo' => 'Ingeniero Industrial', 'descripcion' => 'Responsable de la optimización de procesos industriales.', 'idProfesion' => 27],
            ['nombreCargo' => 'Técnico de Mantenimiento', 'descripcion' => 'Responsable del mantenimiento de equipos.', 'idProfesion' => 35],
            ['nombreCargo' => 'Bombero', 'descripcion' => 'Responsable de la extinción de incendios.', 'idProfesion' => 36],
            ['nombreCargo' => 'Policía', 'descripcion' => 'Responsable de la seguridad pública.', 'idProfesion' => 37],
            ['nombreCargo' => 'Soldado', 'descripcion' => 'Responsable de la defensa militar.', 'idProfesion' => 38],
            ['nombreCargo' => 'Desarrollador Web', 'descripcion' => 'Responsable del desarrollo de sitios web.', 'idProfesion' => 39],
            ['nombreCargo' => 'Product Manager', 'descripcion' => 'Responsable de la gestión de productos.', 'idProfesion' => 44],
            ['nombreCargo' => 'Project Manager', 'descripcion' => 'Responsable de la gestión de proyectos.', 'idProfesion' => 44],
            ['nombreCargo' => 'Ingeniero de Telecomunicaciones', 'descripcion' => 'Responsable de las telecomunicaciones.', 'idProfesion' => 27],
            ['nombreCargo' => 'Ingeniero Eléctrico', 'descripcion' => 'Responsable de las instalaciones eléctricas.', 'idProfesion' => 27],
            ['nombreCargo' => 'Ingeniero Mecánico', 'descripcion' => 'Responsable de los sistemas mecánicos.', 'idProfesion' => 27],
            ['nombreCargo' => 'Analista de Calidad', 'descripcion' => 'Responsable del análisis de calidad.', 'idProfesion' => 14],
            ['nombreCargo' => 'Especialista en Comercio Exterior', 'descripcion' => 'Responsable del comercio exterior.', 'idProfesion' => 41],
            ['nombreCargo' => 'Especialista en Logística', 'descripcion' => 'Responsable de la gestión logística.', 'idProfesion' => 13],
            ['nombreCargo' => 'Encargado de Almacén', 'descripcion' => 'Responsable de la gestión del almacén.', 'idProfesion' => 13],
            ['nombreCargo' => 'Encargado de Inventario', 'descripcion' => 'Responsable del inventario.', 'idProfesion' => 13],
            ['nombreCargo' => 'Ingeniero de Calidad', 'descripcion' => 'Responsable de la calidad.', 'idProfesion' => 40],
            ['nombreCargo' => 'Supervisor de Mantenimiento', 'descripcion' => 'Responsable del mantenimiento.', 'idProfesion' => 34],
            ['nombreCargo' => 'Biólogo', 'descripcion' => 'Responsable del estudio de la biología.', 'idProfesion' => 42],
            ['nombreCargo' => 'Químico', 'descripcion' => 'Responsable del estudio de la química.', 'idProfesion' => 4],
            ['nombreCargo' => 'Físico', 'descripcion' => 'Responsable del estudio de la física.', 'idProfesion' => 41],
            ['nombreCargo' => 'Matemático', 'descripcion' => 'Responsable del estudio de las matemáticas.', 'idProfesion' => 41],
            ['nombreCargo' => 'Geólogo', 'descripcion' => 'Responsable del estudio de la geología.', 'idProfesion' => 41],
            ['nombreCargo' => 'Profesor de Secundaria', 'descripcion' => 'Responsable de la educación secundaria.', 'idProfesion' => 43],
            ['nombreCargo' => 'Profesor Universitario', 'descripcion' => 'Responsable de la educación universitaria.', 'idProfesion' => 43],
            ['nombreCargo' => 'Assistant Manager', 'descripcion' => 'Responsable de asistir al gerente.', 'idProfesion' => 5],
            ['nombreCargo' => 'Operations Manager', 'descripcion' => 'Responsable de la gestión de operaciones.', 'idProfesion' => 10],
            ['nombreCargo' => 'Customer Service Manager', 'descripcion' => 'Responsable del servicio al cliente.', 'idProfesion' => 26],
            ['nombreCargo' => 'Inventory Manager', 'descripcion' => 'Responsable de la gestión de inventarios.', 'idProfesion' => 13],
            ['nombreCargo' => 'Marketing Coordinator', 'descripcion' => 'Responsable de la coordinación de marketing.', 'idProfesion' => 7],
            ['nombreCargo' => 'Human Resources Coordinator', 'descripcion' => 'Responsable de la coordinación de recursos humanos.', 'idProfesion' => 8],
            ['nombreCargo' => 'Software Engineer', 'descripcion' => 'Responsable del desarrollo de software.', 'idProfesion' => 1],
            ['nombreCargo' => 'Cloud Architect', 'descripcion' => 'Responsable de la arquitectura en la nube.', 'idProfesion' => 1],
            ['nombreCargo' => 'Cyber Security Specialist', 'descripcion' => 'Responsable de la seguridad cibernética.', 'idProfesion' => 1],
            ['nombreCargo' => 'UX Designer', 'descripcion' => 'Responsable del diseño de la experiencia de usuario.', 'idProfesion' => 16],
            ['nombreCargo' => 'UI Designer', 'descripcion' => 'Responsable del diseño de la interfaz de usuario.', 'idProfesion' => 16],
            ['nombreCargo' => 'Network Engineer', 'descripcion' => 'Responsable de la gestión de redes.', 'idProfesion' => 9],
            ['nombreCargo' => 'Database Administrator', 'descripcion' => 'Responsable de la administración de bases de datos.', 'idProfesion' => 9],
            ['nombreCargo' => 'Systems Analyst', 'descripcion' => 'Responsable del análisis de sistemas.', 'idProfesion' => 14]
        ]);
        
    }
}
