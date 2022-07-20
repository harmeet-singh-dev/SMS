<template>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Fee</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Fee</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Fee Details</h3>
                </div>

            </div>

            <div class="row">
                <div class="col-4">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="indexForm.search" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="text-right">
                        <a href="/fees/create" class="btn btn-primary"><i
                            class="fas fa-plus"></i> Add Fee</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>Unique ID</th>
                        <th>Class Name</th>
                        <th>Section Name</th>
                        <th>Student Name</th>
                        <th>Father Name</th>
                        <th>Fees Month</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(data,index) in fees.data" :key="index">
                        <!--tr v-for="Classes in Data" :key="Classes"-->
                        <td>{{ data.id }}</td>
                        <td>{{ data.class.class_name }}</td>
                        <td>{{ data.section.section_name }}</td>
                        <td>{{ data.student.first_name }}</td>
                        <td>{{ data.father_name }}</td>
                        <td>{{ data.fee_month }}</td>


                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" :href="`/fees/${data.id}/edit`"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                                    <button class="dropdown-item" @click="destroy(data.id)"><i
                                        class="fas fa-times text-orange-red"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>


                    </tbody>
                </table>
            </div>
            <pagination class="mt-6" :links="fees.links"/>
        </div>
    </div>

</template>
<script>

import Pagination from '@/Shared/Pagination'
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Layout from "@/Shared/Layout";

export default {
    props: {
        errors: Object,
        'fees': {},
        filters: Object,
        'classes': {},
        'section': {},
        'users_data': {},
        'father_data': {},
        'fee_interval': {},
    },
    data() {
        return {
            indexForm: {
                search: this.filters.search,
            },
            form: this.$inertia.form({
                _method: 'put',
            }),
        }
    },

    components: {
        Pagination,
    },

    layout: Layout,

    watch: {
        'indexForm.search': {
            handler: throttle(function () {
                this.$inertia.get('/fees', pickBy(this.indexForm), {preserveState: true})
            }, 150),
        },
    },
    methods: {
        destroy(id) {
            //show delete alert
            //if user confirm delete
            if (confirm('Are you sure you want to delete this?')) {
                this.$inertia.delete(`/fees/${id}`);
            }
        },
    }

}
</script>

<style>
.modal-mask {
    position: fixed;
    z-index: 9998;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, .5);
    display: table;
    transition: opacity .3s ease;
}

.modal-wrapper {
    display: table-cell;
    vertical-align: middle;
}

.row {
    background: white;
    border-radius: 1px;
    box-shadow: none;
}
</style>
