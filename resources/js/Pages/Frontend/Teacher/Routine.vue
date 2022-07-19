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
                <h3>Routines</h3>
                <ul>
                    <li>
                        <a href="index.html">Home</a>
                    </li>
                    <li>Routines</li>
                </ul>
            </div>
            <!-- Breadcubs Area End Here -->
            <!-- Class Table Area Start Here -->
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>My Routines</h3>

                            <p>Day: {{ day_name }}</p>
                        </div>

                    </div>

                    <div class="">
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
                        <!-- <div class="col-8">
                            <div class="text-right">
                                <a href="/department" class="btn btn-primary"><i
                                    class="fas fa-plus"></i> Add Department</a>
                            </div>
                        </div> -->

                    </div>

                    <div class="table-responsive">
                        <table class="table display data-table text-nowrap">
                            <thead>
                            <tr >
                                <th>
                                    <div>

                                        <label>S. No.</label>
                                    </div>
                                </th>
                                <th>Subject</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Period</th>
                                <th>Break</th>
                                <!-- <th>Day</th> -->
                                <!-- <th></th> -->
                            </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(routine,index) in routines.data" :key="index">

                                <td>
                                    <div>

                                        <label>{{index+1}}</label>
                                    </div>
                                </td>

                                <td>{{routine.subject.subject_name}}</td>
                                <td>{{routine.class.class_name}}</td>
                                <td>{{ routine.section.section_name }}</td>
                                <td>{{ routine.start_time }} to {{ routine.end_time }}</td>
                                <td>{{ routine.start_break }} to {{ routine.end_break }}</td>
                                <!-- <td>
                                    <a :href="'/teachers/attendance/'+routine.id" class="btn btn-info">Attendance</a>
                                </td> -->
                            </tr>



                            </tbody>
                        </table>
                        <pagination class="mt-6" :links="routines.links" />
                    </div>
                </div>
            </div>
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

    export default {
        props:{
            'routines':{},
            filters: Object,
        },
        data(){
            return {
                showUpdateModal: false,
                indexForm: {
                    search: this.filters.search,
                },
                updateData : {},
            }
        },
        components: {
            'FooterComponant': Footer,
            'HeaderComponant': Header,
            'NavComponant': Nav,
            'SidebarComponant': Sidebar,
            Pagination
        },
        watch: {
            'indexForm.search': {
                handler: throttle(function () {
                    this.$inertia.get('/teachers/routine', pickBy(this.indexForm), {preserveState: true})
                }, 150),
            },
        },
        computed: {
            day_name: function() {
                var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                var d = new Date();
                return days[d.getDay()];
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