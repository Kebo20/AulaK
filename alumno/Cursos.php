<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<!-- BEGIN: Head-->
<?php require("Head.php") ?>
<!-- END: Head-->


<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout content-detached-left-sidebar app-contacts  fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="content-detached-left-sidebar">

    <!-- BEGIN: Header-->
    <?php require("Header.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php require("Menu.php") ?>
    <!-- END: Main Menu-->


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-header row">
            <div class="content-header-light col-12">
                <div class="row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <h3 class="content-header-title">Gallery Hover Effects</h3>
                        <div class="row breadcrumbs-top">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Gallery</a>
                                    </li>
                                    <li class="breadcrumb-item active">Gallery Hover Effects
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">


                <!-- Hover Effects -->
                <section id="hover-effects" class="">

                    <div class="card-content collapse show">

                        <div class="card-body my-gallery" itemscope itemtype="http://schema.org/ImageGallery">


                            <div class="grid-hover row">
                           
                                <div class="col-lg-4 col-12">

                                    <figure class="effect-sarah">
                                        
                                            <img src="https://image.freepik.com/vector-gratis/fondo-dibujos-animados-elementos-matematicas_23-2148158378.jpg" alt="img13" />
                                       
                                        <figcaption>
                                            <h2><b>Álgebra</b></h2>
                                            <p></p>
                                            <a href="Curso.php">Ver más</a>
                                        </figcaption>
                                         
                                    </figure>

                                </div>
                                
                                <div class="col-lg-4 col-12">
                                    <figure class="effect-sarah">
                                        <img src="https://image.freepik.com/vector-gratis/fondo-dibujos-animados-concepto-matematicas_23-2148159114.jpg" alt="img20" />
                                        <figcaption>
                                            <h2><b>Álgebra</b></h2>
                                            <p></p>
                                            <a href="#">View more</a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <figure class="effect-sarah">
                                        <img src="https://image.freepik.com/vector-gratis/fondo-dibujos-animados-elementos-matematicas_23-2148157842.jpg" alt="img20" />
                                        <figcaption>
                                            <h2><b>Álgebra</b></h2>
                                            <p></p>
                                            <a href="#">View more</a>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <figure class="effect-sarah">
                                        <img src="https://image.freepik.com/vector-gratis/fondo-dibujos-animados-elementos-matematicas_23-2148157842.jpg" alt="img20" />
                                        <figcaption>
                                            <h2><b>Álgebra</b> <i class="la la-edit white"></i></h2>
                                            <p></p>
                                            <a href="#">View more</a>
                                        </figcaption>

                                    </figure>

                                </div>
                            </div>


                        </div>
                    </div>
                    <!--/ Image grid -->
                </section>
                <!--/ Hover Effects -->

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php require("Footer.php") ?>

</body>
<!-- END: Body-->

</html>