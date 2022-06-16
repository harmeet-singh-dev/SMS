<template>
    <Head title="Log in" />

 <section class="form my-5 mx-5">
        <div class="container">
            <div class="row no-gutters">
                <div class= "col-xs-12 col-md-12 col-lg-5">
                    <img src="/custom_folder/img/books.jpg" class="img-fluid" alt="bookimage">
                </div>
                <div class="col-lg-7 px-5 pt-4">
                    <img src="/custom_folder/img/logo1.jpg" class="img-fluid img1" alt="bookimage" style="width:6rem">
                    <h4>Sign into your account</h4>
                   <form @submit.prevent="submit">
                        <div class="form-row">
                            <div class="col-lg-7">
                            <input type="email" v-model="form.email" placeholder="email-address" class="form-control my-3 p-4">
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                            <input type="password" v-model="form.password" placeholder="******" class="form-control my-3 p-4">
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="col-lg-7">
                            <button  class="btn1 mt-3 mb-5">Login</button>
                        </div>
                        </div>
                        <a href="#">Forgot password?</a>
                        <p>Don't have an account? <a href="#">Register here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        props: {
            canResetPassword: Boolean,
            status: String
        },

        data() {
            return {
                form: this.$inertia.form({
                    email: '',
                    password: '',
                    remember: false
                })
            }
        },

        methods: {
            submit() {
                this.form
                    .transform(data => ({
                        ... data,
                        remember: this.form.remember ? 'on' : ''
                    }))
                    .post(this.route('login'), {
                        onFinish: () => this.form.reset('password'),
                    })
            }
        }
    })
</script>
