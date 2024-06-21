<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>Nombre del Paciente</th>
                                <!-- <th>Edad</th> -->
                                <th>Dirección</th>
                                <th>Número Móvil</th>
                                <!-- <th>Última Visita</th> -->
                                <th>Estado</th>
                                <th class="text-right">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Iterar sobre los usuarios y generar filas de tabla dinámicamente -->
                            <tr v-for="user in patients" :key="user.id">
                                <td>#{{ user.id }}</td>
                                <td>
                                    <a :href="'hospital-patient-profile/' + user.id">
                                        <img v-if="user.profile_photo " :src="'/storage/' + user.profile_photo" alt="" class="thumb-sm rounded-circle me-2">
                                        <img v-else :src="'/assets/images/users/user-vector.png'" alt="" class="thumb-sm rounded-circle me-2">{{ user.firstname }} {{ user.lastname }}
                                    </a>
                                </td>
                                <!-- <td>{{ calculateAge(user.birthdate) }}</td> -->
                                <td>{{ user.direccion }}</td>
                                <td>{{ user.phone }}</td>
                                <!-- <td>{{ formatLastVisit(user.last_visit) }}</td> -->
                                 <td><span :class="user.status === 1 ? 'badge badge-soft-success' : 'badge badge-soft-warning'">{{ user.status === 1 ? 'Activo' : 'Inactivo' }}</span></td>
                                <td>
                                    <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                    <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        <a href="/new-patient" class="btn btn-outline-light btn-sm px-4 " @click="goToAddNew">+ Agregar nuevo</a>
                    </div>
                    <div class="col-auto">
                        <!-- Paginación -->
                        <nav aria-label="...">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item" v-for="page in totalPages" :key="page" :class="{ 'active': currentPage === page }">
                                    <a class="page-link" @click.prevent="setCurrentPage(page)" href="#">{{ page }}</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    name: "ListPatientsComponent",
    data() {
        return {
            patients: [], // Array para almacenar los usuarios
            currentPage: 1, // Página actual de la paginación
            totalPages: 3 // Número total de páginas (deberías obtenerlo dinámicamente)
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/patients').then(res => {
                if (res.data.status) {
                    this.patients = res.data.patients;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se encontraron los datos del paciente.'
                    });
                }
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al obtener los datos del paciente.'
                });
                console.error('There was an error getting the patient data:', err);
            });
        },
        calculateAge(birthdate) {
            // Función para calcular la edad basada en la fecha de nacimiento
            // Debes implementar la lógica para calcular la edad
        },
        formatLastVisit(lastVisit) {
            // Función para formatear la última visita
            // Puedes utilizar bibliotecas de formato de fecha como moment.js
        },
        setCurrentPage(page) {
            // Método para establecer la página actual de la paginación
            this.currentPage = page;
            // Llamar a this.getData() nuevamente con el número de página actual para obtener datos paginados
            // axios.get('/api/patients?page=' + page)
            //     .then(response => {
            //         this.patients = response.data.patients; // Asignar usuarios paginados
            //     })
            //     .catch(error => {
            //         console.error('Error fetching patients:', error);
            //     });
        },
        goToAddNew() {
            // Redirigir a la página para agregar un nuevo usuario
            this.$router.push('/hospital-add-patient');
        },
        unauth() {
            // Función para manejar la autenticación expirada
            swal.fire({
                title: 'Tu sesión ha expirado, por favor inicia sesión de nuevo.',
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = '/logout?exp=1';
                } else {
                    location.href = '/logout?exp=1';
                }
            });
        }
    }
}
</script>

<style>
/* Aquí puedes agregar estilos específicos para este componente si es necesario */
</style>
