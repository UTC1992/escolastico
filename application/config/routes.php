<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_Controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_Controller/index
|		my-controller/my-method	-> my_Controller/my_method
|  ruta creada ==> hola/index controlador ==> controller/index
|
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//rutas login Admin
$route['admin_/login'] = 'Login_Admin/index';
$route['admin_/logout'] = 'Login_Admin/logout';

//rutas administrador CRUD
$route['admin_/registro'] = 'Administrador_Controller/nuevo';
$route['admin_/dashboard'] = 'Administrador_Controller/index';
$route['admin_/perfil'] = 'Administrador_Controller/perfil';

//rutas periodo academico
$route['admin_/periodoacademico'] = 'Periodoa_Controller/index';
$route['admin_/periodoacademico/lista'] = 'Periodoa_Controller/content';
$route['admin_/periodoacademico/nuevo'] = 'Periodoa_Controller/nuevo';
$route['admin_/periodoacademico/edit/(:num)'] = 'Periodoa_Controller/edit/$1';
$route['admin_/periodoacademico/actualizar/(:num)'] = 'Periodoa_Controller/actualizar/$1';

//rutas de asginaturas
$route['admin_/asignaturas'] = 'Asignaturas_Controller/index';
$route['admin_/asignaturas/listar'] = 'Asignaturas_Controller/listar';

//rutas de cursos
$route['admin_/curso'] = 'Curso_Controller/index';
$route['admin_/curso/listar'] = 'Curso_Controller/listar';

//rutas de docentes
$route['admin_/docente'] = 'Docente_Controller/index';
$route['admin_/docente/listar'] = 'Docente_Controller/listar';

//rutas de docentes y cargos de materias o cursos
$route['admin_/docente_cargo'] = 'Docente_Cargo_Controller/index';
$route['admin_/docente_cargo/listar'] = 'Docente_Cargo_Controller/listar';

//rutas de los estudiantes
$route['admin_/estudiantes'] = 'Estudiante_Controller/index';
$route['admin_/estudiante/listar'] = 'Estudiante_Controller/listar';

//matricular
$route['admin_/matricular'] = 'Matricula_Controller/index';
$route['admin_/matricula/resgitro'] = 'Matricula_Controller/registrar';

//rutas del ingreso de calificaciones
$route['notas_/ingresar_notas/login'] = 'Login_Docente/index';
$route['notas_/ingresar_notas/logout'] = 'Login_Docente/logout';
$route['notas_/ingresar_notas/index'] = 'Ingresar_Notas_Controller/index';

//rutas de los estudiantes
$route['admin_/reportes/matriculas'] = 'Reporte_Matriculas_Controller/index';

//rutas de los estudiantes
$route['admin_/reportes/notas'] = 'Reporte_Notasadmin_Controller/index';

//rutas del ingreso de calificaciones
$route['notas_/consultar/notas/login'] = 'Login_Estu/index';
$route['notas_/consultar/notas/logout'] = 'Login_Estu/logout';
$route['notas_/consultar/notas/index'] = 'Consultar_Notas_Controller/index';
