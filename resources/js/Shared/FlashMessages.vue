<template>

</template>

<script>
import Swal from "sweetalert2";

export default {
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                //show sweet alert in center
                console.log(this.$page.props.flash);
                if (this.$page.props.flash.success) {
                    Swal.fire({
                        title: 'Success',
                        icon: 'success',
                        text: this.$page.props.flash.success,
                        type: 'success',
                        confirmButtonText: 'OK'
                    })
                } else if (this.$page.props.flash.error) {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        text: this.$page.props.flash.error,
                        type: 'error',
                        confirmButtonText: 'OK'
                    })
                }
            },
            deep: true,
        },
    },
}
</script>
