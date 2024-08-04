<template>
    <navbar></navbar>

    <div class="container vh-100">
        <div class="d-flex justify-content-center align-items-center mt-5">
            <div class="card">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item text-center">
                        <router-link style="border-radius: 0" class="nav-link btl" id="pills-home-tab" data-toggle="pill" to="/login" role="tab" aria-controls="pills-home" aria-selected="true">تسجيل الدخول</router-link>
                    </li>
                    <li class="nav-item text-center">
                        <router-link style="border-radius: 0" class="nav-link btr active" id="pills-profile-tab" data-toggle="pill" to="/register" role="tab" aria-controls="pills-profile" aria-selected="false">تسجيل حساب</router-link>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                </div>
                        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="form px-4">
                            <input type="text" v-model="name" class="form-control" placeholder="الإسم">
                            <input type="text" v-model="email" class="form-control" placeholder="رقم الهاتف">
                            <input type="email" v-model="phone_number" class="form-control" placeholder="البريد الإلكتروني">
                            <input type="text" v-model="country" class="form-control" placeholder="البلد">
                            <input type="password" v-model="password" class="form-control" placeholder="كلمة السر">
                            <input type="password" v-model="password_confirmation" class="form-control" placeholder="تأكيد كلمة السر">
                            <button @click="registerUser()" class="btn btn-dark btn-block">تسجيل حساب</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <My-Footer></My-Footer>
</template>



<script>

    import Swal from 'sweetalert2';
    import Navbar from "./includes/NavBar.vue";
    import MyFooter from "./includes/MyFooter.vue";

    export default {
        components: {
            Navbar,
            MyFooter
        },
        data() {
            return {
                name: "",
                phone_number: "",
                email: "",
                country: "",
                password: "",
                password_confirmation: "",
            }
        },
        // computed: {
        //     nameError(){
        //         return this.name.length > 0 && this.name.length < 4
        //     }
        // },
        methods: {
            registerUser() {

                axios.post("api/auth/register", {
                    name:this.name,
                    phone_number:this.phone_number,
                    email:this.email,
                    country:this.country,
                    password:this.password,
                    password_confirmation:this.password_confirmation,
                },).then(response=> {
                    if(response.data.status == 'success') {

                        localStorage.setItem("token", response.data.access_token);
                        localStorage.setItem("id", response.data.user.id);
                        localStorage.setItem("name", response.data.user.name);
                        localStorage.setItem("email", response.data.user.email);
                        localStorage.setItem("phone_number", response.data.user.phone_number);
                        localStorage.setItem("country", response.data.user.country);

                        Swal.fire({
                            iconHtml: '<i style="color: #fd9802" class="fas fa-check-circle fa-2x mb-3"></i>',
                            title: 'تم تسجيل الحساب بنجاح',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        setTimeout(() => {
                            window.location.href = "/";
                        }, 2000);

                    }
                })
            },
        },
        created() {
            // this.getCartCourses();
        }
    }

</script>


<style scoped>

    body{
        background-color: #000;
    }

    .card {
        width: 400px;
        border:none;
    }

    .btr{
        /* border-top-right-radius: 5px !important; */
    }

    .btl{
        border-top-left-radius: 5px !important;
    }

    .btn-dark {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .btn-dark:hover {
        color: #fff;
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    .nav-pills{
        display:table !important;
        width:100%;
    }

    .nav-item{
        display: table-cell;
        background: #0d6efd2e;
    }

    .form{
        padding: 10px;
        height: 300px;
    }

    .form input{
        margin-bottom: 12px;
        border-radius: 3px;
    }

    .form input:focus{
        box-shadow: none;
    }

    .form button{
        margin-top: 20px;
    }

</style>

