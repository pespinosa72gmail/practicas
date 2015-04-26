<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="es"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="es"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="es"> <!--<![endif]-->
    <head>

        <meta charset="utf-8">
        <title><?php echo $title; ?></title>
        <meta name="description" content="Tu portal de búsqueda de menús diarios">
        <meta name="author" content="www.nablae.es">
        <meta name="distribution" content="global">
        <meta name="resource-type" content="document">
        <meta name="robots" content="all">
        <meta name="REVISIT-AFTER" content="7 days">
        <meta http-equiv="CACHE-CONTROL" content="NO-CACHE">

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>


        <!-- Meta específico para móvil -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Estilo principal -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

        <!-- Estilo color yema "todoslosmenus" -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/yema.css">

        <!-- Estilo responsive -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.css">

        <!-- Mis Stylos -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ajustes.css">

        <!-- Mis Stylos -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/mystyle.css">

        <!-- Favicons -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">


        <!-- DropZone -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dropzone/css/dropzone.css">

        <!-- jQuery UI -->
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/jquery.validate.js"></script>



        <?php if ($robots) { ?>
            <meta name="robots" content="<?php echo $robots; ?>" />
        <?php } else { ?>
            <meta name="robots" content="NOINDEX, NOFOLLOW" />
        <?php } ?>

        <link rel="canonical" href="<?php echo current_url(); ?>" />

        <!-- Verification Web Master Tools -->
        <meta name="google-site-verification" content="w1eibqjQhKAWtHgbON6FkVkvRt3PbwicwfWzdjUHANY" />
        
        <!-- Facebook -->
        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta property="og:description" content="<?php echo $description; ?>" />
        <meta property="og:image" content="<?php echo base_url(); ?>" />
        <meta property="og:site_name" content="<?php echo $title; ?>" />
        <meta property="og:type" content="#" lang="es" />

        <!-- Twitter -->
        <meta name="twitter:title" content="<?php echo $title; ?>" />
        <meta name="twitter:description" content="<?php echo $description; ?>" />
        <meta name="twitter:image" content="<?php echo base_url(); ?>" />
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@nablae" />
        <meta name="twitter:creator" content="@nablae" />

        <!-- G+ -->
        <meta itemprop="title" content="<?php echo $title; ?>" /> 
        <meta itemprop="name" content="<?php echo $title; ?>" /> 
        <meta itemprop="description" content="<?php echo $description; ?>" /> 
        <meta itemprop="image" content="<?php echo base_url(); ?>" />

        <!-- SEO Content -->
        <meta property="og:locale:alternate" content="es_ES" />
        <meta content="global" name="distribution" />
        <meta name="Locality" content="ES" />
        <!-- Fin SEO Content -->

    </head>
    <body>



        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&appId=87818691546&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>




        <div class="loader"><div class="loader_html"></div></div>

        <div id="wrap" class="fixed-enabled grid_1200">

            <header id="header-top">
                <div class="container clearfix">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            /* Formato de fechas */
                            $dias = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
                            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

                            $fecha = "Hoy es " . $dias[date('w')] . ", " . date('d') . " de " . $meses[date('n') - 1] . " de " . date('Y');
                            ?>
                            <div class="fecha"><i class="fa fa-table"></i><?php echo strftime($fecha); ?></div>
                        </div>
                        <div class="col-md-6">
                            <div class="social-ul">
                                <ul>
                                    <li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li class="social-youtube"><a href="#"><i class="fa fa-youtube-play"></i></a></li>
                                    <li class="social-instagram"><a href="#"><i class="fa fa-instagram"></i></a></li><!--
                                    <li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>
                                    <li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li class="social-dribbble"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                    <li class="social-rss"><a href="#"><i class="fa fa-rss"></i></a></li>-->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div><!-- FIN container -->
            </header><!-- FIN header -->
            <header id="header-main">
                <div class="container clearfix">
                    <div class="header-search">


<?php if ($this->session->userdata('ingresado') === FALSE) { ?>
                            <div class="header-search-a"><i class="fa fa-user"></i><span>&nbsp;&nbsp;Iniciar sesión</span></div>
                            <div class="header-search-form">
                                <form id="form_login" action="<?php echo base_url('login'); ?>" method="post">
                                    <input type="text" name="email_user" placeholder="Email">
                                    <input type="password" name="pass_user" placeholder="Password">
                                    <div class="form-input">
                                        <input id="recordar-password" type="checkbox"><label class="recordar-pass-login">Recordar contraseña</label>
                                    </div>
                                    <div id="mensaje_login"></div>
                                    <div class="submit-login">
                                        <input id="submit_form_login" type="submit" value="Entrar" />
                                        <!--<a href="#">Entrar <span><i class="fa fa-arrow-circle-right"></i></span></a>-->
                                    </div>
                                    <div class="registrate-login">
                                        <a href="<?php echo base_url(); ?>/registro-usuario"><span><i class="fa fa-arrow-circle-right"></i></span> Registrate</a>
                                    </div>
                                </form>
                            </div>

                            <?php } else { ?>

                            <div class="bienvenida">
    <?php if ($this->session->userdata('usuario') == TRUE) { ?>
        <?php /* Cuando ingresa un usuario */ ?>
                                    <i class="fa fa-user"></i><span>&nbsp;&nbsp;Bienvenido <?php echo $this->session->userdata('nombre_usuario') ?></span>
                                    <br>
                                    <i class="fa fa-gears"></i>&nbsp;&nbsp;<a href="<?php echo base_url('panel-usuario'); ?>" class="amarillo">Panel de control</a>

    <?php } else if ($this->session->userdata('restaurador') == TRUE) { ?>
        <?php /* Cuando ingresa un propietario/restaurador */ ?>
                                    <i class="fa fa-user"></i><span>&nbsp;&nbsp;Bienvenido <?php echo $this->session->userdata('nombre_propietario') ?></span>
                                    <br>

                                    <i class="fa fa-gears"></i>&nbsp;&nbsp;<a href="<?php echo base_url('acceso/restaurador/panel-restaurador'); ?>" class="amarillo">Panel de control</a>

    <?php } else if ($this->session->userdata('franquiciado') == TRUE) { ?>
        <?php /* Cuando ingresa un franquiciado */ ?>
                                    <i class="fa fa-user"></i><span>&nbsp;&nbsp;Bienvenido <?php echo $this->session->userdata('nombre_franquiciado') ?></span>
                                    <br>

                                    <i class="fa fa-gears"></i>&nbsp;&nbsp;<a href="<?php echo base_url('acceso/franquiciado/panel-franquiciado'); ?>" class="amarillo">Panel de control</a>

    <?php } ?>

                                &nbsp;|&nbsp;<i class="fa fa-power-off"></i>&nbsp;&nbsp;<a href="<?php echo base_url(); ?>logout" class="amarillo">Salir</a>
                            </div>

<?php } ?>


                    </div>
                    <nav class="navigation">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                            <li><a href="<?php echo base_url('sobre-todoslosmenus'); ?>">Sobre Todoslosmenus</a></li>
                            <li><a href="<?php echo base_url('eres-restaurador'); ?>">¿Eres restaurador?</a></li>
                            <li><a href="<?php echo base_url('faqs'); ?>">FAQs</a></li>
                            <li><a href="<?php echo base_url('franquiciate'); ?>">Franquíciate</a></li>
                            <li><a href="<?php echo base_url('contactanos'); ?>">Contáctanos</a></li>
                            <li><a href="<?php echo base_url('registro-usuario'); ?>">Regístrate gratis</a></li>
                            <li><a href="<?php echo base_url('club-tlm'); ?>">Club TLM</a></li>
                        </ul>
                    </nav><!-- FIN navigation -->
                </div><!-- FIN container -->
            </header><!-- FIN header -->






            <div class="buscador toggle-accordion">
                <!-- Breadcrumbs-->
                <div class="container">
                    <div class="row padding15">
                        <div class="crumbs">

<?php if ((current_url() !== base_url())) { ?>

                                <div class="enlaceplegarbuscador">
                                    <i class="fa fa-plus"></i>&nbsp;<a href="#" id="textoenlaceplegarbuscador">Mostrar buscador</a>
                                </div>

<?php } ?>

                            Estás en: <?php echo $this->breadcrumbs->show(); ?>
                        </div>
                    </div>
                </div>
                <!-- FIN Breadcrumbs -->



                <?php
                //echo 'variables: ' . 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] .'-'. base_url();
                //if((!strstr($_SERVER['PHP_SELF'], base_url())) && ($_SERVER['PHP_SELF']!=''))
                if (base_url() != 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']) {
                    ?>
                    <div class="plegarbuscador">
                    <?php $this->load->view('plantillas/front_end/buscador'); ?>
                    </div>
<?php } ?>

            </div>
            <div class="clear">