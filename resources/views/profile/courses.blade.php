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

            <div class="partition active">
                <a href="{{ route('profile.courses') }}">
                    <h1>دوراتي</h1>
                </a>
            </div>

            <div class="line desktop-view"></div>

            <div class="partition">
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

        <!-- =============================
        ============ section 1 ============
        ================================== -->

            <!-- =============================
            ============ section 2 ============
            ================================== -->

            <section class="section-content-2">
                <h1 class="section-2-title">دورات</h1>
                <div class="content">
                    <div id="profile-courses" class="card-container d-flex justify-content-center gap-5 flex-wrap">

                        @foreach ($user_data->onrolled_courses as $onrolled_course)

                            <!-- !! this should be turned into a dynamic card once we begin backend !! -->
                            <div class="course-preview-card" style="width:285px;height:auto;">
                                <a href="{{ route('courses.show', $onrolled_course->course->id) }}"><img src='{{ asset("media/main") }}/{{ $onrolled_course->course->img}}' alt="card-pic" class="card-pic"></a>
                                <div class="category">{{ $onrolled_course->course->category->name }}</div>
                                <a href="{{ route('courses.show', $onrolled_course->course->id) }}"><div class="title">{{ $onrolled_course->course->title }}</div></a>
                                <div class="author">دورة مقدمة من قبل المهندس: {{ $onrolled_course->course->instractor }}</div>
                                <div class="description">
                                    {{ $onrolled_course->course->small_description }}
                                </div>
                            </div>

                        @endforeach
                    </div>
{{--
                    <nav class="page-pagination">
                        <ul class="pagination justify-content-center">
                            <div class="cont d-flex justify-content-center align-items-center">

                                <li class="page-item-nav prev d-flex flex-column justify-content-center">
                                    <a class="page-link-nav d-flex justify-content-evenly gap-1" href="#">
                                        <svg style="transform: rotate(180deg);" width="15" height="16" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 6C0.75 5.75391 0.832031 5.53516 0.996093 5.37109L5.37109 0.996094C5.69922 0.640625 6.27344 0.640625 6.60156 0.996094C6.95703 1.32422 6.95703 1.89844 6.60156 2.22656L2.85547 6L6.60156 9.74609C6.95703 10.0742 6.95703 10.6484 6.60156 10.9766C6.27344 11.332 5.69922 11.332 5.37109 10.9766L0.996093 6.60156C0.832031 6.4375 0.75 6.21875 0.75 6Z" fill="black"></path>
                                        </svg>
                                        <h6 style="margin: 0;">التالي</h6>
                                    </a>
                                </li>

                                <li class="page-item">
                                    <a class="page-link" href="#">50</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">...</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">3</a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="#">2</a>
                                </li>
                                <li class="page-item pagination-active">
                                    <a class="page-link" href="#">1</a>
                                </li>

                                <li class="page-item-nav next d-flex flex-column justify-content-center">
                                    <a class="page-link-nav d-flex justify-content-evenly gap-1" href="#">
                                        <h6 style="margin: 0;">السابق</h6>
                                        <svg width="15" height="16" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.75 6C0.75 5.75391 0.832031 5.53516 0.996093 5.37109L5.37109 0.996094C5.69922 0.640625 6.27344 0.640625 6.60156 0.996094C6.95703 1.32422 6.95703 1.89844 6.60156 2.22656L2.85547 6L6.60156 9.74609C6.95703 10.0742 6.95703 10.6484 6.60156 10.9766C6.27344 11.332 5.69922 11.332 5.37109 10.9766L0.996093 6.60156C0.832031 6.4375 0.75 6.21875 0.75 6Z" fill="black"></path>
                                        </svg>
                                    </a>
                                </li>
                            </div>
                        </ul>
                    </nav>
--}}
                </div>

            </section>
            <!-- =============================
            ============ section 3 ============
            ================================== -->

    </section>
</section>

<x-footer :pageName="$page_name"/>
