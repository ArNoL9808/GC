<template>
    <div class="col-md-12">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="savePatient" class="needs-validation" novalidate>
                        <div class="form-group mb-3">
                            <img src="/assets/images/users/user-vector.png" alt="" class="thumb-lg rounded me-2">
                            <label class="btn btn-de-primary btn-sm text-light">
                                Agregar Avatar <input type="file" hidden @change="onFileChange">
                            </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Nombre" class="form-control" v-model="patient.firstName" required>
                                <div class="invalid-feedback">Por favor, ingrese el nombre.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Apellido" class="form-control" v-model="patient.lastName" required>
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
                            <textarea rows="5" placeholder="Dirección" class="form-control" v-model="patient.address"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <textarea rows="5" placeholder="Alergias" class="form-control" v-model="patient.allergies"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <textarea rows="5" placeholder="Antecedentes Médicos" class="form-control" v-model="patient.medicalHistory"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-de-primary btn-sm text-light px-4 mt-3 mb-0" type="submit">Guardar</button>
                            <button class="btn btn-de-danger btn-sm text-light px-4 mt-3 mb-0" type="button" @click="cancel">Cancelar</button>
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
    name: "NewPatientsComponent.vue",
    props: {

    },
    filters: {
        
    },
    data() {
        return {
            patient: {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                birthdate: '',
                gender: '',
                address: '',
                allergies: '',
                medicalHistory: ''
            },
            submitted: false
        }
    },
    mounted() {
        const forms = this.$el.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    },
    methods: {
        onFileChange(e) {
            const file = e.target.files[0];
            this.patient.profilePhoto = file;
        },
        async savePatient() {
            this.submitted = true;

            // Check if the form is valid before submitting
            const form = this.$el.querySelector('form');
            if (form.checkValidity() === false) {
                return;
            }

            // Create FormData and append form fields
            const formData = new FormData();
            formData.append('firstName', this.patient.firstName);
            formData.append('lastName', this.patient.lastName);
            formData.append('email', this.patient.email);
            formData.append('phone', this.patient.phone);
            formData.append('birthdate', this.patient.birthdate);
            formData.append('gender', this.patient.gender);
            formData.append('address', this.patient.address);
            formData.append('allergies', this.patient.allergies);
            formData.append('medicalHistory', this.patient.medicalHistory);
            formData.append('role_id', 3);
            if (this.patient.profilePhoto) {
                formData.append('profilePhoto', this.patient.profilePhoto);
            }

            axios.post('/api/patients', formData).then(res => {
                if (res.data.status) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: '¡Paciente guardado correctamente!',
                        confirmButtonText: 'Aceptar'
                    }).then(() => {
                        window.location.href = `/edit-patient/${res.data.uuid}`;
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
                    text: 'Hubo un error al guardar el paciente.'
                });
                console.error('There was an error saving the patient:', err);
            });
        },
        cancel() {
            // Reset the form or navigate away
            this.patient = {
                firstName: '',
                lastName: '',
                email: '',
                phone: '',
                birthdate: '',
                gender: '',
                address: '',
                allergies: '',
                medicalHistory: '',
                profilePhoto: null
            };
            this.submitted = false;
            // Optionally, navigate away or reset the form
        },
        unauth(){
            swaltwo.fire({
              title: 'Tu sesión expiró, por favor vuelve a iniciar.',
              icon: 'warning',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Ok'
            }).then((result) => {
              if (result.isConfirmed) {
                location.href = '/logout?exp=1';
              }else{
                location.href = '/logout?exp=1';
              }
            })
        }
    }
}
</script>