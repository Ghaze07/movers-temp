<template>
    <div class="container-fluid wrapper">
        <div class="container pt-3 pb-3">
            <div class="row">
                <h2>Our Services</h2>
            </div>
            <div class="row align-items-start content">          
                <div v-for="service in services" :key="service.id" class="col-md-4 mb-1">
                    <div class="card" style="width: 18rem;">
                        <h5 class="card-header border border-success" style="background: #fbe36b !important; color: black !important;">
                           {{service.name}}
                        </h5>
                        <img class="card-img-top" :src="service.image" alt="Card image cap" style="width: fit-content; margin-left: 5rem;">
                        <div class="card-body" style="background: #0f1941 !important;">
                          <ul class="list-group mb-2">
                            <li class="list-group-item">{{ service.first_trait}}</li>
                            <li class="list-group-item">{{ service.second_trait}}</li>
                            <li class="list-group-item">{{ service.third_trait}}</li>
                          </ul>
                          <button type="button" class="btn btn-lg" data-toggle="modal" data-target="#exampleModal" style="background: #F9C909;">Book</button>
                        </div>
                    </div>
                </div>         
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Small Move</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Coming soon...
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Submit</button>
                        </div>
                      </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
     data() {
        return {
            services: [],
        }
    },
    created() {
        this.getServices();
    },   
    methods: {
        getServices() {
            axios.get( '/all_services' ).then( response => {
                    if (response.status == 200) {
                        this.services = response.data;
                    } else {
                        console.warn(response.data);
                    }              
                    }).catch( (error)=> {
                        console.log( error.response.data );
                    });
        },
    }    
}
</script>