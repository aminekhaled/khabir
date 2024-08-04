<x-header :pageName="$page_name"/>
<x-navbar :pageName="$page_name"/>


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
        <div style="background-image: url(../media/users/{{ $user_data->image ? $user_data->image : 'user-avatar.png' }});" class="image"></div>
            <div class="content">
                <h1 class="desktop-view">مرحبا</h1>
                <h3>محمد طارق احمد</h3>
            </div>
        </div>

        <div class="info mobile-view">
            <h1>معلومات الحساب</h1>
        </div>

        <div class="sections">

            <div class="partition">
                <a href="{{ route('profile.index') }}">
                    <h1>تفاصيل الحساب</h1>
                </a>
            </div>

            <div class="line desktop-view"></div>

            <div class="partition">
                <a href="{{ route('profile.courses') }}">
                    <h1>دوراتي</h1>
                </a>
            </div>

            <div class="line desktop-view"></div>

            <div class="partition active">
                <a href="{{ route('profile.certificates') }}">
                    <h1>شهاداتي</h1>
                </a>
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
                <h5 class="profile-no-content">عذرا لاكنك لم تكمل اي دورة بعد حتى تحصل على الشهادة</h5>
            </div>
        </section>

    </section>
</section>

<x-footer :pageName="$page_name"/>
