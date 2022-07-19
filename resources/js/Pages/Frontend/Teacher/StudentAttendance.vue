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
                <!-- Student Attendence Area Start Here -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Attendence Sheet Of Class {{ class_teacher.class.class_name }}: {{ class_teacher.section.section_name }}, April 2019</h3>
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
            'students':{},
            'class_teacher': {},
            'attendance': {},
            'month_days': String
        },
        data(){
            return {
                students_attendance: []
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
            this.students.map(function(value, key) {
                // console.log(value)
            })
        },
        methods: {
            updateAttendance(student_id, day) {
                const data = {
                    day: day,
                    class_teacher_id: this.class_teacher.id
                }
                axios.post('/teachers/student/'+ student_id +'/attendance', data)
                    .then((response) => {
                        this.attendance[student_id][day] = !this.attendance[student_id][day];
                    })
            },
            sendSms(student_id) {
                this.$swal('SMS Send Successfully !');
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