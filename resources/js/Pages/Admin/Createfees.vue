<template>
    \
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
                        <select class="form-control" v-model="form.class_name">
                            <option value="">Select Class Name</option>
                            <option v-for="(class_data,index) in classes" :key="index" :value="class_data.id">
                                {{ class_data.class_name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Select Section Name *</label>
                        <select class="form-control" v-model="form.section_name">
                            <option value="">Select Section Name</option>
                            <option v-for="(section_data,index) in section" :key="index" :value="section_data.id">
                                {{ section_data.section_name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Student Name *</label>
                        <select class="form-control" @change="setfathername($event)" v-model="form.student_name">
                            <option value="">Select Student Name</option>
                            <option v-for="(student_data,index) in users_data" :key="index" :value="student_data.id">
                                {{ student_data.first_name }} {{ student_data.last_name }}
                            </option>
                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Father Name *</label>
                        <input type="text" name="father_name" v-model="father_name">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Payment Mode *</label>
                        <select class="form-control" v-model="form.paymentMethod">
                            <option>Select Payment Mode</option>
                            <option value="cash">Cash</option>
                            <option value="bank_deposit">Bank Deposit</option>
                            <option value="cheque">Cheque</option>
                            <option value="credit_card">Credit card</option>
                            <option value="debit_card">Debit card</option>
                            <option value="other">Other</option>

                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Receipt Number</label>
                        <input type="text" name="receipt_number" v-model="form.receiptNumber">
                    </div>


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Fees Submission Date *</label>
                        <input type="date" name="receipt_number" v-model="form.feesSubmitionDate">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Admission Fees</label>
                        <input type="text" name="admission_fees" v-model="form.addmissionFee">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Tuition Fees</label>
                        <input type="text" name="tuition_fees" v-model="form.tutuionFee">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Sports Fees</label>
                        <input type="text" name="sports_fees" v-model="form.sportsFee">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Hostel Fees</label>
                        <input type="text" name="hostel_fees" v-model="form.hostelFee">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Food Fees</label>
                        <input type="text" name="food_fees" v-model="form.foodFee">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Transportation Fees</label>
                        <input type="text" name="transportation_fees" v-model="form.transpotationFee">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Activity Fees</label>
                        <input type="text" name="activity_fees" v-model="form.activityFees">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Extra Class Fees</label>
                        <input type="text" name="extra_class_fees" v-model="form.extraClassFees">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Other</label>
                        <input type="text" name="other" v-model="form.others">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Penality</label>
                        <input type="text" name="penality" v-model="form.penality">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Pending Dues</label>
                        <input type="text" name="pending_dues" v-model="form.pendingDue">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Total Fees*</label>
                        <input type="text" name="total_fees" v-model="form.totalFee">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Fee Date</label>

                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Notes*</label>
                        <textarea type="text" name="note" class="form-group" v-model="form.note">    </textarea>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
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
        'classes': {},
        'section': {},
        'users_data': {},
        'father_data': {},
    },
    components: {},

    layout: Layout,


    data() {
        return {
            form: {
                class_name: '',
                section_name: '',
                student_name: '',
                father_name: '',
                father_set: false,
                paymentMethod: '',
                receiptNumber: '',
                feesSubmitionDate: '',
                addmissionFee: '',
                tutuionFee: '',
                sportsFee: '',
                hostelFee: '',
                foodFee: '',
                transpotationFee: '',
                activityFees: '',
                extraClassFees: '',
                others: '',
                penality: '',
                pendingDue: '',
                totalFee: '',
                note: ''
            },


        }
    },
    methods: {
        setfathername(event) {
            this.father_set = false;
            this.father_data.forEach(element => {
                if (element.child_id.toString() === event.target.value) {
                    this.father_name = element.first_name;
                    this.father_set = true;
                }
            });
            if (this.father_set === false) {
                this.father_name = '';
            }
        }
    }


}

</script>


