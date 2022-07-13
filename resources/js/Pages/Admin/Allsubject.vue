<template>

    <div v-if="showUpdateModal">
        <transition name="modal">
            <div class="modal-mask">
                <div class="modal-wrapper">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Update Subject Name</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" @click="showUpdateModal = false">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="first_name">Subject Name</label>
                                    <input type="text" class="form-control" id="subject_name"
                                           v-model="updateData.subject_name">
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
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Subject</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>All Subject</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Class Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Subject</h3>
                </div>

            </div>
            <div class="row">
                <div class="col-4">
                    <div class="input-group">
                        <input type="text" class="form-control" v-model="indexForm.search" placeholder="Search">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="text-right">
                        <a href="/subject" class="btn btn-primary"><i
                            class="fas fa-plus"></i> Add Subject</a>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table display data-table text-nowrap">
                    <thead>
                    <tr>
                        <th>
                            <div>

                                <label>S. No.</label>
                            </div>
                        </th>
                        <th>Subject Name</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(user,index) in subject.data" :key="index">

                        <td>
                            <div>

                                <label>{{ index + 1 }}</label>
                            </div>
                        </td>

                        <td>{{ user.subject_name }}</td>

                        <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" @click="showUpdate(user)"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i> Edit</a>
                                    <button class="dropdown-item" @click="destroy(user.id)"><i
                                        class="fas fa-times text-orange-red"></i>Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>


                    </tbody>
                </table>
                <pagination class="mt-6" :links="subject.links"/>
            </div>
        </div>
    </div>
</template>
<script>

import Pagination from '@/Shared/Pagination'
import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import Layout from "@/Shared/Layout";

export default {
    props: {
        'subject': {},
        filters: Object,
    },
    data() {
        return {
            showUpdateModal: false,
            indexForm: {
                search: this.filters.search,
            },
            updateData: {},
        }
    },
    components: {
        Pagination
    },
    layout: Layout,
    methods: {

        destroy(id) {
            if (confirm('Are you sure you want to delete this?')) {
                this.$inertia.post('all-subject-destroy/destroy/' + id)
            }
        },

        update() {
            //show update popup
            this.$inertia.post(`/subject-update/update/${this.updateData.id}`, {
                data: this.updateData
            });
            this.showUpdateModal = false;
        },

        showUpdate(data) {
            //show update popup
            this.updateData = data;
            this.showUpdateModal = true;

        },
    },
    watch: {
        'indexForm.search': {
            handler: throttle(function () {
                this.$inertia.get('/all-subject', pickBy(this.indexForm), {preserveState: true})
            }, 150),
        }
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

.row {
    background: white;
    border-radius: 1px;
    box-shadow: none;
}
</style>
