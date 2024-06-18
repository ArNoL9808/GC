<template>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>ID</th>
                                <th>Address</th>
                                <th>Mobile No</th>
                                <th>Last Visit</th>
                                <th>Status</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Aquí puedes iterar sobre tus pacientes y generar filas de tabla dinámicamente -->
                            <!-- Por ejemplo, usa un v-for="patient in patients" si tienes una matriz de pacientes -->
                            <!-- Ejemplo de una fila estática -->
                            <tr>
                                <td><a href="hospital-patient-profile"><img src="{{URL::asset('assets/images/users/user-10.jpg')}}" alt="" class="thumb-sm rounded-circle me-2">Donald Gardner</a></td>
                                <td>36</td>
                                <td>#1236</td>
                                <td>B28 University Street US</td>
                                <td>+123456789</td>
                                <td>18/07/2019</td>
                                <td><span class="badge badge-soft-success">Approved</span></td>
                                <td>
                                    <a href="#"><i class="las la-pen text-secondary font-16"></i></a>
                                    <a href="#"><i class="las la-trash-alt text-secondary font-16"></i></a>
                                </td>
                            </tr>
                            <!-- Fin de la fila estática -->
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col">
                        <button class="btn btn-outline-light btn-sm px-4 " onclick="location.href='hospital-add-patient'">+ Add New</button>
                    </div>
                    <div class="col-auto">
                        <nav aria-label="...">
                            <ul class="pagination pagination-sm mb-0">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
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
export default {
    name: "ListPatientsComponent.vue",
    props: {

    },
    filters: {
        
    },
    data() {
        return {

        }
    },
    mounted() {
/*         $(function() {

        }); */
    },
    methods: {
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