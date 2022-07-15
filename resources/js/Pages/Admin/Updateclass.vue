<template>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Update Class</h3>
        <ul>
            <li>
                <a href="index.html">Dashboard</a>
            </li>
            <li>Update Class</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Update Class</h3>
                </div>
                <span v-if="success" :class="text-success">Class is updated successfully!</span>
            </div>


            <form @submit.prevent="submit">
                <div class="row">

                    <label>Class Name *</label>
                    <input type="text" v-model="form.name" placeholder="" class="form-control">
                    <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
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


import axios from 'axios'
import Layout from "@/Shared/Layout";

export default {
    props: {
        'updatedata': {},
    },
    components: {},

    layout: Layout,

    data() {
        return {

            form: {
                name: this.updatedata[0].name,
            },
            errors: {},
            success: false,

        }
    },
    methods: {
        submit() {
            this.errors = {};
            let formData = new FormData();
            formData.append('name', this.form.name);
            axios.post('/update_class/' + this.updatedata[0].id, formData,)
                .then(res => {
                    console.log(res.data);
                    this.success = true;
                    // this.form={};
                }).catch((error) => {
                this.errors = error.response.data.errors;
                this.success = false;
            });
            setTimeout(() => {
                this.success = false
            }, 3000)
        },

    }
}
</script>


