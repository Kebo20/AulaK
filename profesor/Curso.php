<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<?php require("Head.php") ?>
<!-- END: Head-->


<!-- BEGIN: Body-->

<body class="vertical-layout vertical-compact-menu material-vertical-layout material-layout content-left-sidebar todo-application  fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    <?php require("Header.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php require("Menu.php") ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="sidebar-left">
            <div class="sidebar">
                <div class="todo-sidebar d-flex">
                    <span class="sidebar-close-icon">
                        <i class="ft-x"></i>
                    </span>
                    <!-- todo app menu -->
                    <div class="todo-app-menu">
                        <div class="form-group text-center add-task">
                            <!-- new task button -->
                            <button type="button" onclick="mostrar()" class="btn btn-success btn-glow add-task-btn btn-block my-1">

                                <i class="ft-plus"></i>
                                <span>Añadir</span>
                            </button>
                        </div>
                        <!-- sidebar list start -->
                        <div class="sidebar-menu-list">
                            <div class="list-group">
                                <a href="#" class="list-group-item border-0 active">
                                    <span class="fonticon-wrap mr-50">
                                        <i class="ft-align-justify"></i>
                                    </span>
                                    <span>Ver todo</span>
                                </a>
                            </div>
                            <label class="filter-label mt-2 mb-1 pt-25">Periodos</label>
                            <div class="list-group">
                                <a href="#" id='list_1' class="list-group-item border-0" onclick="seleccionar('list_1')">
                                    <span class="fonticon-wrap mr-50">
                                        <i class="ft-check"></i>
                                    </span>
                                    <span>1° Bimestre</span>
                                </a>
                                <a href="#" class="list-group-item border-0" onclick="seleccionar()">
                                    <span class="fonticon-wrap mr-50">
                                        <i class="ft-check"></i>
                                    </span>
                                    <span>2° Bimestre</span>
                                </a>
                                <a href="#" class="list-group-item border-0" onclick="seleccionar()">
                                    <span class="fonticon-wrap mr-50">
                                        <i class="ft-check"></i>
                                    </span>
                                    <span>3° Bimestre</span>
                                </a>
                                <a href="#" class="list-group-item border-0">
                                    <span class="fonticon-wrap mr-50">
                                        <i class="ft-check"></i>
                                    </span>
                                    <span>4° Bimestre</span>
                                </a>
                            </div>
                            <label class="filter-label mt-2 mb-1 pt-25">Unidades</label>
                            <div class="list-group">
                                <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                    <span>1ra unidad</span>
                                    <span class="bullet bullet-sm bullet-primary"></span>
                                </a>
                                <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                    <span>2da unidad</span>
                                    <span class="bullet bullet-sm bullet-success"></span>
                                </a>
                                <a href="#" class="list-group-item border-0 d-flex align-items-center justify-content-between">
                                    <span>3ra unidad</span>
                                    <span class="bullet bullet-sm bullet-danger"></span>
                                </a>

                            </div>
                        </div>
                        <!-- sidebar list end -->
                    </div>
                </div>
                <!--VENTANA REGISTRAR - todo new task sidebar -->
                <div class="todo-new-task-sidebar">
                    <div class="card shadow-none p-0 m-0">
                        <div class="card-header border-bottom py-75">
                            <div class="task-header d-flex justify-content-between align-items-center">
                                <h5 class="new-task-title mb-0">Registrar sesión</h5>


                            </div>
                            <button type="button" class="close close-icon">
                                <i class="ft-x"></i>
                            </button>
                        </div>


                        <div class="modal-body">

                            <table width="100%" style="font-size:13px; font-weight:bold;">


                                <tr>

                                    <input id="emp_id" name="id" readonly="readonly" type="hidden" />
                                    <input id="valor" name="valor" readonly="readonly" type="hidden" />



                                    <td width="50%"><b>Nombre</b><br>
                                        <input type="text" id="emp_nombre" name="nombre" required class='form-control' value=""></td>

                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>

                                <tr>

                                    <td><b>Descripcion</b><br>
                                        <textarea id="emp_telefono" name="telefono" class='form-control' maxlength="9" required>
                                        </textarea>

                                    </td>

                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>

                                    <td><b>Periodo</b><br>
                                        <select id="emp_telefono" name="telefono" class='form-control' maxlength="9" required>
                                            <option>Seleccione</option>
                                        </select>

                                    </td>

                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr>

                                    <td><b>Unidad</b><br>
                                        <select id="emp_telefono" name="telefono" class='form-control' maxlength="9" required>
                                            <option>Seleccione</option>
                                        </select>

                                    </td>

                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                </tr>






                            </table>

                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-success btn-glow text-white btn-block my-1 " type="submit">
                                <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Grabar</button>
                            <button class="btn bg-secondary btn-glow text-white btn-block my-1 " type="reset" data-dismiss="modal">
                                <i class="ace-icon fa fa-times red2"></i>Cancelar</button>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <div class="content-right">
            <div class="content-header row">
            </div>
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-body">
                    <div class="app-content-overlay"></div>
                    <div class="todo-app-area">
                        <div class="todo-app-list-wrapper">
                            <div class="todo-app-list">
                                <div class="todo-fixed-search d-flex justify-content-between align-items-center">
                                    <div class="sidebar-toggle d-block d-lg-none">
                                        <i class="ft-align-justify"></i>
                                    </div>
                                    <fieldset class="form-group position-relative has-icon-left m-0 flex-grow-1 pl-2">
                                        <input type="text" class="form-control todo-search" id="todo-search" placeholder="Buscar ">
                                        <div class="form-control-position">
                                            <i class="ft-search"></i>
                                        </div>
                                    </fieldset>
                                    <div class="todo-sort dropdown mr-1">


                                        <input type="date" class="form-control">

                                    </div>
                                </div>
                                <div class="todo-task-list list-group">
                                    <!-- task list start -->
                                    <ul class="todo-task-list-wrapper list-unstyled" id="todo-task-list-drag">
                                        <li class="todo-item" data-name="David Smith" >
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <a href='Sesion.php'><p class="todo-title mx-50 m-0 truncate">Effective Hypnosis Quit Smoking🤯 Methods</p></a>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-primary badge-pill">Frontend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="John Doe">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">How To Protect🙌 Your Computer Very Useful Tips</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-2.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75 warning'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="James Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">It is a good idea to think😃 of your PC as an office.</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-primary badge-pill">Frontend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-3.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Maria Garcia">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Don't Let The Outtakes Take You Out</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-danger badge-pill ml-50">Issue</span>
                                                        <span class="badge badge-pill badge-success ml-50">Backend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-4.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75 warning'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Maria Rodrigu">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Sony laptops👨🏼‍💻 are among the most well known laptops on
                                                        today</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-5.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Marry Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Success Steps For Your Personal Or Business Life👏</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-6.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Maria Hern">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Believing Is The Absence Of Doubt😅</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-7.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Jamesh Jackson">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Are You Struggling🙄 In Life</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-danger badge-pill ml-50">Issue</span>
                                                        <span class="badge badge-pill badge-success ml-50">Backend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-8.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="David Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Hypnotherapy😎 For Motivation Getting The Drive Back</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <span class="avatar bg-primary">DS</span>
                                                    <a class='todo-item-favorite ml-75 warning'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="John Doe">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Fix Responsiveness</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-warning badge-pill ml-50">Design</span>
                                                        <span class="badge badge-primary badge-pill ml-50">Frontend</span>
                                                        <span class="badge badge-secondary badge-pill ml-50" data-tag="ISSUE,BACKEND" data-toggle="tooltip" data-placement="bottom" title="ISSUE,BACKEND">
                                                            <i class='ft-more-horizontal font-small-1'></i>
                                                        </span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-10.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="James Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Buying🥳 Used Electronic Test Equipment.</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-11.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Marry Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Get The Boot🤠 A Birds Eye Look Into Mcse Boot Camps</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-warning badge-pill">Design</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-12.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Maria Garcia">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Dealing 🤔 With Technical Support 10 Useful Tips</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-pill badge-success">Backend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-13.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Maria Rodrigu">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">How Hypnosis Can Help You</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <span class="avatar bg-success">MR</span>
                                                    <a class='todo-item-favorite ml-75 warning'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="David Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Effective Hypnosis Quit 😲 Smoking Methods</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-primary badge-pill">Frontend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-1.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="John Doe">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">How To Protect Your Computer Very Useful Tips</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-2.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="Jamesh Jackson">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Are You Struggling In Life 🕵🏻</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-danger badge-pill ml-50">Issue</span>
                                                        <span class="badge badge-pill badge-success ml-50">Backend</span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-8.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="David Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Hypnotherapy For Motivation 🤗 Getting The Drive Back</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <span class="avatar bg-primary">DS</span>
                                                    <a class='todo-item-favorite ml-75 warning'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="John Doe">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Fix Responsiveness</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex">
                                                        <span class="badge badge-warning badge-pill ml-50">Design</span>
                                                        <span class="badge badge-primary badge-pill ml-50">Frontend</span>
                                                        <span class="badge badge-secondary badge-pill ml-50" data-tag="ISSUE,BACKEND" data-toggle="tooltip" data-placement="bottom" title="ISSUE,BACKEND">
                                                            <i class='ft-more-horizontal font-small-1'></i>
                                                        </span>
                                                    </div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-10.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="todo-item" data-name="James Smith">
                                            <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                <div class="todo-title-area d-flex">
                                                    <i class='ft-more-vertical handle'></i>

                                                    <p class="todo-title mx-50 m-0 truncate">Buying Used Electronic 📺 Test Equipment.</p>
                                                </div>
                                                <div class="todo-item-action d-flex align-items-center">
                                                    <div class="todo-badge-wrapper d-flex"></div>
                                                    <div class="avatar ml-1">
                                                        <img src="app-assets/images/portrait/small/avatar-s-11.png" alt="avatar" height="30" width="30">
                                                    </div>
                                                    <a class='todo-item-favorite ml-75'><i class="ft-star"></i></a>
                                                    <a class='todo-item-delete ml-75'><i class="ft-trash-2"></i></a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- task list end -->
                                    <div class="no-results">
                                        <h5>No Items Found</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php require("Footer.php") ?>

    <script>
        function mostrar() {
            $("#ModalRegistrar").modal()
        }

        $(".list-group a").on('click', function() {

            $(".active").removeClass('active');
            $(this).addClass("active")
        });
    </script>


    <!--Modal Registrar -->
    <div id="ModalRegistrar" class="modal fade text-left" role="dialog">
        <form id="formRegistrar">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <div class="modal-header bg-secondary white">
                        <h4 class="modal-title" style="font-size:15px; font-weight:bold; color:white">
                            &nbsp; Sesión </h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>


                    </div>

                    <div class="modal-body">

                        <table width="100%" style="font-size:13px; font-weight:bold;">


                            <tr>

                                <input id="emp_id" name="id" readonly="readonly" type="hidden" />
                                <input id="valor" name="valor" readonly="readonly" type="hidden" />



                                <td width="50%"><b>Nombre</b><br>
                                    <input type="text" id="emp_nombre" name="nombre" required class='form-control' value=""></td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>

                            <tr>

                                <td><b>Descripcion</b><br>
                                    <textarea id="emp_telefono" name="telefono" class='form-control' maxlength="9" required>
            </textarea>

                                </td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>

                                <td><b>Periodo</b><br>
                                    <select id="emp_telefono" name="telefono" class='form-control' maxlength="9" required>
                                        <option>Seleccione</option>
                                    </select>

                                </td>

                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>

                                <td><b>Unidad</b><br>
                                    <select id="emp_telefono" name="telefono" class='form-control' maxlength="9" required>
                                        <option>Seleccione</option>
                                    </select>

                                </td>

                            </tr>

                            <tr>
                                <td>&nbsp;</td>
                            </tr>






                        </table>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success btn-glow text-white  my-1 " type="submit">
                            <i class="ace-icon fa fa-floppy-o bigger-120 blue"></i>Grabar</button>
                        <button class="btn bg-secondary btn-glow text-white  my-1 " type="reset" data-dismiss="modal">
                            <i class="ace-icon fa fa-times red2"></i>Cancelar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>



</body>
<!-- END: Body-->

</html>