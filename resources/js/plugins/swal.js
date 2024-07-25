import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(VueSweetalert2);
import 'sweetalert2/dist/sweetalert2.min.css';

Vue.prototype.$swalSuccessToast = function(heading) {
    this.$swal({
        title:heading,
        position: 'bottom-end',
        timer: 1500,
        showConfirmButton: false,
        icon: "success",
        toast: true
    });
  }

  Vue.prototype.$swalErrorToast = function(heading) {
    this.$swal({
        title:heading,
        position: 'bottom-end',
        timer: 1500,
        showConfirmButton: false,
        icon: "error",
        toast: true
    });
  }
