<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/mapmarker.jquery.js"></script>



<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>-->
<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/infobox/src/infobox.js"></script>


<!--
<script type="text/javascript">
                // Use below link if you want to get latitude & longitude
                // http://www.findlatitudeandlongitude.com/find-address-from-latitude-and-longitude.php
                
                $(document).ready(function(){
                        var myMarkers = {"markers": [
                                        {"latitude": "40.4238043", "longitude":"-3.6946642999999995", "icon":"./assets/images/balloon01.png", "baloon_text": '<img class=\'miniaturamapa\' src=\'/assets/images/restaurantes/00001_Restaurante01/principal.jpg\'/><span class=\'titulo\'>Restaurante 01</span><br>Plaza de Las Salesas, 8 <br>Madrid<br>Tel. 91 319 67 42<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'},

                                        {"latitude": "40.4390327", "longitude":"-3.714456899999959", "icon": "./assets/images/balloon01.png", "baloon_text": '<img class=\'miniaturamapa\' src=\'/assets/images/restaurantes/00002_Restaurante02/principal.jpg\'/><span class=\'titulo\'>Restaurante 02</span><br>Cea Bermúdez, 62<br>Madrid<br>Tel. 91 441 38 95<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'},

                                        {"latitude": "40.4141853", "longitude":"-3.698710500000061", "icon": "./assets/images/balloon01.png", "baloon_text": '<img src=\'/assets/images/restaurantes/00003_Restaurante03/principal.jpg\'/><span class=\'titulo\'>Restaurante 03</span><br>León, 9<br>Madrid<br>Tel. 91 369 05 87<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'},

                                        {"latitude": "40.42773090000001", "longitude":"-3.685800200000017", "icon": "./assets/images/balloon01.png", "baloon_text": '<img class=\'miniaturamapa\' src=\'images/restaurantes/00004_Restaurante04/principal.jpg\'/><span class=\'titulo\'>Restaurante 04</span><br>Mercado de la Paz<br>Ayala, 28<br>Madrid<br>Tel. 91 435 68 13<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'},

                                        {"latitude": "40.4722406", "longitude":"-3.6494271000000253", "icon": "./assets/images/balloon01.png", "baloon_text": '<img class=\'miniaturamapa\' src=\'images/restaurantes/00005_Restaurante05/principal.jpg\'/><span class=\'titulo\'>Restaurante 05</span><br>López de Hoyos, 182<br>Madrid<br>Tel. 91 006 34 06<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'},

                                        {"latitude": "40.4261598", "longitude":"-3.6730832000000646", "icon": "./assets/images/balloon01.png", "baloon_text": '<img class=\'miniaturamapa\' src=\'images/restaurantes/00006_Restaurante06/principal.jpg\'/><span class=\'titulo\'>Restaurante 06</span><br>Alcalá, 165<br>Madrid<br>Tel. 91 435 91 16<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'},

                                        {"latitude": "40.4157983", "longitude":"-3.6960019000000557", "icon": "./assets/images/balloon01.png", "baloon_text": '<img class=\'miniaturamapa\' src=\'images/restaurantes/00007_Restaurante07/principal.jpg\'/><span class=\'titulo\'>Restaurante 07</span><br>Plaza de las Cortes, 4<br>Madrid<br>Tel. 91 369 21 91<br><div class=\'callout-a\'><a class=\'button-3\' href=\'#\'>Ver</a></div>'}
                                ]
                        };

                        $("#map").mapmarker({
                                zoom	: 13,
                                center	: 'plaza de las salesas, madrid',
                                markers	: myMarkers
                        });

                });
        </script>


<style>

        .img_menu{
                float: left;
                position: absolute;
                padding: 0;
        }

        .uvas{
                float: left;
                position: absolute;
                width: 25px;
                height: auto;
                margin: 232px 0 0 102px;
        }

        .vinos{
                float: left;
                position: absolute;
                width: 25px;
                height: auto;
                margin: 252px 0 0 136px;
        }

  #map-canvas 
  {
        width: 100%;
      height: 450px;
      margin: 0px;
      padding: 0px
  }
        
        .infobox-wrapper 
        {
        display:none;

        }

        #infobox 
        {
                max-width: 700px;
                min-width: 100px;
                width: 100%;
            font-weight: bold;
                color: #FFF;
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                padding: .1em 0 .5em 0;
                margin: 5px 0 0 0;
        }


        .infoBox img
        {
                display: none;
        }

        .infoBox img.flecha
        {
                display: block;
        }

        .flecha
        {
                float: left;
                position: absolute;
                /*top: 25px;*/
                display: block;
                margin: 5px 0 0 45px;
        }
</style>
-->





<script type="text/javascript">

    var LocationData = [
<?php foreach ($todos as $key => $listadoResultados): ?>

            ["<?php echo $listadoResultados->lat_restaurante; ?>", "<?php echo $listadoResultados->long_restaurante; ?>", '<?php echo $listadoResultados->nombre_restaurante; ?>'],
<?php endforeach; ?>

    ];

</script>





<script>

    function initialize()
    {

        var mapOptions = {
            zoom: 10,
            center: new google.maps.LatLng(<?php echo "$centroLat, $centroLong" ?>),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            panControl: false,
            zoomControl: false,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL
            },
            scaleControl: true
        }

        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
        var bounds = new google.maps.LatLngBounds(<?php //echo "$minLat, $minLong"     ?>), infobox, marker;

var prueba = 1;
        for (var i in LocationData)
        {
            var p = LocationData[i];
            var latlng = new google.maps.LatLng(p[0], p[1]);
            //alert(p[0]+p[2]);
            bounds.extend(latlng);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                visible: true,
                title: p[2],
                //url: p[3],
                icon: './assets/images/balloon01.png',
            });
prueba = prueba + 1;
  			var infowindow = new google.maps.InfoWindow({
            //infobox = new InfoBox({
                //content: document.getElementById("infobox"),
				
                content: 'prueba'
               /* disableAutoPan: false,
                // maxWidth: 150,
                pixelOffset: new google.maps.Size(-90, -95, 50, 0),
                // pixelOffset: new google.maps.Size(0, 0, 0, 0),

                boxStyle: {
                    // background: "url('/labuenamesa-beta/img/maps/tipbox.png') no-repeat",
                    backgroundColor: "#900",
                    border: "1px solid #fff",
                    color: "#fff",
                    opacity: 1,
                    width: "auto",
                    minWidth: "auto",
                    maxWidth: "auto",
                    height: "auto",
                    borderRadius: "3px",
                    textAlign: "center",
                    margin: "0px 0px 0px 22px",
                    //margin: "0px 0px 0px 0px",
                    padding: "0 15px",
                },
                closeBoxMargin: "3px 3px 2px 0px",
                closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                infoBoxClearance: new google.maps.Size(1, 1)*/
            });

            google.maps.event.addListener(marker, 'mouseover', function () {
                $('#infobox').html(this.title).css({display: "block"});
                $('#infobox').append('<img class="flecha" src="./maps/tipbox.png" alt="flecha" />');

                infobox.open(map, this);
            });

            google.maps.event.addListener(marker, 'click', function ()
            {
                window.open(this.url, "_blank");
            });

        }
        if (LocationData.length) {
            //alert('seteando el centro');
            map.fitBounds(bounds);
            map.setCenter(bounds.getCenter());

            //Limitamos el zoom a 15
            google.maps.event.addListener(map, 'zoom_changed', function () {
                if (map.getZoom()>18){
                    map.setzoom(18);
                }
            });
        }
    }

    google.maps.event.addDomListener(window, 'load', initialize);


</script>








<section class="sections">
    <div class="container">
        <div id="map" class="resultadomapa"></div>
    </div>
</div>

<div class="sections">
    <div class="container">
        <div class="sections-title">
            <div class="sections-title-h3"><h3 class="grisoscuro">Resultados búsqueda</h3></div>	
        </div>
        <div class="row">
            <div class="col-md-12 main-content">

                <div class="row">
                    <div class="col-md-12 protfolio-filter">
                        <ul id="filtro">
                            <li class="current"><a data-filter=".todas1, .paginador-todas1" href="#">Todas</a></li>
                            <li><a data-filter=".baratas1, .paginador-baratas1" href="#">Más baratas</a></li>
                            <li><a data-filter=".caras1, .paginador-caras1" href="#">Más caras</a></li>
                            <li><a data-filter=".mejorvaloradas1, .paginador-valoradas1" href="#">Mejor valoradas</a></li>
                        </ul>
                    </div>
                </div>

                <!-- PORTFOLIO -->
                <div class="row portfolio-all portfolio-0">
                    <ul>
                        <?php
                        $items_por_pagina = 3;
                        if ($todos or $baratos or $caros or $mejorvalorados) {
                            ?>
                            <?php
                            $num_pagina = 1;
                            $num_items = 0;
                            foreach ($todos as $key => $value) {
                                $num_items ++;
                                ?>
        <?php $url = base_url() . "restaurante/" . $value->slug_restaurante; ?>
                                <li class="col-md-4 todas<?php echo $num_pagina; ?> portfolio-item isotope-item">
                                    <div class="portfolio-one">

                                        <div class="portfolio-content">
                                            <img class="miniatura" src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/<?php echo $value->logo_restaurante; ?>" />
                                            <div class="portfolio-meta listadoresultadosbusqueda">

                                                <div class="portfolio-name">
                                                    <h6>
                                                        <a href="<?php echo $url; ?>"><?php echo $value->nombre_restaurante; ?></a>
                                                    </h6>
                                                </div>

                                                <div class="portfolio-item"><strong>Municipio</strong>: <?php echo $value->nombre_localidad; ?></div>
                                                <div class="portfolio-item"><strong>Categoría</strong>: <?php echo $value->nombre_categoria; ?></div>
                                                <div class="portfolio-item"><strong>Precio menú</strong>: <?php echo $value->precio_medio_restaurante; ?>€</div>

                                                <div class="portfolio-item"><strong>Menú</strong>: 
                                                    Primeros 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($todosPrimerosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_primeros_menu);
                                                        $l++;
                                                    }
                                                    ?>), 
                                                    Segundos 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($todosSegundosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_segundo_menu);
                                                        $l++;
                                                    }
                                                    ?>)
                                                    <?php
                                                    if ($value->pan_menu) {
                                                        if (!$value->bebida_menu && !$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'pan';
                                                    }
                                                    if ($value->bebida_menu) {
                                                        if (!$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'bebida';
                                                    }
                                                    if ($value->postre_menu) {
                                                        if (!$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'postre';
                                                    }
                                                    if ($value->cafe_menu) {
                                                        echo ' y café';
                                                    }

                                                    echo '.';
                                                    ?>
                                                </div>

                                                <div class="portfolio-item"><strong>Valoración</strong>: 
                                                    <?php
                                                    for ($v = 1; $v < 6; $v++) {
                                                        if ($v <= $value->global_valoracion) {
                                                            echo '<i class="fa fa-star"></i>';
                                                        } else {
                                                            echo '<i class="fa fa-star-o"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </div>

                                                <div class="enlacefavorito"><span><i class="fa fa-star"></i></span><a href="#">Marcar favorito</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if ($num_items == $items_por_pagina) {
                                    $num_pagina ++;
                                    $num_items = 0;
                                }
                            }//foreach
                            ?> 

                            <?php
                            $num_pagina = 1;
                            $num_items = 0;
                            foreach ($baratos as $key => $value) {
                                $num_items ++;
                                ?>
        <?php $url = base_url() . "restaurante/" . $value->slug_restaurante; ?>
                                <li class="col-md-4 baratas<?php echo $num_pagina; ?> portfolio-item isotope-item">
                                    <div class="portfolio-one">

                                        <div class="portfolio-content">
                                            <img class="miniatura" src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/<?php echo $value->logo_restaurante; ?>" />
                                            <div class="portfolio-meta listadoresultadosbusqueda">

                                                <div class="portfolio-name">
                                                    <h6>
                                                        <a href="<?php echo $url; ?>"><?php echo $value->nombre_restaurante; ?></a>
                                                    </h6>
                                                </div>

                                                <div class="portfolio-item"><strong>Municipio</strong>: <?php echo $value->nombre_localidad; ?></div>
                                                <div class="portfolio-item"><strong>Categoría</strong>: <?php echo $value->nombre_categoria; ?></div>
                                                <div class="portfolio-item"><strong>Precio menú</strong>: <?php echo $value->precio_medio_restaurante; ?>€</div>

                                                <div class="portfolio-item"><strong>Menú</strong>: 
                                                    Primeros 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($baratosPrimerosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_primeros_menu);
                                                        $l++;
                                                    }
                                                    ?>), 
                                                    Segundos 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($baratosSegundosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_segundo_menu);
                                                        $l++;
                                                    }
                                                    ?>)
                                                    <?php
                                                    if ($value->pan_menu) {
                                                        if (!$value->bebida_menu && !$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'pan';
                                                    }
                                                    if ($value->bebida_menu) {
                                                        if (!$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'bebida';
                                                    }
                                                    if ($value->postre_menu) {
                                                        if (!$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'postre';
                                                    }
                                                    if ($value->cafe_menu) {
                                                        echo ' y café';
                                                    }

                                                    echo '.';
                                                    ?>
                                                </div>

                                                <div class="portfolio-item"><strong>Valoración</strong>: 
                                                    <?php
                                                    for ($v = 1; $v < 6; $v++) {
                                                        if ($v <= $value->global_valoracion) {
                                                            echo '<i class="fa fa-star"></i>';
                                                        } else {
                                                            echo '<i class="fa fa-star-o"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if ($num_items == $items_por_pagina) {
                                    $num_pagina ++;
                                    $num_items = 0;
                                }
                            }//foreach
                            ?> 

                            <?php
                            $num_pagina = 1;
                            $num_items = 0;
                            foreach ($caros as $key => $value) {
                                $num_items ++;
                                ?>
        <?php $url = base_url() . "restaurante/" . $value->slug_restaurante; ?>
                                <li class="col-md-4 caras<?php echo $num_pagina; ?> portfolio-item isotope-item">
                                    <div class="portfolio-one">

                                        <div class="portfolio-content">
                                            <img class="miniatura" src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/<?php echo $value->logo_restaurante; ?>" />
                                            <div class="portfolio-meta listadoresultadosbusqueda">

                                                <div class="portfolio-name">
                                                    <h6>
                                                        <a href="<?php echo $url; ?>"><?php echo $value->nombre_restaurante; ?></a>
                                                    </h6>
                                                </div>

                                                <div class="portfolio-item"><strong>Municipio</strong>: <?php echo $value->nombre_localidad; ?></div>
                                                <div class="portfolio-item"><strong>Categoría</strong>: <?php echo $value->nombre_categoria; ?></div>
                                                <div class="portfolio-item"><strong>Precio menú</strong>: <?php echo $value->precio_medio_restaurante; ?>€</div>

                                                <div class="portfolio-item"><strong>Menú</strong>: 
                                                    Primeros 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($carosPrimerosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_primeros_menu);
                                                        $l++;
                                                    }
                                                    ?>), 
                                                    Segundos 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($carosSegundosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_segundo_menu);
                                                        $l++;
                                                    }
                                                    ?>)
                                                    <?php
                                                    if ($value->pan_menu) {
                                                        if (!$value->bebida_menu && !$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'pan';
                                                    }
                                                    if ($value->bebida_menu) {
                                                        if (!$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'bebida';
                                                    }
                                                    if ($value->postre_menu) {
                                                        if (!$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'postre';
                                                    }
                                                    if ($value->cafe_menu) {
                                                        echo ' y café';
                                                    }

                                                    echo '.';
                                                    ?>
                                                </div>

                                                <div class="portfolio-item"><strong>Valoración</strong>: 
                                                    <?php
                                                    for ($v = 1; $v < 6; $v++) {
                                                        if ($v <= $value->global_valoracion) {
                                                            echo '<i class="fa fa-star"></i>';
                                                        } else {
                                                            echo '<i class="fa fa-star-o"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if ($num_items == $items_por_pagina) {
                                    $num_pagina ++;
                                    $num_items = 0;
                                }
                            }//foreach
                            ?> 

                            <?php
                            $num_pagina = 1;
                            $num_items = 0;
                            foreach ($mejorvalorados as $key => $value) {
                                $num_items ++;
                                ?>
        <?php $url = base_url() . "restaurante/" . $value->slug_restaurante; ?>
                                <li class="col-md-4 mejorvaloradas<?php echo $num_pagina; ?> portfolio-item isotope-item">
                                    <div class="portfolio-one">

                                        <div class="portfolio-content">
                                            <img class="miniatura" src="<?php echo base_url(); ?>assets/images/restaurantes/00001_Restaurante01/<?php echo $value->logo_restaurante; ?>" />
                                            <div class="portfolio-meta listadoresultadosbusqueda">

                                                <div class="portfolio-name">
                                                    <h6>
                                                        <a href="<?php echo $url; ?>"><?php echo $value->nombre_restaurante; ?></a>
                                                    </h6>
                                                </div>

                                                <div class="portfolio-item"><strong>Municipio</strong>: <?php echo $value->nombre_localidad; ?></div>
                                                <div class="portfolio-item"><strong>Categoría</strong>: <?php echo $value->nombre_categoria; ?></div>
                                                <div class="portfolio-item"><strong>Precio menú</strong>: <?php echo $value->precio_medio_restaurante; ?>€</div>

                                                <div class="portfolio-item"><strong>Menú</strong>: 
                                                    Primeros 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($valoradosPrimerosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_primeros_menu);
                                                        $l++;
                                                    }
                                                    ?>), 
                                                    Segundos 
                                                    (<?php
                                                    $l = 0;
                                                    foreach ($valoradosSegundosBuscador[$key] as $primeros) {
                                                        if ($l > 0) {
                                                            echo ', ';
                                                        }
                                                        echo strtolower($primeros->nombre_segundo_menu);
                                                        $l++;
                                                    }
                                                    ?>)
                                                    <?php
                                                    if ($value->pan_menu) {
                                                        if (!$value->bebida_menu && !$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'pan';
                                                    }
                                                    if ($value->bebida_menu) {
                                                        if (!$value->postre_menu && !$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'bebida';
                                                    }
                                                    if ($value->postre_menu) {
                                                        if (!$value->cafe_menu) {
                                                            echo ' y ';
                                                        } else {
                                                            echo ', ';
                                                        }
                                                        echo 'postre';
                                                    }
                                                    if ($value->cafe_menu) {
                                                        echo ' y café';
                                                    }

                                                    echo '.';
                                                    ?>
                                                </div>

                                                <div class="portfolio-item"><strong>Valoración</strong>: 
                                                    <?php
                                                    for ($v = 1; $v < 6; $v++) {
                                                        if ($v <= $value->global_valoracion) {
                                                            echo '<i class="fa fa-star"></i>';
                                                        } else {
                                                            echo '<i class="fa fa-star-o"></i>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                if ($num_items == $items_por_pagina) {
                                    $num_pagina ++;
                                    $num_items = 0;
                                }
                            }//foreach
                            ?> 


                        <?php } else { ?>
                            <p style="text-align: center;">No se han encontrado restaurantes en la localización elegida. Te mostramos otros resultados de búsqueda.</p>
<?php } ?>
                    </ul>
                </div> 
                <!-- FIN PORTFOLIO -->

                <div class="pagination protfolio-filter">
                    <?php
                    $num_pagina --;
                    for ($p = 1; $p <= $num_pagina; $p++) {
                        if ($p > 1) {
                            $p_prev = $p - 1;
                        } else {
                            $p_prev = 1;
                        }
                        if ($p < $num_pagina) {
                            $p_next = $p + 1;
                        } else {
                            $p_next = $num_pagina;
                        }
                        ?>
                        <ul class="paginador-todas<?php echo $p; ?> isotope-item">
                            <li class="pagination-prev"><a href="#" data-filter=".todas<?php echo $p_prev; ?>, .paginador-todas<?php echo $p_prev; ?>"><i class="fa fa-angle-left"></i></a></li>
                            <?php
                            for ($p2 = 1; $p2 <= $num_pagina; $p2++) {
                                ?>
                                <li<?php if ($p == $p2) { ?> class="seleccionada"<?php } ?>><a data-filter=".todas<?php echo $p2; ?>, .paginador-todas<?php echo $p2; ?>" href="#"><?php echo $p2; ?></a></li>
    <?php } ?>
                            <li class="pagination-next"><a href="#" data-filter=".todas<?php echo $p_next; ?>, .paginador-todas<?php echo $p_next; ?>"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                        <?php
                    }

                    for ($p = 1; $p <= $num_pagina; $p++) {
                        if ($p > 1) {
                            $p_prev = $p - 1;
                        } else {
                            $p_prev = 1;
                        }
                        if ($p < $num_pagina) {
                            $p_next = $p + 1;
                        } else {
                            $p_next = $num_pagina;
                        }
                        ?>
                        <ul class="paginador-baratas<?php echo $p; ?> isotope-item">
                            <li class="pagination-prev"><a href="#" data-filter=".baratas<?php echo $p_prev; ?>, .paginador-baratas<?php echo $p_prev; ?>"><i class="fa fa-angle-left"></i></a></li>
                            <?php
                            for ($p2 = 1; $p2 <= $num_pagina; $p2++) {
                                ?>
                                <li<?php if ($p == $p2) { ?> class="seleccionada"<?php } ?>><a data-filter=".baratas<?php echo $p2; ?>, .paginador-baratas<?php echo $p2; ?>" href="#"><?php echo $p2; ?></a></li>
    <?php } ?>
                            <li class="pagination-next"><a href="#" data-filter=".baratas<?php echo $p_next; ?>, .paginador-baratas<?php echo $p_next; ?>"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                        <?php
                    }

                    for ($p = 1; $p <= $num_pagina; $p++) {
                        if ($p > 1) {
                            $p_prev = $p - 1;
                        } else {
                            $p_prev = 1;
                        }
                        if ($p < $num_pagina) {
                            $p_next = $p + 1;
                        } else {
                            $p_next = $num_pagina;
                        }
                        ?>
                        <ul class="paginador-caras<?php echo $p; ?> isotope-item">
                            <li class="pagination-prev"><a href="#" data-filter=".caras<?php echo $p_prev; ?>, .paginador-caras<?php echo $p_prev; ?>"><i class="fa fa-angle-left"></i></a></li>
                            <?php
                            for ($p2 = 1; $p2 <= $num_pagina; $p2++) {
                                ?>
                                <li<?php if ($p == $p2) { ?> class="seleccionada"<?php } ?>><a data-filter=".caras<?php echo $p2; ?>, .paginador-caras<?php echo $p2; ?>" href="#"><?php echo $p2; ?></a></li>
    <?php } ?>
                            <li class="pagination-next"><a href="#" data-filter=".caras<?php echo $p_next; ?>, .paginador-caras<?php echo $p_next; ?>"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                        <?php
                    }

                    for ($p = 1; $p <= $num_pagina; $p++) {
                        if ($p > 1) {
                            $p_prev = $p - 1;
                        } else {
                            $p_prev = 1;
                        }
                        if ($p < $num_pagina) {
                            $p_next = $p + 1;
                        } else {
                            $p_next = $num_pagina;
                        }
                        ?>
                        <ul class="paginador-valoradas<?php echo $p; ?> isotope-item">
                            <li class="pagination-prev"><a href="#" data-filter=".mejorvaloradas<?php echo $p_prev; ?>, .paginador-valoradas<?php echo $p_prev; ?>"><i class="fa fa-angle-left"></i></a></li>
                            <?php
                            for ($p2 = 1; $p2 <= $num_pagina; $p2++) {
                                ?>
                                <li<?php if ($p == $p2) { ?> class="seleccionada"<?php } ?>><a data-filter=".mejorvaloradas<?php echo $p2; ?>, .paginador-valoradas<?php echo $p2; ?>" href="#"><?php echo $p2; ?></a></li>
    <?php } ?>
                            <li class="pagination-next"><a href="#" data-filter=".mejorvaloradas<?php echo $p_next; ?>, .paginador-valoradas<?php echo $p_next; ?>"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
<?php } ?>
                </div>

<?php //echo $pagination       ?>

            </div>
        </div>
    </div>
</div>
