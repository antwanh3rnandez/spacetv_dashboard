<?php

$perfil = Perfil::getPerfil($_SESSION['session_username'], $_SESSION['session_password']);

?>

        <ul class="navbar-nav bg-gradient-<?=(!$perfil['sidebar_color']) ? 'dark' : $perfil['sidebar_color']?> sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?p=dashboard">
                <div class="sidebar-brand-text mx-3"><img class="w-100" src="assets/img/logo.png"></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item <?= ($section == 'dashboard') ? 'active' : '' ?>">
                <a class="nav-link" href="?p=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Contenido
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= ($section == 'solicitar' || $section == 'historial') ? 'active' : '' ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-star"></i>
                    <span>Peticiones</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Opciones:</h6>
                        <a class="collapse-item <?= ($section == 'solicitar') ? 'active' : '' ?>" href="?p=solicitar">Solicitar Peticion</a>
                        <a class="collapse-item <?= ($section == 'historial') ? 'active' : '' ?>" href="?p=historial">Historial de Peticiones</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Tutoriales
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-download"></i>
                    <span>Instalacion</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">App Oficial:</h6>
                        <a class="collapse-item" target="_blank" href="https://www.spacetv.com.mx/instalar-spacetv-roku/">Roku</a>
                        <a class="collapse-item" target="_blank" href="https://www.spacetv.com.mx/instalar-spacetv-firestick/">FireStick o Android</a>
                        <a class="collapse-item" target="_blank" href="https://www.spacetv.com.mx/instalar-en-windows/">Windows</a>
                        <a class="collapse-item" target="_blank" href="https://www.spacetv.com.mx/instalar-en-mac/">Mac</a>
                        <div class="collapse-divider"></div>
                        <h6 class="collapse-header">App de 3ros:</h6>
                        <a class="collapse-item" href="https://www.spacetv.com.mx/instalar-spacetv-ios-iphone-ipad/">iOS / iPhone / iPad</a>
                        <a class="collapse-item" href="https://www.spacetv.com.mx/instalar-en-ssiptv/">SmartTV (SSIPTV)</a>
                        <a class="collapse-item" href="https://www.spacetv.com.mx/instalar-en-smart-iptv/">SmartTV (SmartIPTV)</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Heading -->
            <div class="sidebar-heading">
                Ajustes
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item <?= ($section == 'perfil') ? 'active' : '' ?>">
                <a class="nav-link" href="?p=perfil">
                    <i class="fas fa-fw fa-user-circle"></i>
                    <span>Perfil</span>
                </a>
            </li>

            <li class="nav-item <?= ($section == 'datos') ? 'active' : '' ?>">
                <a class="nav-link" href="?p=datos">
                    <i class="fas fa-fw fa-info-circle"></i>
                    <span>Datos de Contacto</span>
                </a>
            </li>

            <li class="nav-item <?= ($section == 'preferencias') ? 'active' : '' ?>">
                <a class="nav-link" href="?p=preferencias">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Preferencias</span>
                </a>
            </li>

            <?php 

                if ($perfil['username'] == 'jorgehdz') {
                
            ?>

                <!-- Divider -->
                <hr class="sidebar-divider d-none d-md-block">

                <!-- Heading -->
                <div class="sidebar-heading text-danger">
                    Admin
                </div>

                <!-- Nav Item - Pages Collapse Menu -->
                <li class="nav-item <?= ($section == 'admin_peticiones') ? 'active' : '' ?>">
                    <a class="nav-link" href="?p=admin_peticiones">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Ver Peticiones</span>
                    </a>
                </li>
                
                <li class="nav-item <?= ($section == 'admin_usuarios') ? 'active' : '' ?>">
                    <a class="nav-link" href="?p=admin_usuarios">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Ver Usuarios</span>
                    </a>
                </li>

                <li class="nav-item <?= ($section == 'admin_access_log') ? 'active' : '' ?>">
                    <a class="nav-link" href="?p=admin_access_log">
                        <i class="fas fa-fw fa-info-circle"></i>
                        <span>Ver Access Log</span>
                    </a>
                </li>


            <?php
                }
            ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            
            <div class="sidebar-heading">
                Cuenta
            </div>

                <li class="nav-item <?= ($section == 'renovar_cuenta') ? 'active' : '' ?>">
                    <a class="mt-2 py-2 w-100 btn btn-success btn-sm text-start" href="?p=renovar_cuenta">
                        <div style="display: flex; align-items: center;" class="ml-2">
                            <i class="fas fa-fw fa-bolt"></i>
                            <span class="ml-2">Renovar Cuenta</span>
                        </div>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-fw fa-power-off"></i>
                        <span>Cerrar Sesión</span>
                    </a>
                </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>