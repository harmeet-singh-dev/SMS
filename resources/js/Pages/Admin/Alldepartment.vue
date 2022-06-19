<template>
    <header-componant />
    <nav-componant />
    <div v-if="showUpdateModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Department Name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showUpdateModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first_name">Department Name</label>
                                    <input type="text" class="form-control" id="subject_name"
                                           v-model="updateData.department_name" >
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
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
            <div class="mobile-sidebar-header d-md-none">
                <div class="header-logo">
                    <a href="index.html"><img src="/custom_folder/img/logo1.png" alt="logo"></a>
                </div>
            </div>

            <div class="sidebar-menu-content">
                <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                    <li class="nav-item sidebar-nav-item">
                        <a href="/dashboard" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>

                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Sub Admin</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="/all-sub-admin" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Sub Admin</a>
                            </li>
                            <li class="nav-item">
                                <a href="sub-admin" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Create Sub Admin</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Students</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-student.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Students</a>
                            </li>
                            <li class="nav-item">
                                <a href="student" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Add New Student</a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Teachers</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-teacher.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Teachers</a>
                            </li>

                            <li class="nav-item">
                                <a href="teacher" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                    Teacher</a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-couple"></i><span>Parents</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-parents.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Parents</a>
                            </li>

                            <li class="nav-item">
                                <a href="add-parents.html" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                    Parent</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-couple"></i><span>Departments</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-parents.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Departments</a>
                            </li>

                            <li class="nav-item">
                                <a href="department" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                    Department</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-books"></i><span>Library</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-book.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Book</a>
                            </li>
                            <li class="nav-item">
                                <a href="add-book.html" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                    Book</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-technological"></i><span>Fees</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-fees.html" class="nav-link"><i class="fas fa-angle-right"></i>All Fees
                                    Collection</a>
                            </li>

                            <li class="nav-item">
                                <a href="fees" class="nav-link"><i class="fas fa-angle-right"></i>Add
                                    Fees</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Class</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-class.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Classes</a>
                            </li>
                            <li class="nav-item">
                                <a href="class" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                    Class</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Section</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-class.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Section</a>
                            </li>
                            <li class="nav-item">
                                <a href="section" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                                    Section</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Class Teacher</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-class.html" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Class Teacher</a>
                            </li>
                            <li class="nav-item">
                                <a href="class-teacher" class="nav-link"><i class="fas fa-angle-right"></i>Assign new class teacher</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Subject Name</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="all-subject" class="nav-link"><i class="fas fa-angle-right"></i>All
                                    Subject</a>
                            </li>
                            <li class="nav-item">
                                <a href="subject" class="nav-link"><i class="fas fa-angle-right"></i>Add new subject</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item">
                        <a href="class-routine.html" class="nav-link"><i class="flaticon-calendar"></i><span>Class
                                    Routine</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="student-attendence.html" class="nav-link"><i
                            class="flaticon-checklist"></i><span>Attendence</span></a>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Exam</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="exam-schedule.html" class="nav-link"><i class="fas fa-angle-right"></i>Exam
                                    Schedule</a>
                            </li>
                            <li class="nav-item">
                                <a href="exam-grade.html" class="nav-link"><i class="fas fa-angle-right"></i>Exam
                                    Grades</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="transport.html" class="nav-link"><i
                            class="flaticon-bus-side-view"></i><span>Transport</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="hostel.html" class="nav-link"><i class="flaticon-bed"></i><span>Hostel</span></a>
                    </li>

                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-script"></i><span>Notice</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="exam-schedule.html" class="nav-link"><i class="fas fa-angle-right"></i>All Notices</a>
                            </li>
                            <li class="nav-item">
                                <a href="notice" class="nav-link"><i class="fas fa-angle-right"></i>Add Notice</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="messaging.html" class="nav-link"><i
                            class="flaticon-chat"></i><span>Messeage</span></a>
                    </li>
                    <li class="nav-item sidebar-nav-item">
                        <a href="#" class="nav-link"><i class="flaticon-menu-1"></i><span>UI Elements</span></a>
                        <ul class="nav sub-group-menu">
                            <li class="nav-item">
                                <a href="notification-alart.html" class="nav-link"><i class="fas fa-angle-right"></i>Alart</a>
                            </li>
                            <li class="nav-item">
                                <a href="button.html" class="nav-link"><i class="fas fa-angle-right"></i>Button</a>
                            </li>
                            <li class="nav-item">
                                <a href="grid.html" class="nav-link"><i class="fas fa-angle-right"></i>Grid</a>
                            </li>
                            <li class="nav-item">
                                <a href="modal.html" class="nav-link"><i class="fas fa-angle-right"></i>Modal</a>
                            </li>
                            <li class="nav-item">
                                <a href="progress-bar.html" class="nav-link"><i class="fas fa-angle-right"></i>Progress Bar</a>
                            </li>
                            <li class="nav-item">
                                <a href="ui-tab.html" class="nav-link"><i class="fas fa-angle-right"></i>Tab</a>
                            </li>
                            <li class="nav-item">
                                <a href="ui-widget.html" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Widget</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="map.html" class="nav-link"><i
                            class="flaticon-planet-earth"></i><span>Map</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="account-settings.html" class="nav-link"><i
                            class="flaticon-settings"></i><span>Account</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Sidebar Area End Here -->
        <div class="dashboard-content-one">
            <!-- Breadcubs Area Start Here -->
            <div class="breadcrumbs-area">
                <h3>Department</h3>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>All Department</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Class Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>All Department</h3>
                        </div>

                    </div>

                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                            <tr >
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">S. No.</label>
                                    </div>
                                </th>
                                <th>Department Name</th>

                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(data,index) in department" :key="index">
                                <!--tr v-for="Classes in Data" :key="Classes"-->
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">{{index+1}}</label>
                                    </div>
                                </td>

                                <td>{{data.department_name}}</td>

                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">

                                            <a class="dropdown-item" @click="showUpdate(data)"><i
                                                class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                                            <button  class="dropdown-item"  @click="destroy(data.id)"><i class="fas fa-times text-orange-red"></i>Delete</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Class Table Area End Here -->

    <footer-componant />
</template>
<script>

import Header from '@/Pages/Admin/Header.vue'
import Nav from '@/Pages/Admin/Nav.vue'
import Footer from '@/Pages/Admin/Footer.vue'
export default {
    props:{
        'department':{},
    },
    data(){
        return {
            showUpdateModal: false,
            updateData : {},
        }
    },
    components: {

        HeaderComponant: Header,
        NavComponant: Nav,
        FooterComponant: Footer,
    },
    methods: {

        destroy(id){
            if (confirm('Are you sure you want to delete this?')) {
                this.$inertia.post('all-department-destroy/destroy/' + id)
            }
        },

        update() {
            //show update popup
            this.$inertia.post(`/department-update/update/${this.updateData.id}`, {
                data: this.updateData
            });
            this.showUpdateModal = false;
        },

        showUpdate(data) {
            //show update popup
            this.updateData = data;
            this.showUpdateModal = true;

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
</style>
