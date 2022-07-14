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
                                    <label for="first_name">Class Name</label>
                                    <select class="select2" v-model="form.class_name">
                                        <option value="">Please Select Class *</option>
                                        <option v-for='(classdata,index) in classes' :key="index" :value='classdata.id'>
                                            {{ classdata.class_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="email">Teacher Name</label>
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
        <h3>Class Routine</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Class Routine</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Class Routine Details</h3>
                </div>

            </div>
            <div class="row">

                    <div class="input-group col">
                        <label for="Class">Select class</label>
                        <select class="select2" v-model="indexForm.class">
                            <option value="">--None--</option>
                            <option v-for='(classdata,index) in classes' :key="index" :value='classdata.id'>
                                {{ classdata.class_name }}
                            </option>
                        </select>
                    </div>


                    <div class="input-group col">
                        <label for="Class">Select Section</label>
                        <select class="select2" v-model="indexForm.section">
                            <option value="">--None--</option>
                            <option v-for='(section,index) in section' :key="index" :value='section.id'>
                                {{ section.section_name }}
                            </option>
                        </select>
                    </div>

                 <div class="input-group col">
                        <label for="Class">Select Teacher</label>
                        <select class="select2" v-model="indexForm.teacher">
                            <option value="">--None--</option>
                            <option v-for='(teacherdata,index) in teacher' :key="index" :value='teacherdata.id'>
                                {{ teacherdata.first_name }} {{ teacherdata.last_name }}
                            </option>
                        </select>
                    </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>
                            <label>S. No.</label>
                        </th>
                        <th>Class Name</th>
                        <th>Section Name</th>
                        <th>Teacher Name</th>
                        <th>Subject Name</th>
                        <th>Period Time</th>
                        <th>Break Time</th>
                        <th>Date</th>
                        <th>Monday</th>
                        <th>Tuesday</th>
                        <th>Wednesday</th>
                        <th>Thursday</th>
                        <th>Friday</th>
                        <th>Saturday</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr v-for="(user,index) in classroutine.data" :key="index">
                        <td>
                            <label>{{ index + 1 }}</label>
                        </td>

                        <td>{{ user.class_name }}</td>
                        <td>{{ user.section_name }}</td>
                        <td>{{ user.first_name }} {{ user.last_name }}</td>
                        <td>{{ user.subject_name }}</td>
                        <td>{{ user.start_time }} to {{ user.end_time }}</td>
                        <td>{{ user.start_break }} to {{ user.end_break }}</td>
                        <td>{{ user.date }}</td>
                        <td>{{ user.monday }}</td>
                        <td>{{ user.tuesday }}</td>
                        <td>{{ user.wednesday }}</td>
                        <td>{{ user.thursday }}</td>
                        <td>{{ user.friday }}</td>
                        <td>{{ user.saturday }}</td>

                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                   aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" @click="showUpdate(user)"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                                    <button class="dropdown-item" @click="destroy(user.id)"><i
                                        class="fas fa-times text-orange-red"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <pagination class="mt-6" :links="classroutine.links"/>
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
        'classroutine': {},
        'classes': {},
        'section': {},
        'subject': {},
        'teacher': {},
        filters: Object,
    },
    data() {
        return {
            showUpdateModal: false,
            indexForm: {
                class: this.filters.class,
                section: this.filters.section,
                teacher: this.filters.teacher,
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
            //append method put to data
            data._method = 'put';
            //show update popup
            this.form = this.$inertia.form(data);
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
                this.$inertia.post(`/class-routine-destroy/destroy/${id}`);
            }
        },
    },
    watch: {
        'indexForm': {
            handler: throttle(function () {
                this.$inertia.get('/all-class-routine', pickBy(this.indexForm), { preserveState: true })
            }, 150),
            deep: true,
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
