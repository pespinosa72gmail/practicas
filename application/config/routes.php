<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller'] = "home";
$route['404_override'] = 'error/error404';

$route['completa-localidades']="home/completaLocalidades";

$route['descargar-cupon'] = "pdf/ver_cupon"; //Este es para descargar el CUPÓN

$route['google162d7bd3d4bb5ccd.html']="home/googleVerifycation";

/* Menu */
$route['sobre-todoslosmenus'] = "home/sobreTodosLosMenus";
$route['eres-restaurador'] = "home/eresRestaurador";
$route['faqs'] = "home/faqs";
$route['franquiciate'] = "home/franquiciate";
$route['contactanos'] = "home/contactanos";
$route['registro-usuario'] = "usuario/vistaRegistroUsuario";
$route['club-tlm'] = "home/clubTLM";

/* Emails */
$route['email-franquiciate'] = "emailing/emailWebFranquiciate";
$route['email-contacto'] = "emailing/emailWebContacto";



/* Buscador */
$route['buscador-plato'] = "buscador/buscador_plato";
$route['buscador-zona'] = "buscador/buscador_zona";
$route['buscador-restaurante'] = "buscador/buscador_restaurante";

/* Detalle y valoración restaurante */
$route['restaurante/(:any)/valoracion'] = "valoraciones/index/$1";
$route['restaurante/(:any)'] = "restaurante/detalleRestaurante/$1";
$route['reserva-email'] = "emailing/reservar";



/* Url para obtener el CP */
$route['obtener-cp'] = "restaurante/autocompletarCP";
$route['obtener-provincia'] = "restaurante/autocompletarProvincia";



/* Usuario */
$route['panel-usuario'] = "usuario/index";
$route['login'] = "usuario/loginUsuario";
$route['logout'] = "usuario/logout";
$route['registrar-usuario'] = "usuario/registrarUsuario";
$route['registro-realizado'] = "usuario/registroRealizado";
$route['confirmar-registro-usuario'] = "usuario/comprobarRegistro";

$route['anadir-plato'] = "usuario/anadirPlatoFavorito";
$route['eliminar-plato'] = "usuario/eliminarPlatoFavorito";

$route['buscar-restaurante-favorito'] = "usuario/buscarRestauranteFavorito";
$route['anadir-restaurante-favorito'] = "usuario/anadirRestauranteFavorito";
$route['eliminar-restaurante-favorito'] = "usuario/eliminarRestauranteFavorito";

$route['anadir-home-restaurante-favorito'] = "favoritos/anadirRestFavorito"; // Esta función es la de que añades un restaurante como favorito desde la home.
$route['eliminar-home-restaurante-favorito'] = "favoritos/eliminarRestFavorito";

$route['aviso-marcar-favorito'] = "favoritos/avisoMarcarFavorito";




$route['anadir-cp-favorito'] = "usuario/anadirCPFavorito";
$route['eliminar-cp-favorito'] = "usuario/eliminarCPFavorito";

$route['editar-datos-usuario-tlm'] = "usuario/editarDatosTLMUsuario";







/* Restaurador */
$route['registro-restaurador/plan-premium/pag-(:num)'] = "restaurador/vistaRegistroRestaurador/$1/3";
$route['registro-restaurador/plan-basico/pag-(:num)'] = "restaurador/vistaRegistroRestaurador/$1/2";
$route['registro-restaurador/plan-freemium/pag-(:num)'] = "restaurador/vistaRegistroRestaurador/$1/1";
$route['restaurador/guarda-restaurante'] = "restaurador/guardarRestaurante";
$route['acceso/restaurador/panel-restaurador'] = "restaurador/index";
$route['acceso/restaurador/panel-restaurador-restaurante'] = "restaurador/index_url";
$route['acceso/restaurador/actualizar-restaurador'] = "restaurador/actualizarDatosRestaurador";
$route['acceso/restaurador/actualizar-restaurante'] = "restaurador/actualizarDatosRestaurante";
$route['acceso/restaurador/actualizar-pdf-restaurante'] = "restaurador/actualizarPdfRestaurante";
$route['confirmar-registro-propietario'] = "restaurador/comprobarRegistro";
$route['confirmar-nuevo-email'] = "restaurador/confirmarNuevoEmail";

/* Gestión de Menus */
$route['acceso/restaurador/anadir-tipo-menu'] = "restaurador/anadirNuevoMenu";
$route['acceso/restaurador/obtener-tipo-menu'] = "restaurador/obtenerTipoMenuJSON";
$route['acceso/restaurador/eliminar-tipo-menu'] = "restaurador/eliminarMenu";
$route['acceso/restaurador/anadir-platos-tipo-menu'] = "restaurador/anadirPlatosTipoMenu";
$route['acceso/restaurador/anadir-menu-habitual'] = "restaurador/anadirMenuHabitual";

$route['acceso/restaurador/mostrar-menu-habitual'] = "restaurador/mostrarMenuHabitual";
$route['acceso/restaurador/eliminar-menu-habitual'] = "restaurador/eliminarMenuHabitual";
$route['acceso/restaurador/seleccionar-menu-habitual'] = "restaurador/selecctionarMenuHabitualJSON";

/* Acciones del restaurador y sus restaurantes */
$route['acceso/restaurador/actualizar-categorias'] = "restaurador/editarCategoriasRestaurante";
$route['acceso/restaurador/alta-restaurante-plan'] = "restaurador/altaRestaurantePlan";
$route['acceso/restaurador/alta-restaurante/(:any)'] = "restaurador/registroRestaurante/$1";
$route['acceso/restaurador/alta-restaurante-2/(:any)/(:any)'] = "restaurador/registroRestaurante2/$1/$2";
$route['acceso/restaurador/alta-restaurante-3'] = "restaurador/altaRestaurante3";
$route['acceso/restaurador/alta-restaurante-3/(:any)'] = "restaurador/altaRestaurante4/$1";
$route['acceso/restaurador/alta-restaurante'] = "restaurante/index";
$route['registro-restaurante'] = "restaurante/altaRestaurante";
$route['acceso/restaurador/alta-restaurante-2'] = "restaurante/altaDatosRestaurante";
$route['registro-restaurante-2'] = "restaurante/altaRestaurante2";


/**********************************************************/
//$route['acceso/restaurador/alta-imagenes'] = "imagenes/altaImagenesRestaurante";
$route['acceso/restaurador/alta-imagenes/(:any)'] = "restaurador/altaImagenesRestaurante/$1";
$route['acceso/restaurador/cargar-imagenes-ajax'] = "imagenes/dameImagenesRestaurantes";
/**********************************************************/



$route['acceso/restaurador/eliminar-restaurante'] = "restaurante/eliminarRestaurante";

$route['acceso/franquiciado/eliminar-restaurante'] = "restaurante/eliminarFranquiciadoRestaurante";



/* Acciones especilidades del restaurante */
$route['acceso/restaurador/eliminar-especialidad'] = "restaurador/eliminarEspecialidad";
$route['acceso/restaurador/anadir-especialidad'] = "restaurador/anadirEspecialidad";

/* Acciones punto de interes del restaurante */
$route['acceso/restaurador/eliminar-puntos-interes'] = "restaurador/eliminarPuntoInteres";
$route['acceso/restaurador/anadir-puntos-interes'] = "restaurador/anadirPuntoInteres";

/* Acciones Razón social del Restaurante */
$route['acceso/restaurador/editar-razon-social'] = "restaurador/editarDatosFacturacion";

/* Acciones con el plan contratado */
$route['acceso/restaurador/editar-plan-contratado'] = "restaurador/editarPlanContratado";


/* Acciones de los cupones */
$route['acceso/restaurador/anadir-cupon'] = "restaurador/anadirCuponRestaurante";
$route['acceso/restaurador/editar-cupon'] = "restaurador/editarCuponRestaurante";
$route['acceso/restaurador/eliminar-cupon'] = "restaurador/eliminarCuponRestaurante";

/* Acciones de los trenes */
$route['acceso/restaurador/registro-metro'] = "restaurador/altaEstacion";


//Recordar Contraseña
$route['recordar-password'] = "usuario/recordarPassword";


/******************************************************************************/
/************************* Panel control Franquiciado *************************/
$route['acceso/franquiciado/panel-franquiciado'] = "franquiciado/index";
$route['acceso/franquiciado/panel-franquiciado-gestion-propietarios'] = "franquiciado/vistaPanelPropietarios";
$route['acceso/franquiciado/panel-franquiciado-gestion-propietarios-url'] = "franquiciado/vistaPanelPropietariosUrl";



$route['acceso/franquiciado/panel-franquiciado-gestion-restaurantes'] = "franquiciado/vistaPanelRestaurantes";



/* Editamos los datos del franquiciado */
$route['acceso/franquiciado/editar-datos-franquiciado'] = "franquiciado/editarDatosFranquiciado";
$route['acceso/franquiciado/editar-password-franquiciado'] = "franquiciado/editarPasswordFranquiciado";

/* Eliminar CP asignado al Franquiciado por el Administrador */
$route['acceso/franquiciado/eliminar-cp-asignado'] = "franquiciado/eliminarCpFranquiciado";


/* Editamos los datos del propietario asignado a un Franquiciado */
$route['acceso/franquiciado/editar-datos-propietario-franquiciado'] = "franquiciado/editarDatosPropietarioFranquiciado";
$route['acceso/franquiciado/editar-password-franquiciado-propietario'] = "franquiciado/editarPasswordPropietarioFranquiciado";
/* Buscamos un propietario - Desde el panel del Franquiciado */
$route['acceso/franquiciado/buscar-propietario-franquiciado'] = "franquiciado/buscadorPropietariosFranquiciado";




/* Mostramos la vista del Alta de Propietarios */
$route['acceso/franquiciado/alta-propietario-franquiciado-plan'] = "franquiciado/vistaAltaPropietariosPlan";

//$route['acceso/franquiciado/alta-propietario-franquiciado'] = "franquiciado/vistaAltaPropietarios";
$route['acceso/franquiciado/alta-propietario-franquiciado/(:any)'] = "franquiciado/vistaAltaPropietarios/$1";
$route['acceso/franquiciado/registro-propietario-franquiciado'] = "franquiciado/altaPropietariosFranquiciado";

//$route['acceso/franquiciado/alta-propietario-franquiciado-2'] = "franquiciado/vistaAltaPropietarios2";
$route['acceso/franquiciado/alta-propietario-franquiciado-2/(:any)/(:any)'] = "franquiciado/vistaAltaPropietarios2/$1/$2";
//$route['acceso/franquiciado/registro-propietario-franquiciado-2'] = "franquiciado/altaPropietariosFranquiciado2";

//$route['acceso/franquiciado/alta-propietario-franquiciado-3'] = "franquiciado/vistaAltaPropietarios3";
$route['acceso/franquiciado/alta-propietario-franquiciado-3/(:any)/(:any)'] = "franquiciado/vistaAltaPropietarios3/$1/$2";
$route['acceso/franquiciado/registro-propietario-franquiciado-3'] = "franquiciado/altaPropietariosFranquiciado3";

//$route['acceso/franquiciado/alta-propietario-franquiciado-4'] = "franquiciado/vistaAltaPropietarios4";
$route['acceso/franquiciado/alta-propietario-franquiciado-4/(:any)'] = "franquiciado/vistaAltaPropietarios4/$1";
$route['acceso/franquiciado/registro-propietario-franquiciado-4'] = "franquiciado/altaPropietariosFranquiciado4";

/* Alta Franquiciado -> Esta parte es la de que un Franquiciado asigna un nuevo restaurante a un Propietario */
$route['acceso/franquiciado/alta-propietario-restaurante-plan/(:any)'] = "franquiciado/vistaAltaRestaurantePlan/$1";

$route['acceso/franquiciado/alta-propietario-restaurante'] = "franquiciado/vistaAltaRestaurante2";
/******************************************************************************/





/* Validación de Email */
$route['existe-email'] = "usuario/existeEmail";



/* Mensajes de Soporte técnico */
$route['acceso/restaurador/mensaje-soporte-tecnico'] = "emailing/emailSoportTecnicoPanelRestaurador";
$route['mensaje-usuario-soporte-tecnico'] = "emailing/emailSoportTecnicoPanelUsuario";


/* Hacer reserva desde la web */
$route['reservar'] = "emailing/reservar";


/* End of file routes.php */
/* Location: ./application/config/routes.php */