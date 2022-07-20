<template>

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Class Routine</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add Class Routine</h3>
                </div>
                <!-- Simple success message -->
                <!--span v-if="success" :class="text-success">Record submitted successfully!</!--span-->
            </div>


            <form @submit.prevent="submit">
                <div class="row">

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Class *</label>
                        <select class="select2" v-model="form.class_name">
                            <option value="">Please Select Class *</option>
                            <option v-for='(classdata,index) in classes' :key="index" :value='classdata.id'>
                                {{ classdata.class_name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Section *</label>
                        <select class="select2" v-model="form.section_name">
                            <option value="">Please Select Section *</option>
                            <option v-for='(sectiondata,index) in section' :key="index" :value='sectiondata.id'>
                                {{ sectiondata.section_name }}
                            </option>
                        </select>
                    </div>
                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Subject </label>
                        <select class="select2" v-model="form.subject_name">
                            <option value="">Please Select Subject *</option>
                            <option v-for='(subjectdata,index) in subject' :key="index" :value='subjectdata.id'>
                                {{ subjectdata.subject_name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Teacher *</label>
                        <select class="select2" v-model="form.teacher_name">
                            <option value="">Please Select Teacher *</option>
                            <option v-for='(teacherdata,index) in teacher' :key="index" :value='teacherdata.id'>
                                {{ teacherdata.first_name }} {{ teacherdata.last_name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Select Time *</label>
                        <input class="select2" type="time" v-model="form.start_time">
                        <input class="select2" type="time" v-model="form.end_time">
                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Select Date</label>
                        <input class="select2" type="date" v-model="form.date">

                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Select Day</label>
                        <input type="checkbox" value="1" v-model="form.monday">
                        <input type="checkbox" value="1" v-model="form.tuesday">
                        <input type="checkbox" value="1" v-model="form.wednesday">
                        <input type="checkbox" value="1" v-model="form.thursday">
                        <input type="checkbox" value="1" v-model="form.friday">
                        <input type="checkbox" value="1" v-model="form.saturday">


                    </div>

                    <div class="col-12-xxxl col-lg-6 col-12 form-group">
                        <label>Break Time</label>
                        <input class="select2" type="time" v-model="form.start_break">
                        <input class="select2" type="time" v-model="form.end_break">
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
        'classes': {},
        'section': {},
        'subject': {},
        'teacher': {}
    },
    components: {
    },
    layout: Layout,

    data() {
        return {
            form: this.$inertia.form({
                class_name: '',
                section_name: '',
                subject_name: '',
                teacher_name: '',
                start_time: '',
                end_time: '',
                date: '',
                monday: '',
                tuesday: '',
                wednesday: '',
                thursday: '',
                friday: '',
                saturday: '',
                start_break: '',
                end_break: ''
            }),
            errors: {},

        }
    },
    methods: {
        submit() {
             this.form.post('/class-routine', {
                preserveScroll: true
            });
        },


    }
}

</script>


