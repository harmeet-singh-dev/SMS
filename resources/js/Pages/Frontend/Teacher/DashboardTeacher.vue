<template>
 <header-componant />
<nav-componant />
 <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->

            <sidebar-componant />            

            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Harmeet Dashboard</h3>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->

                <div class="content">
                    <div class="row gutters-20">
                        <div class="col-12 pt-5">
                            <h2><b>New Notices</b></h2>
                        </div>
                        <div 
                            class="col-xl-3 col-sm-6 col-12"
                            v-for="notice in notices" 
                            :key="notice.id"
                        >
                            <div class="dashboard-summery-one mg-b-20">
                                <div class="row align-items-center">
                                    <div class="col-12">
                                        <div class="title">
                                            <h3>{{ notice.title }}</h3>
                                        </div>
                                        <div class="description">
                                            <p>{{ notice.description }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p><small><b>By: </b>{{ notice.posted_by }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer-componant />
            </div>
            
       </div>

</template>

<script>
    import Footer from '@/Pages/Admin/Footer.vue'
    import Header from '@/Pages/Admin/Header.vue'
    import Nav from '@/Pages/Admin/Nav.vue'
    import Sidebar from '@/Pages/Frontend/Teacher/Includes/Sidebar.vue'

    export default {
        props:{
            'notices' : {type : Object}
        },

        components: {
            'FooterComponant': Footer,
            'HeaderComponant': Header,
            'NavComponant': Nav,
            'SidebarComponant': Sidebar
        },
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