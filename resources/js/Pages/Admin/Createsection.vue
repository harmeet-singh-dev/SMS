<template>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Section</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New Section</h3>
                </div>
                <!-- Simple success message -->
                <!--span v-if="success" :class="text-success">Record submitted successfully!</!--span-->
            </div>


            <form @submit.prevent="submit">
                <div class="row">

                    <label>Section Name *</label>

                    <input type="text" placeholder="" v-model="form.name" class="form-control">
                    <!--input type="text" placeholder="" v-model="form.place"  class="form-control"-->
                    <div v-if="errors && errors.name" class="font-medium text-red-600">{{ errors.name[0] }}</div>
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
                name: '',
            },
            errors: {},
            //  success:false,

        }
    },
    methods: {
        submit() {
            this.errors = {};
            axios.post('sectionpost', this.form)
                .then(res => {
                    console.log(res.data);
                    // this.success=true;

                    this.form = {};
                    Toast.fire({
                        icon: 'success',
                        title: 'Section name is created !!!'
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

<style>
.row {
    background: white;
    border-radius: 1px;
    box-shadow: none;
}
</style>
