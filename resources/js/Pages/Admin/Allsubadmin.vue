<template>
    <div v-if="showUpdateModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Sub Admin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showUpdateModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name"
                                           v-model="updateData.first_name">
                                </div>
                                <div class="form-group">
                                    <label for="name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name"
                                           v-model="updateData.last_name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" v-model="updateData.email">
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" @click="showUpdateModal = false">Close
                                </button>
                                <button @click="update()" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Sub Admin</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Sub Admin</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Sub Admin Details</h3>
                </div>

            </div>

            <div class="row">
                <div class="col-4">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="indexForm.search"
                               placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Sub Admin</th>
                        <th>Student</th>
                        <th>Teacher</th>
                        <th>Parent</th>
                        <th>Account</th>
                        <th>Class</th>
                        <th>Subject</th>
                        <th>Class Routine</th>
                        <th>Attendance</th>
                        <th>Notice</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(data,index) in sub_admins.data" :key="index">
                        <!--tr v-for="Classes in Data" :key="Classes"-->
                        <td>
                            <div>

                                <label>{{ index + 1 }}</label>
                            </div>
                        </td>

                        <td>{{ data.first_name }}</td>
                        <td>{{ data.last_name }}</td>
                        <td>{{ data.email }}</td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'sub_admin')"
                            type="checkbox"
                            :checked="data.permission.sub_admin">
                        </td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'student')"
                            :checked="data.permission.student"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'teacher')"
                            :checked="data.permission.teacher"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'parent')"
                            :checked="data.permission.parent"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'account')"
                            :checked="data.permission.account"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'class')"
                            :checked="data.permission.class"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'subject')"
                            :checked="data.permission.subject"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'class_routine')"
                            :checked="data.permission.class_routine"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'attendance')"
                            :checked="data.permission.attendance"
                            type="checkbox"></td>
                        <td><input
                            @change="onChange(data.id,$event.target.checked,'notice')"
                            :checked="data.permission.notice"
                            type="checkbox"></td>


                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" @click="showUpdate(data)"><i
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
            <pagination class="mt-6" :links="sub_admins.links"/>
        </div>
    </div>

</template>
<script>

import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Pagination from '@/Shared/Pagination'
import Layout from "@/Shared/Layout";

export default {
    props: {
        'sub_admins': {},
        filters: Object,
    },
    data() {
        return {
            showUpdateModal: false,
            indexForm: {
                search: this.filters.search,
            },
            updateData: {},
        }
    },

    components: {
        Pagination,
    },
    layout: Layout,
    methods: {
        onChange(id, checked, type) {
            //set data type and value
            const data = {};
            data[type] = checked;
            console.log(id, checked, type)
            this.$inertia.post(`/all-sub-admin/update_permission/${id}`, {
                data: data
            });

        },
        showUpdate(data) {
            //show update popup
            this.updateData = data;
            this.showUpdateModal = true;

        },
        update() {
            //show update popup
            this.$inertia.post(`/all-sub-admin/update/${this.updateData.id}`, {
                data: this.updateData
            });
            this.showUpdateModal = false;
        },
        destroy(id) {
            //show delete alert
            //if user confirm delete
            if (confirm('Are you sure you want to delete this?')) {
                this.$inertia.post(`/all-sub-admin/destroy/${id}`);
            }
        },
    },
    watch: {
        'indexForm.search': {
            handler: throttle(function () {
                this.$inertia.get('/all-sub-admin', pickBy(this.indexForm), {preserveState: true})
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
