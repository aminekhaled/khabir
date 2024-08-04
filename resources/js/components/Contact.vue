<template>
    <navbar></navbar>

    <section id="hero">
        <div class="content">
            <h1>لوريم لوريم لوريم</h1>
            <h6>هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى) هو ببساطة نص شكلي (بمعنى أن الغاية هي الشكل وليس المحتوى)</h6>
        </div>
    </section>

    <section id="content">
        <section id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14523.585079593835!2d39.6350141!3d24.4890507!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdbfc683e22611%3A0xfd737b6ddb6663a4!2z2YXYsdmD2LIg2KfZhNiu2KjZitixINin2YTYqtix2KjZiNmK!5e0!3m2!1sar!2seg!4v1714773009397!5m2!1sar!2seg" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <section id="contact-form">
            <div class="text">
                <h1>راسلنا</h1>
                <p>سوف نقوم بالرد عليك في اقرب فرصة</p>
            </div>
            <div class="form">
                <form action="contact-us.php" method="post" class="row g-3">

                    <div class="col-md-6 line">
                        <span class="mobile-input-label">الاسم الكامل*</span>
                        <input type="text" name="name" placeholder="الاسم" required>
                    </div>
                    <div class="col-md-6 line">
                        <span class="mobile-input-label">البريد الالكتروني*</span>
                        <input type="email" name="email "placeholder="الايميل" required>
                    </div>

                    <div class="col-md-6 line">
                        <span class="mobile-input-label">رقم الهاتف*</span>
                        <input type="text" name="phone-no" placeholder="رقم الهاتف">
                    </div>
                    <div class="col-md-6 line">
                        <span class="mobile-input-label">الدولة / مدينة*</span>
                        <input type="text" name="country-city" placeholder="الدولة - مدينة">
                    </div>

                    <div class="col-md-12 line">
                        <span class="mobile-input-label">برجاء كتابة الرسالة*</span>
                        <textarea name="message" rows="7" placeholder="رسالتك" required></textarea>
                    </div>

                    <div class="col-md-12 line form-submit">
                        <button type="submit" class="btn btn-primary">
                            <h1>ارسال</h1>
                        </button>
                    </div>
                </form>
            </div>
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
    }

</script>

<style scoped>

    /*########################################## */
/*######### Contact-us hero start ########## */
/*########################################## */
#hero{
    width: 100%;
    height: clamp(280px, calc(100vw *.4), 600px);
    background: url(../build/assets/contact-hero.png), lightgray 50% / cover no-repeat;
    background-size: cover;
    background-position:bottom;
    background-repeat: no-repeat;

    padding: clamp(40px, calc(100vw * 0.043), 60px);
}
#hero .content h1{
    color: #FFF;

    font-size: clamp(35px, calc(100vw * 0.046), 64px);
    font-weight: 700;
    font-style: normal;
    text-align: right;

    margin-bottom: clamp(25px, calc(100vw * 0.043), 60px);
}
#hero .content h6{
    width: 50%;
    color: #ffffff9d;

    font-size: clamp(16px, calc(100vw * 0.017), 24px);
    font-weight: 400;
    font-style: normal;
    line-height: 28px;
    text-align: right;
}

/*####################################################*/
/*############ Contact-us hero responsive ############*/
@media screen and (width <= 768px){
    #hero{
        transform: scaleX(-1);

        background: linear-gradient(0deg, rgba(0, 0, 0, 0.2) 0%,rgba(0, 0, 0, 0.2) 100%),
        linear-gradient(270deg, rgba(0, 0, 0, 0.5) 5.88%, rgba(0, 0, 0, 0) 89.44%),
        url(../media/contact-us/hero.png);

        background-size: cover;
        background-position:bottom;
        background-repeat: no-repeat;

        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    #hero .content{
        transform: scaleX(-1);
    }
    #hero .content h1{
        font-size: clamp(18px, calc(100vw * 0.036), 28px);
        text-align: center;
    }
    #hero .content h6{
        width: 100%;

        font-size: clamp(12px, calc(100vw * 0.026), 18px);
        text-align: center;

        line-height: 35px;
    }
}


/*########################################## */
/*####### Contact-us Content start ######### */
/*########################################## */
#content{
    height: 800px;

    display: flex;
    flex-direction: row-reverse;
    justify-content: space-between;

    gap: clamp(50px, calc(100vw * 0.0625), 100px);
    padding: clamp(50px, calc(100vw * 0.0625), 100px);
}
#content >*{
    width: 50%;
    height: 100%;
}
#content #contact-form input{
    height: 50px;
}
#contact-form .text{
    margin-bottom: 50px;
}
#contact-form .text h1{
    color: #3E4145;
    font-size: clamp(30px, calc(100vw * 0.034), 48px);

    font-weight: 700;
    font-style: normal;
    text-align: right;
}
#contact-form .text p{
    color: #3E4145;
    font-size: clamp(12px, calc(100vw * 0.017), 20px);

    font-weight: 500;
    font-style: normal;
    text-align: right;
    line-height: normal;
}
#contact-form input, textarea{
    width: 100%;
    border-radius: 6px;
    border: 1px solid rgba(0, 0, 0, 0.25);

    outline: none !important;
    padding-right: 20px;

    transition: 0.3s;
}
textarea{
    padding: 20px;
}
input::placeholder, textarea::placeholder{
    color: rgba(50, 50, 50, 0.25);
}
input:focus, textarea:focus{
    border: 2px solid var(--second-color) !important;
}

#content #contact-form .form button{
    width: clamp(100px, calc(100vw * 0.155), 170px);
    height: clamp(30px, calc(100vw * 0.045), 50px);
    flex-shrink: 0;
    border: none;
    border-radius: 0;
    background-color: var(--second-color);

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
#contact-form .form button h1 {
    color: #FFF;

    font-size: clamp(16px, calc(100vw * 0.021), 22px);
    font-weight: 600;
    font-style: normal;

    margin: 0;
}
#contact-form .form .line{
    position: relative;
}
#contact-form .form .mobile-input-label{
    background-color: var(--White);
    color: #848484;

    font-feature-settings: 'clig' off, 'liga' off;
    font-family: "Avenir Arabic";
    font-size: 14px;
    font-style: normal;
    font-weight: 500;
    line-height: normal;

    position: absolute;
    right: 25px;
    top: -10px;

    display: none;
    padding: 0 10px;
}

/*####################################################*/
/*########## Contact-us Content responsive ###########*/

@media screen and (width <= 1000px){
    #content{
        flex-direction: column;
        height: 1300px;
        padding: 30px clamp(30px, calc(100vw * 0.072), 55px);
    }
    #content >*{
        width: 100%;
        height: 100%;
    }
    input::placeholder, textarea::placeholder{
        color: transparent;
    }
    #contact-form input, textarea{
        border-radius: 14px;
        border: 1px solid rgba(0, 0, 0, 0.10);
        padding-right: 27px;
    }
    #contact-form .form .line{
        position: relative;
        margin-bottom: 20px;
    }
    #contact-form .form .mobile-input-label{
        display: block;
    }
    #contact-form .form .form-submit{
        display: flex;
        justify-content: center;
    }
}

</style>





