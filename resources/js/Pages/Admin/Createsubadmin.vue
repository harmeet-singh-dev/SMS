<template>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Sub Admin</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add Sub Admin</h3>
                </div>
                <!-- Simple success message -->
                <!--span v-if="success" :class="text-success">Record submitted successfully!</!--span-->
            </div>


            <form @submit.prevent="submit">
                <div class="row">

                    <label>First Name *</label>
                    <input type="text" v-model="form.first_name" class="form-control">
                    <div v-if="errors && errors.first_name" class="font-medium text-red-600">{{
                            errors.first_name[0]
                        }}
                    </div>

                    <label>Last Name *</label>
                    <input type="text" v-model="form.last_name" class="form-control">
                    <div v-if="errors && errors.last_name" class="font-medium text-red-600">{{
                            errors.last_name[0]
                        }}
                    </div>

                    <label>Email *</label>
                    <input type="email" v-model="form.email" class="form-control">
                    <div v-if="errors && errors.email" class="font-medium text-red-600">{{ errors.email[0] }}</div>

                    <div class="col-12 form-group mg-t-8">

                        <button :type="submit"
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                            <slot>Click Here</slot>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>


</template>

<script>


import Layout from "@/Shared/Layout";

export default {
    props: {
        errors: Object,
    },
    components: {},

    layout: Layout,

    data() {
        return {

            form: {
                first_name: '',
                last_name: '',
                email: '',
            },
            errors: {},
            //  success:false,

        }
    },
    methods: {
        submit() {
            this.errors = {};
            axios.post('subadminpro', this.form)
                .then(res => {
                    console.log(res.data);
                    // this.success=true;

                    this.form = {};
                    Toast.fire({
                        icon: 'success',
                        title: 'Sub Admin is created !!!'
                    })
                }).catch((error) => {
                this.errors = error.response.data.errors
                /*   if(this.errors = error.response.data.errors.name){
                      Toast.fire({
              icon:'error',
              title:'name'
           }) } */

                /* if(this.errors = error.response.data.errors.place){
                           Toast.fire({
                   icon:'error',
                   title:'place'
                })  }*/

                // this.success=false;

            });
            //simple success message
            /*  setTimeout(() => {
               this.success = false
                         }, 3000)*/
        },
    }
}

</script>


