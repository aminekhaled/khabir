<template>
    <navbar></navbar>


    <section id="profile">

        <!-- ##################################################################################### -->
        <!-- ############################ Fixed-Content Start #################################### -->
        <!-- ##################################################################################### -->

        <section id="fixed-section">
            <div class="top-section mobile-view">
                <div class="content">
                    <div class="logout">
                        <a href="#">تسجيل الخروج</a>
                    </div>
                    <h1>حسابي</h1>
                </div>
            </div>

            <div class="line mobile-view"></div>

            <div class="user d-flex gap-3">
            <div :style="{ backgroundImage: `url(../media/users/${user_data.image})` }" class="image"></div>
                <div class="content">
                    <h1 class="desktop-view">مرحبا</h1>
                    <h3>{{ user_data.name }}</h3>
                </div>
            </div>

            <div class="info mobile-view">
                <h1>معلومات الحساب</h1>
            </div>

            <div class="sections">

                <div class="partition">
                    <router-link to="/profile">
                        <h1>تفاصيل الحساب</h1>
                    </router-link>
                </div>

                <div class="line desktop-view"></div>

                <div class="partition">
                    <router-link to="/profile/courses">
                        <h1>دوراتي</h1>
                    </router-link>
                </div>

                <div class="line desktop-view"></div>

                <div class="partition active">
                    <router-link to="/profile/certificates">
                        <h1>شهاداتي</h1>
                    </router-link>
                </div>

                <div class="line desktop-view"></div>
            </div>
            <div class="logout desktop-view">
                <a href="#">تسجيل الخروج</a>
            </div>
        </section>

        <div class="line mobile-view"></div>

        <!-- ===== Fixed-Section END ============================================================= -->
        <!-- ===================================================================================== -->


        <!-- ##################################################################################### -->
        <!-- ########################### Section-Content Start ################################### -->
        <!-- ##################################################################################### -->
        <section id="section-content">


            <section class="section-content-3">
                <h1 class="section-3-title">شهاداتي</h1>
                <!-- condition if related content exists echoes it out from database  -->
                <!-- else print out the below message -->
                <div class="content">
                    <h5 class="profile-no-content">عذرا ليس لديك شهادات في الوقت الحالي لعرضها</h5>
                </div>
            </section>

        </section>
    </section>

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
                user_data: [],
            }
        },
        methods: {
            async getUserData() {
                // let token = localStorage.token;
                axios.get("api/profile/get-user-data", {
                    headers: {
                        Authorization: `Bearer ${this.token}`
                    }
                }).then(response=> {
                    if(response.data.status == 'success') {
                        this.user_data = response.data.user_data;
                    }
                })
            },
        },
        created() {
            this.getUserData();
        }
    }

</script>



<style scoped>

* {
  transition: 0.3s !important;
}
#profile {
  width: 100%;
  min-height: 80vh;

  display: flex;
  gap: 5%;

  padding: 100px clamp(45px, calc(100vw * 0.057), 80px);

  position: relative;
}
@media screen and (width <= 768px) {
  #profile {
    flex-direction: column;
    justify-content: center;
    align-items: center;

    padding: 50px clamp(25px, calc(100vw * 0.052), 50px);

    #fixed-section{
        width: 100%;

        .line{
            width: 100%;
        }
        .top-section {
        width: 100%;
        position: relative;

        .content {
            h1 {
                font-size: clamp(24px, calc(100vw * 0.06), 45px);
                text-align: center;
            }
            .logout {
                position: absolute;
                left: 0;
                bottom: 0;

                a {
                    color: var(--second-color);
                    font-size: clamp(11px, calc(100vw * 0.026), 20px);
                }
            }
        }
    }
    }
    .line {
      margin: 30px 0;
      background-color: #0d1b39;
      width: 85%;
    }
  }
  .mobile-view {
    display: block !important;
  }
  .desktop-view {
    display: none !important;
  }
}

/* ############################################################# */
/* ################## Fixed-Section Start ###################### */
/* ############################################################# */
#fixed-section {
  width: 30%;

  .user {
    margin-bottom: 40px;

    .image {
      width: clamp(50px, calc(100vw * 0.056), 78px);
      height: clamp(50px, calc(100vw * 0.056), 78px);
      border-radius: 50%;

      background-image: url(../media/default/profile_picture/profile.png);
      background-position: center;
      background-size: cover;
    }
    .content {
      h1 {
        height: 50%;
        color: #3e4145;
        text-align: right;
        font-size: clamp(18px, calc(100vw * 0.018), 25px);
        font-weight: 600;
        text-transform: capitalize;
        margin: 0;
      }
      h3 {
        color: #888;
        text-align: right;
        font-size: clamp(15px, calc(100vw * 0.014), 20px);
        font-weight: 400;
        height: 50%;
      }
    }
  }
  .sections {
    margin-bottom: 30px;

    .line {
      height: 1px;
      width: 100%;
      background-color: rgba(0, 0, 0, 0.25);
    }
    .partition {
      width: 100%;
      height: clamp(50px, calc(100vw * 0.043), 72px);

      display: flex;
      flex-direction: column;
      justify-content: center;

      cursor: pointer;
      transition: 0.2s;

            a{
                display: flex;
                justify-content: flex-start;
                align-items: center;

                width: 100%;
                height: 100%;
                text-decoration: none;

                h1{
                    margin: 0;
                    font-size:  clamp(15px, calc(100vw * 0.014), 20px);
                    font-weight: 500;
                    color: var(--main-color);

                }
            }
        }
        .partition:hover{
            background-color: rgba(0, 0, 0, 0.15);
        }
        .active{
            background-color: var(--second-color);

            a h1{
                color: var(--White);
            }
        }
        a{
            padding-right:  clamp(10px, calc(100vw * 0.021), 30px);
        }
    }
    .logout{
        display: flex;
        flex-direction: row-reverse;

        a{
            text-decoration: none;
            color: #3E4145;

            font-size:  clamp(15px, calc(100vw * 0.014), 20px);
            font-weight: 500;
            transition: .3s;
        }
        a:hover{
            text-decoration: underline;
            color: var(--second-color);
        }
    }
}

/* ############################################################# */
/* ############### Fixed-Section Responsive #################### */
@media screen and (width <= 768px) {
  #fixed-section {
    width: 90%;

    .user {
      margin-bottom: 20px;

      .image {
        width: clamp(50px, calc(100vw * 0.083), 64px);
        height: clamp(50px, calc(100vw * 0.083), 64px);
      }
      .content {
        h1 {
          font-family: Poppins;
          font-size: clamp(18px, calc(100vw * 0.03125), 24px);
        }
        h3 {
          font-family: Poppins;
          font-size: clamp(18px, calc(100vw * 0.03125), 24px);
        }
      }
    }
    .info {
      margin: 25px 0 10px 0;

      h1 {
        color: #3e4145;

        font-family: Poppins;
        text-align: right;
        font-size: clamp(20px, calc(100vw * 0.059), 45px);
        font-style: normal;
        font-weight: 500;
        line-height: normal;
      }
    }
    .sections {
      display: flex;
      justify-content: space-between;
      margin: 0;

            .partition{
                width: 30%;
                border-radius: 8px;
                border: 1px solid var(--second-color);

                a{
                    justify-content: center;
                    margin: 0 auto;
                    padding: 0;

                    h1{
                        font-size: clamp(8px, calc(100vw * 0.03125), 24px);
                        color: var(--second-color);
                    }
                }
            }
            .partition:hover{
                background-color: #fff;

                h1{
                    color: var(--second-color);
                }
            }
            .active a h1{
                color: var(--White);
            }
        }
    }
}

/* ############################################################# */
/* ################# Section-content Start ##################### */
/* ############################################################# */
#section-content {
  width: 65%;
}

/* ============================================================= */
/* =============== Section-content-1 Start ===================== */
#section-content .section-content-1 {
  .section-name {
    color: #5a5a5a;
    font-size: 60px;
    font-weight: 700;

    margin-bottom: 70px;
  }
  form {
    display: flex;
    flex-direction: column;

    gap: 50px;

    input {
      height: clamp(38px, calc(100vw * 0.04), 50px);
      border-radius: 8px;
      border: 1px solid rgba(0, 0, 0, 0.25);

      background: #fff;
    }
    label {
      color: #323232;
      text-align: right;
      font-size: 18px;
      font-weight: 600;

      margin-bottom: 5px;
    }
    .first {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 20px;
      width: 100%;

      height: 100%;

      .name {
        width: 60%;

        .inputs {
          width: 100%;
          height: 100%;

          .ff {
            margin-bottom: 20px;
          }
        }
      }
      .photo-upload {
        :hover .down .image {
          transform: scale(0.97);
        }
        width: 40%;

        input {
          display: none;
        }
        label {
          width: 100%;
          aspect-ratio: 320/300;

          border-radius: 8px;
          background-color: #f9f9f9;

          cursor: pointer;

          .top {
            height: 30%;
            padding: clamp(15px, calc(100vw * 0.025), 30px);

            h1 {
              color: #6e6f71;
              text-align: center;
              font-family: "Noto Sans Arabic";
              font-size: clamp(8px, calc(100vw * 0.0125), 15px);
              font-style: normal;
              font-weight: 600;
            }
            h6 {
              color: var(--second-color);
              text-align: center;
              font-family: Inter;
              font-size: clamp(6px, calc(100vw * 0.01), 12px);
              font-weight: 400;
            }
          }
          .down {
            height: 70%;
            padding: 25px;

            .image {
              display: flex;
              flex-direction: column;
              justify-content: center;
              align-items: center;

              width: 100%;
              height: 100%;

              border-radius: 16px;
              border: 2px dashed var(--second-color);

              svg {
                width: clamp(30px, calc(100vw * 0.04), 55px);
                height: clamp(30px, calc(100vw * 0.04), 55px);
              }
            }
          }
        }
      }
    }
    .submit-form {
      text-align: left;

      .btn {
        width: 240px;
        height: 60px;
        border-radius: 3px;
        background-color: var(--second-color);

        h1 {
          color: var(--White);

          font-size: 20px;
          font-weight: 600;
        }
      }
    }
  }
}
/* ============================================================= */
/* =============== section-content-2 Start ===================== */
#section-content .section-content-2 .section-2-title {
  color: #5a5a5a;
  text-align: center;
  font-size: 60px;
  font-style: normal;
  font-weight: 700;
  text-transform: capitalize;
}

/* ================ content */
#section-content .section-content-2 .content {
  margin-top: 80px;
}

/* ================ mobile nav buttons */
#section-content .section-content-2 .content .scroll-buttons {
  display: none;
}

/* ================ next prev buttoned nav */

#section-content .section-content-2 .page-pagination {
  margin-top: 70px;
}

.cont {
  width: auto;
  height: clamp(45px, calc(100vw * 0.05), 60px);
  border-radius: 8px;
  border: 2px solid black;
}

.page-item,
.page-link,
.page-link-nav {
  display: flex;
  justify-content: center;
  align-items: center;

  border: none !important;

  width: clamp(30px, calc(100vw * 0.042), 50px);
  height: 100%;

  color: var(--main-color);
}

.page-item-nav {
  width: 100%;
  height: 100%;
}

.page-item-nav h6 {
  font-size: 13px;
}

.page-link-nav {
  width: 100%;
  height: 60% !important;
}

.page-link-nav svg {
  width: clamp(10px, calc(100vw * 0.012), 14px);
  height: clamp(10px, calc(100vw * 0.012), 14px);
  font-weight: 700;
}

.page-link {
  padding: 0 !important;
  background-color: transparent !important;
}

.page-item:hover {
  background-color: rgba(0, 0, 0, 0.07);
}

.page-link:hover,
.page-item-nav:hover h6 {
  color: var(--second-color);
  font-weight: 700;
}

.page-link:focus {
  box-shadow: none; /* remove outline */
}

.pagination-active {
  background-color: rgba(0, 0, 0, 0.07);
  border: 2px solid var(--main-color) !important;
  border-top: none !important;
  border-bottom: none !important;
}

.prev {
  width: clamp(75px, calc(100vw * 0.083), 100px);
  margin-left: -1px;
}
.prev .page-link-nav {
  border-left: 0.5px solid var(--main-color) !important;
}

.next {
  width: clamp(75px, calc(100vw * 0.083), 100px);
  margin-right: -1px;
}

.next .page-link-nav {
  border-right: 0.5px solid var(--main-color) !important;
}
/* ============================================================ */
/* ============== section-content-2 Responsive ================ */
@media screen and (width <= 768px) {
  #section-content .section-content-2 .section-2-title {
    color: #fd9802;
    text-align: right;
    font-size: 19px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
  }

  #section-content .section-content-2 .content {
    margin-top: 26px;
  }

  #section-content .section-content-2 .card-container {
    flex-wrap: nowrap !important;
    overflow-x: scroll;
  }

  #section-content .section-content-2 .card-container::-webkit-scrollbar {
    display: none;
  }

  #section-content .section-content-2 .content .scroll-buttons {
    display: flex;
  }

  #section-content .section-content-2 .page-pagination {
    display: none;
  }
}

/* ============================================================= */
/* =============== section-content-3 Start ===================== */
#section-content .section-content-3 .section-3-title {
  color: #5a5a5a;
  text-align: center;
  font-size: 60px;
  font-style: normal;
  font-weight: 700;
  text-transform: capitalize;
}

#section-content .section-content-3 .content {
  margin-top: 100px;
}

#section-content .section-content-3 .content .profile-no-content {
  color: #323232;
  text-align: right;
  font-size: 18px;
  font-style: normal;
  font-weight: 600;
  line-height: normal;
  text-transform: capitalize;
}

/* ============================================================ */
/* ============== section-content-3 Responsive ================ */
@media screen and (width <= 768px) {
  #section-content .section-content-3 .section-3-title {
    color: #fd9802;
    text-align: right;
    font-size: 19px;
    font-style: normal;
    font-weight: 700;
    line-height: normal;
  }

  #section-content .section-content-3 .content {
    margin-top: 20px;
  }
}
/* ############################################################# */
/* ############## section-content Responsive ################### */
@media screen and (width <= 768px) {
  #section-content {
    width: 90%;
  }
  /* ============================================================ */
  /* ============== section-content-1 Responsive ================ */
  #section-content .section-content-1 {
    form {
      position: relative;

      input {
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, 0.06);
      }
      label:not(.photo-upload label) {
        position: absolute;
        transform: translate(-15px, -15px);

        color: rgba(0, 0, 0, 0.43);
        font-family: "Avenir Arabic";
        font-size: clamp(14px, calc(100vw * 0.05), 18px);
        font-weight: 500;

        padding: 0 8px;
        background-color: var(--White);
      }
      .first {
        flex-direction: column-reverse;
        justify-content: center;
        align-items: center;

        .name {
          width: 100%;

          .inputs {
            margin: 0;
            width: 100%;
            gap: 30px !important;

            .col-12 {
              padding: 0;
            }
          }
        }
        .photo-upload {
          margin-bottom: 20px;
          aspect-ratio: 320/300;
          width: clamp(160px, calc(100vw * 0.33), 200px);

          label {
            width: clamp(160px, calc(100vw * 0.33), 200px);

            .top {
              height: 30%;
              padding: clamp(15px, calc(100vw * 0.025), 30px);

              h1 {
                font-size: clamp(10px, calc(100vw * 0.02), 14px);
              }
              h6 {
                font-size: clamp(8px, calc(100vw * 0.016), 10px);
              }
            }
            .down {
              padding: 10px;

              .image svg {
                width: clamp(30px, calc(100vw * 0.058), 55px);
                height: clamp(30px, calc(100vw * 0.058), 55px);
              }
            }
          }
        }
      }
      .third {
        gap: 15px;

        h1 {
          font-weight: 650;
        }
      }
      .submit-form {
        text-align: center;

        .btn {
          width: 60%;
          height: 3rem;

          h1 {
            font-size: clamp(14px, calc(100vw * 0.036), 20px);
          }
        }
      }
    }
  }
}

/* ############################################### */
/* ############### General Style ################# */
/* ############################################### */

/* ================ Line Element ================= */
.line {
  height: 1px;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.25);
}
/* ================ Logout Element =============== */
.logout {
  display: flex;
  flex-direction: row-reverse;

  a {
    text-decoration: none;
    color: #3e4145;

    font-size: clamp(15px, calc(100vw * 0.014), 20px);
    font-weight: 500;
    transition: 0.3s;
  }
  a:hover {
    color: var(--second-color);
  }
}
/* ================ Logout Element =============== */
.mobile-view {
  display: none;
}


</style>

