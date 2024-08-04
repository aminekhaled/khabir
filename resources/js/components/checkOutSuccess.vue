<template>
    <navbar></navbar>

    <h1>تم إتمام عملية الشراء بنجاح</h1>

    <My-Footer></My-Footer>
</template>



<script>

    import Navbar from "./includes/NavBar.vue";
    import MyFooter from "./includes/MyFooter.vue";

    export default {
        components: {
            Navbar,
            MyFooter
        },
        data() {
            return {
                token: localStorage.token,
            }
        },
        methods: {
            SuccessCheckOut() {
                const url = new URL(window.location.href);
                const sessionId = url.searchParams.get('session_id');
                axios.post("api/stripe/success", {session_id:sessionId}, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                }).then(response=> {
                    if(response.data.status == 'success') {
                        localStorage.CoursesCartNumber = 0;
                        window.location.href = 'profile/courses';
                    }
                })
            }
        },
        created(){
            this.SuccessCheckOut();
        }
    }

</script>





