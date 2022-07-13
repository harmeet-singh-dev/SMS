<template>
    <div v-if="showUpdateModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Student</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showUpdateModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Father Name *</label>
                                        <input type="text" v-model="form.father_name" placeholder="" class="form-control">
                                        <span v-if="errors.father_name" class="text-danger">{{errors.father_name}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Mother Name *</label>
                                        <input type="text" v-model="form.mother_name" placeholder="" class="form-control">
                                        <span v-if="errors.mother_name" class="text-danger">{{errors.mother_name}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Spouse Name </label>
                                        <input type="text" v-model="form.spouse_name" placeholder="" class="form-control">
                                        <span v-if="errors.spouse_name" class="text-danger">{{errors.spouse_name}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Gender *</label>
                                        <select class="select2" v-model="form.gender">
                                            <option value="">Please Select Gender *</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Others">Others</option>
                                        </select>
                                        <span v-if="errors.gender" class="text-danger">{{errors.gender}}</span>

                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Date Of Birth *</label>
                                        <input v-model="form.dob" type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                                               data-position='bottom right'>
                                        <span v-if="errors.dob" class="text-danger">{{errors.dob}}</span>
                                        <i class="far fa-calendar-alt"></i>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Blood Group *</label>
                                        <select v-model="form.blood_group" class="select2">
                                            <option value="">Please Select Group *</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                        <span v-if="errors.blood_group" class="text-danger">{{errors.blood_group}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Religion *</label>
                                        <select class="select2" v-model="form.religion">
                                            <option value="">Please Select Religion *</option>
                                            <option value="Hinduism">Hinduism</option>
                                            <option value="Islam">Islam</option>
                                            <option value="Christianity">Christianity</option>
                                            <option value="Sikhism">Sikhism</option>
                                            <option value="Buddhism">Buddhism</option>
                                            <option value="Jainism">Jainism</option>
                                            <option value="Judaism">Judaism</option>
                                            <option value="Other">Other</option>
                                        </select>
                                        <span v-if="errors.religion" class="text-danger">{{errors.religion}}</span>
                                    </div>

                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Department *</label>
                                        <select class="select2" v-model="form.department">
                                            <option value="">Please Department *</option>
                                            <option v-for='(Departmentdata,index) in Departmentdata' :key="index" :value='Departmentdata.id'>{{ Departmentdata.department_name }}</option>
                                        </select>
                                        <span v-if="errors.department" class="text-danger">{{errors.department}}</span>
                                    </div>



                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Phone *</label>
                                        <input type="text" placeholder="" v-model="form.phone" class="form-control">
                                        <span v-if="errors.phone" class="text-danger">{{errors.phone}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Address *</label>
                                        <input type="text" placeholder="" v-model="form.address"  class="form-control">
                                        <span v-if="errors.address" class="text-danger">{{errors.address}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>City *</label>
                                        <input type="text" placeholder="" v-model="form.city" class="form-control">
                                        <span v-if="errors.city" class="text-danger">{{errors.city}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>State *</label>
                                        <input type="text" placeholder="" v-model="form.state" class="form-control">
                                        <span v-if="errors.state" class="text-danger">{{errors.state}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Country *</label>
                                        <input type="text" placeholder="" v-model="form.country" class="form-control">
                                        <span v-if="errors.country" class="text-danger">{{errors.country}}</span>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Pincode *</label>
                                        <input type="text" placeholder="" v-model="form.pincode" class="form-control">
                                        <span v-if="errors.pincode" class="text-danger">{{errors.pincode}}</span>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group">
                                        <label>Description/experience</label>
                                        <textarea class="textarea form-control" v-model="form.description" id="form-message" cols="10" rows="9"></textarea>

                                        <span v-if="errors.description" class="text-danger">{{errors.description}}</span>
                                    </div>
                                    <div class="col-lg-6 col-12 form-group mg-t-30">
                                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                                        <input accept="image/*" type="file" @input="form.photo = $event.target.files" />
                                    </div>
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
    <div class="breadcrumbs-area">
        <h3>Teacher</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Teacher</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Teacher Details</h3>
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
                        <a href="/student/create" class="btn btn-primary"><i
                            class="fas fa-plus"></i> Add Student</a>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input checkAll">
                                <label class="form-check-label">S. No.</label>
                            </div>
                        </th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(data,index) in teachers.data" :key="index">
                        <!--tr v-for="Classes in Data" :key="Classes"-->
                        <td>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input">
                                <label class="form-check-label">{{ index + 1 }}</label>
                            </div>
                        </td>

                        <td>{{ data.user.first_name }}</td>
                        <td>{{ data.user.last_name }}</td>
                        <td>{{ data.user.email }}</td>


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

                <pagination class="mt-6" :links="teachers.links"/>
            </div>
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
        'teachers': {},
        errors: Object,
        'Departmentdata':{},
        filters: Object,
    },
    layout: Layout,
    data() {
        return {
            showUpdateModal: false,
            indexForm: {
                search: this.filters.search,
            },
            form : this.$inertia.form({
                _method: 'put',
            }),
        }
    },

    watch: {
        'indexForm.search': {
            handler: throttle(function () {
                this.$inertia.get('/teacher', pickBy(this.indexForm), { preserveState: true })
            }, 150),
        },
    },

    components: {
        Pagination,
    },
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
            data._method = 'put';
            this.form = this.$inertia.form(data);
            this.showUpdateModal = true;

        },
        update() {
            //show update popup
            this.form.post(`/teacher/${this.form.id}`, {
                onSuccess: () =>  this.showUpdateModal = false,
                onError: (errors) => this.errors = errors,
            });
            this.showUpdateModal = false;
        },
        destroy(id) {
            //show delete alert
            //if user confirm delete
            if (confirm('Are you sure you want to delete this?')) {
                this.$inertia.delete(`/teacher/${id}`);
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
