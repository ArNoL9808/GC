<template>
    <div class="col-md-12">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="updatePatient" class="needs-validation" novalidate>
                        <div class="form-group mb-3">
                            <img :src="profilePhotoUrl ? profilePhotoUrl : '/assets/images/users/user-vector.png'" alt="" class="thumb-lg rounded me-2">
                            <label class="btn btn-de-primary btn-sm text-light">
                                Agregar Avatar <input type="file" hidden @change="onFileChange">
                            </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Nombre" class="form-control" v-model="patient.firstname" required>
                                <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Apellido" class="form-control" v-model="patient.lastname" required>
                                <div class="invalid-feedback">Por favor, ingrese el apellido.</div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="email" placeholder="Correo Electrónico" class="form-control" v-model="patient.email" required>
                                <div class="invalid-feedback">Por favor, ingrese un correo electrónico válido.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Número de Teléfono" class="form-control" v-model="patient.phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="date" placeholder="Fecha de Nacimiento" class="form-control" v-model="patient.birthdate">
                            </div>
                            <div class="col-md-6 mb-3">
                                <select class="form-select" v-model="patient.gender" required>
                                    <option value="">Seleccionar Género</option>
                                    <option value="male">Masculino</option>
                                    <option value="female">Femenino</option>
                                    <option value="other">Otro</option>
                                </select>
                                <div class="invalid-feedback">Por favor, seleccione un género.</div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <textarea rows="5" placeholder="Dirección" class="form-control" v-model="patient.direccion"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <textarea rows="5" placeholder="Alergias" class="form-control" v-model="patient.alergias"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <textarea rows="5" placeholder="Antecedentes Médicos" class="form-control" v-model="patient.antecedentes_medicos"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-de-primary btn-sm text-light px-4 mt-3 mb-0" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2';

export default {
    name: "EditPatientsComponent",
    props: {
        uuid: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            patient: {
                firstname: '',
                lastname: '',
                email: '',
                phone: '',
                birthdate: '',
                gender: '',
                direccion: '',
                alergias: '',
                antecedentes_medicos: '',
                profilePhoto: null
            },
            profilePhotoUrl: '',
            submitted: false
        };
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/patients/' + this.uuid).then(res => {
                if (res.data.status) {
                    this.patient = res.data.patient;
                    this.profilePhotoUrl = this.patient.profile_photo ? '/storage/' + this.patient.profile_photo : '';
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
        async updatePatient() {
            this.submitted = true;

            const form = this.$el.querySelector('form');
            if (form.checkValidity() === false) {
                return;
            }

            const formData = new FormData();
            formData.append('firstName', this.patient.firstname);
            formData.append('lastName', this.patient.lastname);
            formData.append('email', this.patient.email);
            formData.append('phone', this.patient.phone);
            formData.append('birthdate', this.patient.birthdate);
            formData.append('gender', this.patient.gender);
            formData.append('direccion', this.patient.direccion);
            formData.append('alergias', this.patient.alergias);
            formData.append('antecedentes_medicos', this.patient.antecedentes_medicos);
            if (this.patient.profilePhoto) {
                formData.append('profilePhoto', this.patient.profilePhoto);
            }

            axios.post('/api/patient/' + this.uuid, formData).then(res => {
                if (res.data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: '¡Paciente actualizado correctamente!',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = `/edit-patient/${this.uuid}`;
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: res.data.message
                    });
                }
            }).catch(err => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al actualizar el paciente.'
                });
                console.error('There was an error updating the patient:', err);
            });
        },
        onFileChange(event) {
            const file = event.target.files[0];
            this.patient.profilePhoto = file;
            this.profilePhotoUrl = URL.createObjectURL(file);
        }
    }
}
</script>