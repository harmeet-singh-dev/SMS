<template>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Student</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add New Student</h3>
                </div>
                <!-- Simple success message -->
                <!--span v-if="success" :class="text-success">Record submitted successfully!</!--span-->
            </div>


            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Unique ID *</label>
                        <input type="text" v-model="form.unique_id" placeholder="" class="form-control">
                        <span v-if="errors.unique_id" class="text-danger">{{ errors.unique_id }}</span>
                    </div>
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
                        <label>Father Email *</label>
                        <input type="email" v-model="form.father_email" placeholder="" class="form-control">
                        <span v-if="errors.father_email" class="text-danger">{{ errors.father_email }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Mother Name *</label>
                        <input type="text" v-model="form.mother_name" placeholder="" class="form-control">
                        <span v-if="errors.mother_name" class="text-danger">{{ errors.mother_name }}</span>
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
                        <label>Roll *</label>
                        <input type="text" v-model="form.roll" placeholder="" class="form-control">
                        <span v-if="errors.roll" class="text-danger">{{ errors.roll }}</span>
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
                        <label>E-Mail *</label>
                        <input type="email" v-model="form.email" placeholder="" class="form-control">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Class *</label>
                        <select class="select2" v-model="form.classname">

                            <option value="">Please Select Class *</option>

                            <option v-for='(data,index) in Classesdata' :key="index" :value='data.id'>{{
                                    data.class_name
                                }}
                            </option>

                        </select>
                        <span v-if="errors.classname" class="text-danger">{{ errors.classname }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Section *</label>
                        <select class="select2" v-model="form.section">
                            <option value="">Please Select Section *</option>

                            <option v-for='(Sectiondata,index) in Sectiondata' :key="index" :value='Sectiondata.id'>
                                {{ Sectiondata.section_name }}
                            </option>

                        </select>
                        <span v-if="errors.section" class="text-danger">{{ errors.section }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Admission ID *</label>
                        <input type="text" placeholder="" v-model="form.admission" class="form-control">
                        <span v-if="errors.admission" class="text-danger">{{ errors.admission }}</span>
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

                    <div class="col-lg-6 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Student Photo (150px X 150px)</label>
                        <input accept="image/*" type="file" @input="form.photo = $event.target.files"/>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
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
        'Classesdata': {},
        'Sectiondata': {},
    },
    components: {},

    layout: Layout,

    data() {
        return {

            form: this.$inertia.form({
                unique_id: '',
                first_name: '',
                last_name: '',
                father_name: '',
                father_email: '',
                mother_name: '',
                gender: '',
                dob: '',
                roll: '',
                blood_group: '',
                religion: '',
                email: '',
                classname: '',
                section: '',
                admission: '',
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
            this.form.post('/student', {
                onError: (errors) => this.errors = errors,
                preserveScroll: true
            });

        },


    }
}

</script>


