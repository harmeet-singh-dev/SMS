<template>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Notice</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New Notice</h3>
                </div>
                <!-- Simple success message -->
                <!--span v-if="success" :class="text-success">Record submitted successfully!</!--span-->
            </div>


            <form @submit.prevent="submit">
                <div class="row">

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Title *</label>
                        <input type="text" v-model="form.title" placeholder="" class="form-control">
                        <div v-if="errors && errors.title" class="font-medium text-red-600">{{ errors.title[0] }}</div>
                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Posted By *</label>
                        <input type="text" placeholder="" v-model="form.posted_by" class="form-control">
                        <i class="fas fa-user"></i>
                        <div v-if="errors && errors.posted_by" class="font-medium text-red-600">{{
                                errors.posted_by[0]
                            }}
                        </div>
                    </div>
                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Date </label>
                        <input type="text" placeholder="" v-model="form.time" class="form-control air-datepicker">
                        <i class="far fa-calendar-alt"></i>

                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Details *</label>
                        <textarea class="textarea form-control" v-model="form.description" id="form-message" cols="10"
                                  rows="9"></textarea>
                        <div v-if="errors && errors.description" class="font-medium text-red-600">
                            {{ errors.description[0] }}
                        </div>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" v-model="form.teacher" value="1" class="form-check-input checkAll">
                        <label class="form-check-label">Notice for Teachers</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" v-model="form.student" value="1" class="form-check-input checkAll">
                        <label class="form-check-label">Notice for Students</label>
                    </div>
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
                title: '',
                posted_by: '',
                time: '',
                description: '',
                teacher: '',
                student: ''
            },
            errors: {},

        }
    },
    methods: {
        submit() {
            this.errors = {};
            axios.post('noticepost', this.form)
                .then(res => {
                    console.log(res.data);
                    // this.success=true;

                    this.form = {};
                    Toast.fire({
                        icon: 'success',
                        title: 'New Notice is created !!!'
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
