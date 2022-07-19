<template>
    <header-componant />
    <nav-componant />
 <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->

        <sidebar-componant />            

        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Student Attendence</h3>
                <ul>
                    <li>
                        <a href="/teachers/dashboard">Home</a>
                    </li>
                    <li>Attendence</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Student Attendence</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" 
                                    data-toggle="dropdown" aria-expanded="false">...</a>
            
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <form class="new-added-form">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Select Month</label>
                                        <select class="select2" v-model="month" @change="filterAttendance">
                                            <option value="0">Select Month</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Select Year</label>
                                        <select class="select2" v-model="year" @change="filterAttendance">
                                            <option value="0">Select Session</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Student Attendence Area Start Here -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Attendence Sheet Of Class {{ class_teacher.class.class_name }}: {{ class_teacher.section.section_name }}, {{ month_name }} {{ year }}</h3>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" 
                                    data-toggle="dropdown" aria-expanded="false">...</a>
            
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table bs-table table-striped table-bordered text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="text-left">Students</th>
                                            <th v-for="day in month_days" :key="day">{{ day }}</th>
                                            <th></th>
                                        </tr>
                                    </thead> 
                                    <tbody>
                                        <tr v-for="student in students" :key="student.id">
                                            <td class="text-left">{{ student.user.first_name }} {{ student.user.last_name }}</td>
                                            <td v-for="(student_attendance, index) in attendance[student.id]" :key="index">
                                                <span @click="updateAttendance(student.id, index)">
                                                    <i v-if="student_attendance == 1" class="fas fa-check text-success"></i>
                                                    <i v-else class="fas fa-times text-danger"></i>
                                                </span>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-primary" @click="sendSms(student.id)">Send SMS</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Student Attendence Area End Here -->
            <footer-componant />
        </div>

    </div>

</template>

<script>
    import Footer from '@/Pages/Admin/Footer.vue'
    import Header from '@/Pages/Admin/Header.vue'
    import Nav from '@/Pages/Admin/Nav.vue'
    import Sidebar from '@/Pages/Frontend/Teacher/Includes/Sidebar.vue'
    import Pagination from '@/Shared/Pagination'
    import throttle from "lodash/throttle";
    import pickBy from "lodash/pickBy";
    import axios from "axios";

    export default {
        props:{
            'students': {},
            'class_teacher': {},
            'attendance': {},
            'filters': {},
            'month_days': String
            // 'month': String,
            // 'year': String
        },
        data(){
            return {
                month: 1,
                year: 2022,
                indexForm: {
                    month: this.filters.month,
                    year: this.filters.year
                },
            }
        },
        components: {
            'FooterComponant': Footer,
            'HeaderComponant': Header,
            'NavComponant': Nav,
            'SidebarComponant': Sidebar,
            Pagination
        },
        created() {
            var date = new Date();
            this.month = date.getMonth() + 1;
            this.year = date.getFullYear();
        },
        computed: {
            month_name: function() {
                const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                return months[this.month - 1];
            }
        },
        methods: {
            updateAttendance(student_id, day) {
                const data = {
                    day: day,
                    class_teacher_id: this.class_teacher.id,
                    month: this.month,
                    year: this.year
                }
                axios.post('/teachers/student/'+ student_id +'/attendance', data)
                    .then((response) => {
                        this.attendance[student_id][day] = !this.attendance[student_id][day];
                    })
            },
            sendSms(student_id) {
                this.$swal('SMS Send Successfully !');
            },
            filterAttendance() {
                const data = {
                    month: this.month,
                    year: this.year
                }
                this.$inertia.get('/teachers/attendance/'+this.class_teacher.id+'/show', data, {preserveState: true});
            }
        }
    }
</script>

<style scoped>
.dashboard-page-one {
    min-height: 91vh;
}
.content {
    min-height: 62vh;
}
</style>