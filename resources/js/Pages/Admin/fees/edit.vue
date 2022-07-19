<template>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">

        <ul>
            <li>
                <a href="dashboard">Dashboard</a>
            </li>
            <li>Add Fees</li>
        </ul>

    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Add Student Fees</h3>
                </div>

            </div>
            <form @submit.prevent="submit">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Select Class Name *</label>
                        <select class="form-control" v-model="form.class_id">
                            <option value="">Select Class Name</option>
                            <option v-for="(class_data,index) in classes" :key="index" :value="class_data.id">
                                {{ class_data.class_name }}
                            </option>
                        </select>
                        <span v-if="errors.class_id" class="text-danger">{{ errors.class_id }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Select Section Name *</label>
                        <select class="form-control" v-model="form.section_id">
                            <option value="">Select Section Name</option>
                            <option v-for="(section_data,index) in section" :key="index" :value="section_data.id">
                                {{ section_data.section_name }}
                            </option>
                        </select>
                        <span v-if="errors.section_id" class="text-danger">{{ errors.section_id }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Student Name *</label>
                        <select class="form-control" @change="setfathername($event)" v-model="form.student_id">
                            <option value="">Select Student Name</option>
                            <option v-for="(student_data,index) in users_data" :key="index" :value="student_data.id">
                                {{ student_data.first_name }} {{ student_data.last_name }}
                            </option>
                        </select>
                        <span v-if="errors.student_id" class="text-danger">{{ errors.student_id }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Father Name *</label>
                        <input type="text" name="father_name" v-model="form.father_name">
                        <span v-if="errors.father_name" class="text-danger">{{ errors.father_name }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Payment Mode *</label>
                        <select class="form-control" v-model="form.payment_method">
                            <option>Select Payment Mode</option>
                            <option value="cash">Cash</option>
                            <option value="bank_deposit">Bank Deposit</option>
                            <option value="cheque">Cheque</option>
                            <option value="credit_card">Credit card</option>
                            <option value="debit_card">Debit card</option>
                            <option value="other">Other</option>

                        </select>
                        <span v-if="errors.payment_method" class="text-danger">{{ errors.payment_method }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Receipt Number</label>
                        <input type="text" name="receipt_number" v-model="form.receipt_number">
                        <span v-if="errors.receipt_number" class="text-danger">{{ errors.receipt_number }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Fee Interval *</label>
                        <select class="form-control" v-model="form.fee_deposit_interval">
                            <option value="">Select Fee Deposit Interval</option>
                            <option v-for="(interval,index) in fee_interval" :key="index" :value="index">
                                {{ interval }}
                            </option>
                        </select>
                        <span v-if="errors.fee_deposit_interval" class="text-danger">{{
                                errors.fee_deposit_interval
                            }}</span>
                    </div>


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Fees Submission Date *</label>
                        <input type="date" name="receipt_number" v-model="form.fees_submition_date">
                        <span v-if="errors.fees_submition_date" class="text-danger">{{
                                errors.fees_submition_date
                            }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Admission Fees</label>
                        <input type="text" name="admission_fees" v-model="form.addmission_fee">
                        <span v-if="errors.addmission_fee" class="text-danger">{{ errors.addmission_fee }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Tuition Fees</label>
                        <input type="text" name="tuition_fees" v-model="form.tution_fee">
                        <span v-if="errors.tution_fee" class="text-danger">{{ errors.tution_fee }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Sports Fees</label>
                        <input type="text" name="sports_fees" v-model="form.sports_fee">
                        <span v-if="errors.sports_fee" class="text-danger">{{ errors.sports_fee }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Hostel Fees</label>
                        <input type="text" name="hostel_fees" v-model="form.hostel_fee">
                        <span v-if="errors.hostel_fee" class="text-danger">{{ errors.hostel_fee }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Food Fees</label>
                        <input type="text" name="food_fees" v-model="form.food_fee">
                        <span v-if="errors.food_fee" class="text-danger">{{ errors.food_fee }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Transportation Fees</label>
                        <input type="text" name="transportation_fees" v-model="form.transpotation_fee">
                        <span v-if="errors.transpotation_fee" class="text-danger">{{ errors.transpotation_fee }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Activity Fees</label>
                        <input type="text" name="activity_fees" v-model="form.activity_fees">
                        <span v-if="errors.activity_fees" class="text-danger">{{ errors.activity_fees }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Extra Class Fees</label>
                        <input type="text" name="extra_class_fees" v-model="form.extra_class_fees">
                        <span v-if="errors.extra_class_fees" class="text-danger">{{ errors.extra_class_fees }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Other</label>
                        <input type="text" name="other" v-model="form.others">
                        <span v-if="errors.others" class="text-danger">{{ errors.others }}</span>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Penality</label>
                        <input type="text" name="penality" v-model="form.penality">
                        <span v-if="errors.penality" class="text-danger">{{ errors.penality }}</span>
                    </div>


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Pending Dues</label>
                        <input type="text" name="pending_dues" v-model="form.pending_due">
                        <span v-if="errors.pending_due" class="text-danger">{{ errors.pending_due }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Total Fees*</label>
                        <input type="text" name="total_fees" v-model="form.total_fee">
                        <span v-if="errors.total_fee" class="text-danger">{{ errors.total_fee }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Fee Month</label>
                        <input type="month" name="fee_month" v-model="form.fee_month">
                        <span v-if="errors.fee_month" class="text-danger">{{ errors.fee_month }}</span>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Notes*</label>
                        <textarea type="text" name="note" class="form-group" v-model="form.note">    </textarea>
                        <span v-if="errors.note" class="text-danger">{{ errors.note }}</span>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
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
        fee : Object,
        errors: Object,
        'classes': {},
        'section': {},
        'users_data': {},
        'father_data': {},
        'fee_interval': {},
    },
    components: {},

    layout: Layout,


    data() {
        return {
            form: this.$inertia.form(this.fee),


        }
    },
    methods: {
        submit() {
          this.form.put(`/fees/${this.fee.id}`)

        },
        setfathername(event) {
            this.father_set = false;
            this.father_data.forEach(element => {
                if (element.child_id.toString() === event.target.value) {
                    this.form.father_name = element.first_name;
                    this.father_set = true;
                }
            });
            if (this.father_set === false) {
                this.form.father_name = '';
            }
        },
        getTotalFee() {

            let addmission_fee = isNaN(parseInt(this.form.addmission_fee)) ? 0 : parseInt(this.form.addmission_fee);
            let tution_fee = isNaN(parseInt(this.form.tution_fee)) ? 0 : parseInt(this.form.tution_fee);
            let sports_fee = isNaN(parseInt(this.form.sports_fee)) ? 0 : parseInt(this.form.sports_fee);
            let hostel_fee = isNaN(parseInt(this.form.hostel_fee)) ? 0 : parseInt(this.form.hostel_fee);
            let food_fee = isNaN(parseInt(this.form.food_fee)) ? 0 : parseInt(this.form.food_fee);
            let transpotation_fee = isNaN(parseInt(this.form.transportation_fees)) ? 0 : parseInt(this.form.transportation_fees);
            let activity_fees = isNaN(parseInt(this.form.activity_fees)) ? 0 : parseInt(this.form.activity_fees);
            let extra_class_fees = isNaN(parseInt(this.form.extra_class_fees)) ? 0 : parseInt(this.form.extra_class_fees);
            let others = isNaN(parseInt(this.form.others)) ? 0 : parseInt(this.form.others);
            let penality = isNaN(parseInt(this.form.penality)) ? 0 : parseInt(this.form.penality);
            let pending_due = isNaN(parseInt(this.form.pending_due)) ? 0 : parseInt(this.form.pending_due);
            return addmission_fee + tution_fee + sports_fee + hostel_fee + food_fee + transpotation_fee +
                activity_fees + extra_class_fees + others - penality - pending_due;
        }
    },
    //update total fee based on other fees watch
    watch: {
        'form': {
            handler: function (newValue, oldValue) {
                this.form.total_fee = this.getTotalFee();
            },
            deep: true,
        },
    },


}

</script>


