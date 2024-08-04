<template>
    <navbar></navbar>




    <section id="all-courses-preview" class="d-flex">
    <section id="side-navbar" class="d-flex flex-column align-items-start">
    </section>

    <section id="courses" class="d-flex flex-column gap-5 align-items-start">

        <div class="header">
            <!-- <img src="../../../public/media/main/img1.png" alt=""> -->
            <img :src="'/media/main/img1.png'" alt="hero-image">

        </div>


                <div v-for="category in filteredCategories" :key="category.id" class="course-container d-flex gap-5 flex-column">
                    <div :id="'card-id-'+category.id" class="card-container d-flex gap-5 flex-wrap">
                        <div id="courses-content" class="courses-content d-flex gap-5 flex-wrap">
                            <div v-for="course in category.courses" :key="course.id" class="course-preview-card">
                                <div v-if="course.is_best_sell" class="best-seller">الافضل مبيعا</div>
                                <router-link :to="'/courses/show-content/'+course.id" style="color: #000; text"><img :src="'/media/main/'+course.img" alt="card-pic" class="card-pic"></router-link>
                                <!-- <a href="#" class="category">{{ category.name }}</a> -->
                                <div class="title"><router-link :to="'/courses/show-content/'+course.id" style="color: #000; text">{{course.title}}</router-link></div>
                                <div class="author">دورة مقدمة من قبل : {{ course.instractor }}</div>
                                <div class="description">
                                    {{course.small_description}}
                                </div>
                                <div class="rating-box">
                                    <span class="number d-flex align-items-center gap-1"><i class="fa-regular fa-user"></i>802</span>
                                    <span class="rating d-flex align-items-center"><i class="bx bx-like bx-flip-horizontal"></i>(2) 100%</span>
                                </div>
                                <div class="price-box">
                                    <div class="price" v-if="course.discount_status && course.original_price != null" >
                                        <div>
                                            <del>{{ course.original_price }}</del><del>SAR</del>
                                        </div>
                                        <span class="price-discount">{{ course.discountPercentage }}% خصم</span>
                                    </div>
                                </div>
                                <div @click="addToCart(course.id)" class="buy-button d-flex justify-content-center align-items-center gap-2">

                                    <div class="price d-flex flex-row-reverse gap-1">
                                        <span>{{ course.price }}</span>
                                    </div>
                                    <span>شراء الآن</span>
                                    <i class="bx bxs-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="line"></div>
                </div>
            <!-- @endif -->

        <div id="courses-control" class="d-flex align-items-center justify-content-center" onclick="setCoursesLimits()">
            <div class="button d-flex flex-column justify-content-center align-items-center">
                <h1>اكتشف المزيد</h1>
            </div>
        </div>
    </section>
</section>

<div id="popup-navbar" onclick="openPopup()">
    <div class="button">
        <h3> المزيد من التصنيفات
            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5"/>
            </svg>
        </h3>
    </div>
</div>

<div id="overlay" onclick="closePopup()"></div>





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
                token: localStorage.token,
                categories: [],
            }
        },
        methods: {
            getCategories() {
                // let token = localStorage.token;
                axios.get("api/categories/get-categories").then(response=> {
                    if(response.data.status == 'success') {
                        this.categories = response.data.categories;
                    }
                })
            },
            addToCart(course_id) {
                axios.post("api/cart/add-to-cart", {id:course_id}, {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                }).then(response=> {
                    if(response.data.status == 'success') {
                        this.$store.state.count = response.data.courses_number;

                        Swal.fire({
                            iconHtml: '<i style="color: #fd9802" class="fas fa-cart-plus fa-2x mb-3"></i>', // Use cart icon at the top
                            title: 'تمت الإضافة إلى السلة بنجاح',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                }).catch(error => {
                    if(error.response.status == "401")
                        window.location.href = '/login';
                });
            }
        },
        computed: {
            filteredCategories() {
                return this.categoriesWithDiscounts.filter(category => category.courses.length > 0);
            },
            categoriesWithDiscounts() {
                return this.categories.map(category => {
                    const discountedCourses = category.courses.map(course => {
                        const discountValue = ((course.original_price - course.price) * 100) / course.original_price;
                        return {
                            ...course,
                            discountPercentage: discountValue.toFixed()
                        };
                    });
                    return {
                        ...category,
                        courses: discountedCourses
                    };
                });
            }
        },
        created() {
            this.getCategories();
            console.log()
        }
    }

</script>


<style scoped>

body{
    position: relative;
}
/* ############################################################ */
/* #################    Courses page Start    ################# */
/* ############################################################ */
a{
    cursor: pointer !important;
}
#all-courses-preview{
    overflow: hidden;
    margin: 25px 0 40px 0;
}

#all-courses-preview #side-navbar{
    width: 17%;
    padding: 0 5% 0 3%;

}
#all-courses-preview #side-navbar .line{
    width: 100%;
    height: 3px;
    background-color: var(--second-color);

    margin-bottom: 20px;

}
#all-courses-preview #side-navbar .nav-title  {
    color: var(--main-color);

    font-size: clamp(12px, calc(100vw * 0.017), 24px);
    font-weight: 700;
    font-style: normal;
    line-height: 21.99px;

    margin-bottom: 15px;
}
#all-courses-preview #side-navbar .nav-content{
    width: 100%;
    display: flex;
    flex-direction: column;
    row-gap: 15px;
}

#all-courses-preview #side-navbar a{
    display: block;
    color: var(--main-color);

    font-size: clamp(9.5px, calc(100vw * 0.012), 16px);
    font-style: normal;
    font-weight: 400;
    line-height: 21.99px;

    text-decoration: none;
    transition: .3s;
}
#all-courses-preview #side-navbar .nav-content a:hover, #all-courses-preview #side-navbar .active{
    font-weight: 700;
    margin-right: -15px;
    padding-right: 15px;

    border-right: 2.5px solid #FD9802 !important;
}

#all-courses-preview #courses{
    width: 80%;
    padding-left: 7%;
}

#courses >*{
    width: 100%;
}
#courses .header  img{
    width: 100%;
    height: 194px;

    object-fit: cover;
    object-position: 0 calc(-1 * clamp(10px, calc(100vw * 0.0125), 35px));
}
#courses .course{
    position: relative;
}
#courses .course .course-details .description .title{
    color: #000;
    text-align: right;
    font-size: clamp(16px, calc(100vw * 0.017), 24px);
    font-style: normal;
    font-weight: 700;
    text-transform: uppercase;

    margin-bottom: 20px;
}
#courses .course .course-details .description .prent{
    width: 75%;
    color: #848484;

    text-align: right;
    font-size: clamp(12px, calc(100vw * 0.013), 18px);
    font-style: normal;
    font-weight: 400;
}
#courses .course .more{
    text-align: center;
    position: absolute;
    left: 0;
    bottom: 15px;
}
#courses .course .more a{
    color: var(--main-color);
}

#courses .course .more:hover .title,
#courses .course .more:hover svg path{
    text-decoration: underline !important;

    color: var(--second-color);
    fill: var(--second-color) !important;
}

#courses .course .title{
    color: #000;

    font-size: clamp(12px, calc(100vw * 0.013), 16px);
    font-weight: 700;
    line-height: 23.22px;
    font-style: normal;
    text-align: right;

    transition: .3s;
}
#courses .course .title svg{
    width: clamp(10px, calc(100vw * 0.013), 16px);
    height: clamp(10px, calc(100vw * 0.013), 16px);

    transition: .3s;
}

#courses .line{
    height: 2px;
    width: 164px !important;
    background-color: #FD9802;

    margin: 5px 0 -25px 0;
}

#courses-control .button{
    width: 200px;
    height: 50px;
    background-color: var(--second-color);
    color: #fff;

    margin: 20px 0;
    cursor: pointer;
}
#courses-control .button h1{
    color: #FFF;

    font-size: 18px;
    font-weight: 400;
    line-height: 24px;
    font-style: normal;

    margin: 0;
}

#all-courses-preview .scroll-buttons {
   display: none;
}

#popup-navbar{
    display: none;
    visibility: hidden;
    flex-direction: column;
    justify-content: center;

    width: 130px;
    height: 30px;

    position: fixed;
    z-index: 1000;
    bottom: 100px;
    left: 50%;
    transform: translateX(-50%);

    background-color: var(--main-color);
    filter: drop-shadow(0px 0px 12px var(--main-color));
}
#popup-navbar .button h3{
    font-size: 10px;
    font-weight: 700;
    text-align: center;
    color: var(--White);

    margin: 0;
}

#overlay {
    visibility: hidden;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 1000;

    transition: 0.5s ease-in;
}

/* ############################################################ */
/* #################  Courses page responsive ################# */

@media (width < 1135px) {
    #courses .card-container {
        flex-wrap: initial !important;
        overflow-x: scroll;
    }
    #courses .card-container::-webkit-scrollbar {
        display: none !important;
    }
    #courses .scroll-buttons {
        display: block;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 36px;
        width: 100%;
        margin-top: -20px;
        margin-inline: auto;
    }
}

@media (width <= 768px) {
    #all-courses-preview{
        justify-content: end;

        margin-top: -1px;
    }
    #all-courses-preview #side-navbar .nav-content a:hover, #all-courses-preview #side-navbar .active{
        margin: 0;
    }
    #side-navbar{
        width: 75vw !important;
        height: 85vh;

        position: fixed;
        z-index: 1001;

        left: 50%;
        bottom: 0;
        transform: translate(-50%, 100%);

        background-color: #fff;
        padding: 50px 50px 120px 50px !important;

        transition: 0.5s ease-out;
    }
    #side-navbar h1{
        width: 85%;
        font-size: 20px !important;
    }
    #nav-content{
        overflow-x: scroll;
        -webkit-overflow-scrolling: touch;

    }
    #side-navbar a{
        font-size: 12px !important;
    }
    #courses{
        padding: 0 20px !important;
        width: 100vw !important;
    }
    #courses .header{
        margin-right: -10px;
    }
    #courses .header  img{
        width: 100vw;
    }
    #courses .course .course-details .description .title{
        margin-bottom: 30px;
    }
    #courses .course .course-details .description .prent{
        width: 100%;
    }
    #courses .course .more{
        top: 2px;
        margin-left: 10px;
    }
    #courses .line{
        position: absolute;
        top: 30px;
        right: -30px;
    }

    #popup-navbar{
        display: flex !important;
    }
    .close-popup{
        display: block !important;
    }
}

</style>

