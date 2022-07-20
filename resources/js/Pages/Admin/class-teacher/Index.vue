<template>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Class Teacher</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>All Class Teacher</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Class Teacher</h3>
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
                        <a href="/class-teacher/create" class="btn btn-primary"><i
                            class="fas fa-plus"></i> Add Class Teacher</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>
                            <div>

                                <label>S. No.</label>
                            </div>
                        </th>
                        <th>Teacher First Name</th>
                        <th>Second Name</th>
                        <th>Email</th>
                        <th>Department Name</th>
                        <th>Class Name</th>
                        <th>Section Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(data,index) in teacherdata.data" :key="index">


                        <td>
                            <div>

                                <label>{{ index + 1 }}</label>
                            </div>
                        </td>
                        <td v-if="data.teacher">{{ data.teacher.first_name }}</td>
                        <td v-else>null</td>

                        <td v-if="data.teacher">{{ data.teacher.last_name }}</td>
                        <td v-else>null</td>

                        <td v-if="data.teacher">{{ data.teacher.email }}</td>
                        <td v-else>null</td>

                        <td v-if="data.department">{{ data.department.department_name }}</td>
                        <td v-else>null</td>

                        <td v-if="data.class">{{ data.class.class_name }}</td>
                        <td v-else>null</td>

                        <td v-if="data.section">{{ data.section.section_name }}</td>
                        <td v-else>null</td>

                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                     <a class="dropdown-item" :href="`/class-teacher/${data.id}/edit`"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                                    <button class="dropdown-item" @click="destroy(classData.id)"><i
                                        class="fas fa-times text-orange-red"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>


                    </tbody>
                </table>
                <pagination class="mt-6" :links="teacherdata.links"/>
            </div>
        </div>
    </div>
</template>
<script>

import Pagination from '@/Shared/Pagination'
import Layout from "@/Shared/Layout";
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";

export default {
    props: {
        'teacherdata': {},
        filters: Object,
    },
    data() {
        return {
             indexForm: {
                search: this.filters.search,
            },
            updateData: {},
        }
    },
    components: {

        Pagination
    },
    layout: Layout,
    methods: {

        destroy(id) {
            if (confirm('Are you sure you want to delete this?')) {
                this.$inertia.delete(`/class-teacher/${id}`);
            }
        },

    },
    watch: {
        'indexForm.search': {
            handler: throttle(function () {
                this.$inertia.get('/class-teacher', pickBy(this.indexForm), {preserveState: true})
            }, 150),
        },
    },

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
