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
|	$route['default_controller'] = 'welcome';
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
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
|  ruta creada ==> hola/index controlador ==> controller/index
|
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//rutas login Admin
$route['admin_/login'] = 'login_admin/index';
$route['admin_/logout'] = 'login_admin/logout';

//rutas administrador CRUD
$route['admin_/registro'] = 'administrador_controller/nuevo';
$route['admin_/dashboard'] = 'administrador_controller/index';
$route['admin_/perfil'] = 'administrador_controller/perfil';

//rutas periodo academico
$route['admin_/periodoacademico'] = 'periodoa_controller/index';
$route['admin_/periodoacademico/lista'] = 'periodoa_controller/content';
$route['admin_/periodoacademico/nuevo'] = 'periodoa_controller/nuevo';
$route['admin_/periodoacademico/edit/(:num)'] = 'periodoa_controller/edit/$1';
$route['admin_/periodoacademico/actualizar/(:num)'] = 'periodoa_controller/actualizar/$1';

//rutas de asginaturas
$route['admin_/asignaturas'] = 'asignaturas_controller/index';
$route['admin_/asignaturas/listar'] = 'asignaturas_controller/listar';

//rutas de cursos
$route['admin_/curso'] = 'curso_controller/index';
$route['admin_/curso/listar'] = 'curso_controller/listar';

//rutas de docentes
$route['admin_/docente'] = 'docente_controller/index';
$route['admin_/docente/listar'] = 'docente_controller/listar';

//rutas de docentes y cargos de materias o cursos
$route['admin_/docente_cargo'] = 'docente_cargo_controller/index';
$route['admin_/docente_cargo/listar'] = 'docente_cargo_controller/listar';

//rutas de los estudiantes
$route['admin_/estudiantes'] = 'estudiante_controller/index';
$route['admin_/estudiante/listar'] = 'estudiante_controller/listar';

//rutas de docentes y cargos de materias o cursos
$route['admin_/matricular'] = 'matricula_controller/index';
$route['admin_/matricula/resgitro'] = 'matricula_controller/registrar';

//rutas del ingreso de calificaciones
$route['notas_/ingresar_notas/login'] = 'login_docente/index';
$route['notas_/ingresar_notas/logout'] = 'login_docente/logout';
$route['notas_/ingresar_notas/index'] = 'ingresar_notas_controller/index';

//rutas de los estudiantes
$route['admin_/reportes/matriculas'] = 'reporte_matriculas_controller/index';

//rutas de los estudiantes
$route['admin_/reportes/notas'] = 'reporte_notasadmin_controller/index';

//rutas del ingreso de calificaciones
$route['notas_/consultar/notas/login'] = 'login_estu/index';
$route['notas_/consultar/notas/logout'] = 'login_estu/logout';
$route['notas_/consultar/notas/index'] = 'consultar_notas_controller/index';
