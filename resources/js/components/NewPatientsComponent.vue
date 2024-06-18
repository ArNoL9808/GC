<template>
    <div class="col-md-12">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="savePatient">
                        <div class="form-group mb-3">
                            <img src="/assets/images/users/user-vector.png" alt="" class="thumb-lg rounded me-2">
                            <label class="btn btn-de-primary btn-sm text-light">
                                Agregar Avatar <input type="file" hidden>
                            </label>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Nombre" class="form-control" v-model="patient.firstName">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Apellido" class="form-control" v-model="patient.lastName">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Fecha de Admisión" class="form-control" v-model="patient.admitDate">
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Departamento" class="form-control" v-model="patient.department">
                            </div>
                            <div class="col-md-3 mb-3">
                                <select class="form-select" v-model="patient.gender">
                                    <option value="">Seleccionar Género</option>
                                    <option>Masculino</option>
                                    <option>Femenino</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">
                                <input type="text" placeholder="Edad" class="form-control" v-model="patient.age">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="email" placeholder="Correo Electrónico" class="form-control" v-model="patient.email">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" placeholder="Número de Teléfono" class="form-control" v-model="patient.phoneNo">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" placeholder="ID" class="form-control" v-model="patient.id">
                            </div>
                            <div class="col-md-2 mb-3">
                                <input type="text" placeholder="Honorarios Anticipados" class="form-control" v-model="patient.advanceFees">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Nombre del Doctor" class="form-control" v-model="patient.doctorName">
                            </div>
                            <div class="col-md-6 mb-3">
                                <input type="text" placeholder="Número de Sala" class="form-control" v-model="patient.wardNo">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea rows="5" placeholder="Sobre mí..." class="form-control" v-model="patient.aboutMe"></textarea>
                            <button class="btn btn-de-primary btn-sm text-light px-4 mt-3 mb-0">Guardar</button>
                            <button class="btn btn-de-danger btn-sm text-light px-4 mt-3 mb-0">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
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
                admitDate: '',
                department: '',
                gender: '',
                age: '',
                email: '',
                phoneNo: '',
                id: '',
                advanceFees: '',
                doctorName: '',
                wardNo: '',
                aboutMe: ''
            }
        }
    },
    mounted() {
        /* $(function() {

        }); */
    },
    methods: {
        savePatient(){

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