<template>
    <div class="col-md-12">
        
    </div>
</template>
<script>
export default {
    name: "EditPatientsComponent.vue",
    props: {

    },
    filters: {
        
    },
    data() {
        return {

        }
    },
    mounted() {
        $(function() {

        });
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