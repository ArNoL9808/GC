<div class="leftbar-tab-menu">
    <div class="main-icon-menu">
        <a href="hospital-index" class="logo logo-metrica d-block text-center">
            <span>
                <img src="{{URL::asset('assets/images/logo-sm.png')}}" alt="logo-pequeño" class="logo-sm">
            </span>
        </a>
        <div class="main-icon-menu-body">
            <div class="position-reletive h-100" data-simplebar style="overflow-x: hidden;">
                <ul class="nav nav-tabs" role="tablist" id="tab-menu">
                    <li class="nav-item" data-bs-toggle="tooltip" data-bs-placement="right" title="Panel de control" data-bs-trigger="hover">
                        <a href="#MetricaDashboard" id="dashboard-tab" class="nav-link">
                            <i class="ti ti-smart-home menu-icon"></i>
                        </a><!--end nav-link-->
                    </li><!--end nav-item-->
                </ul><!--end nav-->
            </div><!--end /div-->
        </div><!--end main-icon-menu-body-->
        <div class="pro-metrica-end">
            <a href="" class="profile">
                <img src="{{URL::asset('assets/images/users/user-4.jpg')}}" alt="perfil-usuario" class="rounded-circle thumb-sm">
            </a>
        </div><!--end pro-metrica-end-->
    </div>
    <!--end main-icon-menu-->

    <div class="main-menu-inner">
        <!-- LOGO -->
        <div class="topbar-left">
            <a href="hospital-index" class="logo">
                <span>
                    <img src="{{URL::asset('assets/images/logo-dark.png')}}" alt="logo-grande" class="logo-lg logo-dark">
                    <img src="{{URL::asset('assets/images/logo.png')}}" alt="logo-grande" class="logo-lg logo-light">
                </span>
            </a><!--end logo-->
        </div><!--end topbar-left-->
        <!--end logo-->
        <div class="menu-body navbar-vertical tab-content" data-simplebar>
            <div id="MetricaDashboard" class="main-icon-menu-pane tab-pane" role="tabpanel"
                aria-labelledby="dasboard-tab">
                <div class="title-box">
                    <h6 class="menu-title">Panel de control</h6>
                </div>

                <ul class="nav flex-column">
                    <li class="nav-item menuitem-active">
                        <a class="nav-link active" href="hospital-index">Inicio</a>
                    </li><!--end nav-item-->
                </ul><!--end nav-->
                <div class="collapse navbar-collapse" id="sidebarCollapse">
                    <!-- Navegación -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarHospital" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarHospital">
                                Consultorio
                            </a>
                            <div class="collapse " id="sidebarHospital">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="#sidebarAppointments " class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarAppointments">
                                            Citas
                                        </a>
                                        <div class="collapse " id="sidebarAppointments">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-doctor-shedule">Horario del Doctor</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-all-appointments">Todas las Citas</a>
                                                </li><!--end nav-item-->
                                            </ul><!--end nav-->
                                        </div><!--end sidebarAppointments-->
                                    </li><!--end nav-item-->
                                    <li class="nav-item">
                                        <a href="#sidebarDoctors" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarDoctors">
                                            Doctores
                                        </a>
                                        <div class="collapse" id="sidebarDoctors">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-all-doctors">Todos los Doctores</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-add-doctor">Agregar Doctor</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-doctor-edit">Editar Doctor</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-doctor-profile">Perfil del Doctor</a>
                                                </li><!--end nav-item-->
                                            </ul><!--end nav-->
                                        </div><!--end sidebarDoctors-->
                                    </li><!--end nav-item-->

                                    <li class="nav-item">
                                        <a href="#sidebarPatients" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarPatients">
                                            Pacientes
                                        </a>
                                        <div class="collapse" id="sidebarPatients">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/list-patients">Todos los Pacientes</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/new-patient">Agregar Paciente</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-patient-edit">Editar Paciente</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-patient-profile">Perfil del Paciente</a>
                                                </li><!--end nav-item-->
                                            </ul><!--end nav-->
                                        </div><!--end sidebarPatients-->
                                    </li><!--end nav-item-->

                                    <li class="nav-item">
                                        <a href="#sidebarPayments" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarPayments">
                                            Pagos
                                        </a>
                                        <div class="collapse" id="sidebarPayments">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-all-payments">Todos los Pagos</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-payment-invoice">Factura de Pago</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-cashless-payments">Pagos sin Efectivo</a>
                                                </li><!--end nav-item-->
                                            </ul><!--end nav-->
                                        </div><!--end sidebarPayments-->
                                    </li><!--end nav-item-->

                                    <li class="nav-item">
                                        <a href="#sidebarStaff" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarStaff">
                                            Personal
                                        </a>
                                        <div class="collapse" id="sidebarStaff">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-all-staff">Todo el Personal</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-add-member">Agregar Miembro</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-edit-member">Editar Miembro</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-member-profile">Perfil del Miembro</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-salary">Salario del Personal</a>
                                                </li><!--end nav-item-->
                                            </ul><!--end nav-->
                                        </div><!--end sidebarStaff-->
                                    </li><!--end nav-item-->

                                    <li class="nav-item">
                                        <a href="#sidebarGeneral" class="nav-link" data-bs-toggle="collapse"
                                            role="button" aria-expanded="false" aria-controls="sidebarGeneral">
                                            General
                                        </a>
                                        <div class="collapse" id="sidebarGeneral">
                                            <ul class="nav flex-column">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-all-rooms">Asignación de Habitaciones</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-expenses">Informe de Gastos</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-departments">Departamentos</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-insurance-company">Compañía de Seguros</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-events">Eventos</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-leaves">Permisos</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-holidays">Vacaciones</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-attendance">Asistencia</a>
                                                </li><!--end nav-item-->
                                                <li class="nav-item">
                                                    <a class="nav-link" href="hospital-chat">Chat</a>
                                                </li><!--end nav-item-->
                                            </ul><!--end nav-->
                                        </div><!--end sidebarGeneral-->
                                    </li><!--end nav-item-->
                                </ul><!--end nav-->
                            </div><!--end sidebarHospital-->
                        </li><!--end nav-item-->
                        <li class="nav-item">
                            <a class="nav-link" href="apps-calendar">Calendario</a>
                        </li><!--end nav-item-->
                    </ul><!--end navbar-nav--->
                </div><!--end sidebarCollapse-->
            </div><!-- end Paneles de control -->
        </div>
        <!--end menu-body-->
    </div><!-- end main-menu-inner-->
</div>
