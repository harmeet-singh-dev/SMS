<template>
    <header-componant/>
    <nav-componant/>
    <!-- Page Area Start Here -->
    <div class="dashboard-page-one">
        <!-- Sidebar Area Start Here -->
        <sidebar/>

        <!-- Sidebar Area End Here -->


        <div class="dashboard-content-one">
            <flash-messages/>
            <slot/>
        </div>
    </div>
    <!-- Admit Form Area End Here -->
    <footer-componant/>

</template>

<script>
import Footer from '@/Shared/Footer.vue'
import Header from '@/Shared/Header.vue'
import Nav from '@/Shared/Nav.vue'
import Sidebar from '@/Shared/Sidebar.vue'
import FlashMessages from '@/Shared/FlashMessages.vue'

export default {
    components: {
        HeaderComponant: Header,
        FooterComponant: Footer,
        NavComponant: Nav,
        Sidebar,
        FlashMessages,
    },
    props: {
        auth: Object,
    },
}
</script>
