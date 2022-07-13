<template>
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Teacher</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New Teacher</h3>
                </div>
                <!-- Simple success message -->
                <!--span v-if="success" :class="text-success">Record submitted successfully!</!--span-->
            </div>


            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>First Name *</label>
                        <input type="text" v-model="form.first_name" placeholder="" class="form-control">
                        <span v-if="errors.first_name" class="text-danger">{{ errors.first_name }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Last Name *</label>
                        <input type="text" v-model="form.last_name" placeholder="" class="form-control">
                        <span v-if="errors.last_name" class="text-danger">{{ errors.last_name }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Father Name *</label>
                        <input type="text" v-model="form.father_name" placeholder="" class="form-control">
                        <span v-if="errors.father_name" class="text-danger">{{ errors.father_name }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Mother Name *</label>
                        <input type="text" v-model="form.mother_name" placeholder="" class="form-control">
                        <span v-if="errors.mother_name" class="text-danger">{{ errors.mother_name }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Spouse Name </label>
                        <input type="text" v-model="form.spouse_name" placeholder="" class="form-control">
                        <span v-if="errors.spouse_name" class="text-danger">{{ errors.spouse_name }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Gender *</label>
                        <select class="select2" v-model="form.gender">
                            <option value="">Please Select Gender *</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Others">Others</option>
                        </select>
                        <span v-if="errors.gender" class="text-danger">{{ errors.gender }}</span>

                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Date Of Birth *</label>
                        <input v-model="form.dob" type="text" placeholder="dd/mm/yyyy"
                               class="form-control air-datepicker"
                               data-position='bottom right'>
                        <span v-if="errors.dob" class="text-danger">{{ errors.dob }}</span>
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
                        <span v-if="errors.blood_group" class="text-danger">{{ errors.blood_group }}</span>
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
                        <span v-if="errors.religion" class="text-danger">{{ errors.religion }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Department *</label>
                        <select class="select2" v-model="form.department">
                            <option value="">Please Department *</option>
                            <option v-for='(Departmentdata,index) in Departmentdata' :key="index"
                                    :value='Departmentdata.id'>{{ Departmentdata.department_name }}
                            </option>
                        </select>
                        <span v-if="errors.department" class="text-danger">{{ errors.department }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-Mail *</label>
                        <input type="email" v-model="form.email" placeholder="" class="form-control">
                        <span v-if="errors.email" class="text-danger">{{ errors.email }}</span>
                    </div>


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Phone *</label>
                        <input type="text" placeholder="" v-model="form.phone" class="form-control">
                        <span v-if="errors.phone" class="text-danger">{{ errors.phone }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Address *</label>
                        <input type="text" placeholder="" v-model="form.address" class="form-control">
                        <span v-if="errors.address" class="text-danger">{{ errors.address }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>City *</label>
                        <input type="text" placeholder="" v-model="form.city" class="form-control">
                        <span v-if="errors.city" class="text-danger">{{ errors.city }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>State *</label>
                        <input type="text" placeholder="" v-model="form.state" class="form-control">
                        <span v-if="errors.state" class="text-danger">{{ errors.state }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Country *</label>
                        <input type="text" placeholder="" v-model="form.country" class="form-control">
                        <span v-if="errors.country" class="text-danger">{{ errors.country }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Pincode *</label>
                        <input type="text" placeholder="" v-model="form.pincode" class="form-control">
                        <span v-if="errors.pincode" class="text-danger">{{ errors.pincode }}</span>
                    </div>
                    <div class="col-lg-6 col-12 form-group">
                        <label>Description/experience</label>
                        <textarea class="textarea form-control" v-model="form.description" id="form-message"
                                  cols="10" rows="9"></textarea>

                        <span v-if="errors.description" class="text-danger">{{ errors.description }}</span>
                    </div>
                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Teacher Photo (150px X 150px)</label>
                        <input accept="image/*" type="file" @input="form.photo = $event.target.files"/>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>

</template>

<script>


import Layout from '@/Shared/Layout'


export default {
    props: {
        'Departmentdata': {},
        errors: Object,
    },
    components: {},
    layout: Layout,
    data() {
        return {

            form: this.$inertia.form({
                first_name: '',
                last_name: '',
                father_name: '',
                mother_name: '',
                spouse_name: '',
                gender: '',
                dob: '',
                department: '',
                blood_group: '',
                religion: '',
                email: '',
                phone: '',
                address: '',
                city: '',
                state: '',
                country: '',
                pincode: '',
                photo: '',

            }),
            errors: {},

        }
    },
    methods: {
        submit() {
            this.errors = {};
            this.form.post('/teacher', {
                onSuccess: () => Toast.fire({
                    icon: 'success',
                    title: 'New Teacher is added !!!'
                }),
                onError: (errors) => this.errors = errors,
                preserveScroll: true
            });

        },


    }
}

</script>


