<x-header :pageName="$page_name"/>
<x-navbar :pageName="$page_name"/>



<section id="all-courses-preview" class="d-flex">
    <section id="side-navbar" class="d-flex flex-column align-items-start">

        {{--
            <div class="block d-flex justify-content-between" style="width: 100%; position: relative;">
                <h1 class="nav-title" href="#">التصنيفات</h1>
                <div class="close-popup" style="position: absolute; left: 0; top:0; transform: translate(-20px, -30px); cursor: pointer; display: none;"  onclick="closePopup()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                    </svg>
                </div>
            </div>
            <div class="line"></div>

            <div id="nav-content" class="nav-content">
                @foreach($categories as $category)
                    <a id="section-id-1">{{ $category->name }}</a>
                @endforeach
                    <a id="section-id-2">الفن و الكتابة</a>
                    <a id="section-id-3">امن المعلومات</a>
                    <a id="section-id-4">تصميمات</a>
                    <a id="section-id-5">هاتف</a>
                    <a id="section-id-6">تسويق</a>
                    <a id="section-id-7">اعلانات</a>
                    <a id="section-id-8">رسوم</a>
                    <a id="section-id-9">نحت</a>
                    <a id="section-id-10">تصوير</a>
                    <a id="section-id-11">تصميم</a>
                    <a id="section-id-12">رسوم متحركة</a>
                    <a id="section-id-13">كتبة</a>
                    <a id="section-id-14">موضة</a>
                    <a id="section-id-15">صفحات ويب</a>
                    <a id="section-id-16">موسيقى</a>
            </div>
        --}}
    </section>

    <section id="courses" class="d-flex flex-column gap-5 align-items-start">

        <div class="header">
            <img src="{{ asset("media/main/img1.png") }}" alt="">
        </div>


        @foreach ($categories as $category)
            @if($category->courses->count() > 0)
                <div class="course-container d-flex gap-5 flex-column">

                    <div class="course">
                        <div class="course-details">

                            <div class="description">
                                <h3 class="title">{{ $category->name }}</h3>
                                <p class="prent">{{ $category->description }}</p>
                            </div>

                        </div>

                        <div class="more d-flex justify-content-end">
                            {{-- <a id="section-id-{{$i}}">
                                <h3 class="title"> اكتشف المزيد
                                    <svg width="15" height="16" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.75 6C0.75 5.75391 0.832031 5.53516 0.996093 5.37109L5.37109 0.996094C5.69922 0.640625 6.27344 0.640625 6.60156 0.996094C6.95703 1.32422 6.95703 1.89844 6.60156 2.22656L2.85547 6L6.60156 9.74609C6.95703 10.0742 6.95703 10.6484 6.60156 10.9766C6.27344 11.332 5.69922 11.332 5.37109 10.9766L0.996093 6.60156C0.832031 6.4375 0.75 6.21875 0.75 6Z" fill="black" />
                                    </svg>
                                </h3>
                            </a> --}}
                        </div>
                        <div class="line"></div>
                    </div>


                    <div id="card-id-{{$category->id}}" class="card-container d-flex gap-5 flex-wrap">
                        <div id="courses-content" class="courses-content d-flex gap-5 flex-wrap">
                            @foreach ($category->courses as $course)
                                <div class="course-preview-card">
                                    @if($course->is_best_sell)
                                        <div class="best-seller">الافضل مبيعا</div>
                                    @endif
                                    <a href="{{ route('courses.show', $course->id) }}" style="color: #000; text"><img src="{{ asset("media/main/autocad.png") }}" alt="card-pic" class="card-pic"></a>
                                    <a href="" class="category">{{ $category->name }}</a>
                                    <div class="title"><a href="{{ route('courses.show', $course->id) }}" style="color: #000; text">{{$course->title}}</a></div>
                                    <div class="author">دورة مقدمة من قبل المهندس: {{$course->instractor}}</div>
                                    <div class="description">
                                        {{$course->small_description}}
                                    </div>
                                    <div class="rating-box">
                                        <span class="number d-flex align-items-center gap-1"><i class="fa-regular fa-user"></i>802</span>
                                        <span class="rating d-flex align-items-center"><i class="bx bx-like bx-flip-horizontal"></i>(2) 100%</span>
                                    </div>
                                    @if($course->discount_status)
                                        @if($course->original_price != null)
                                            <div class="price-box">
                                                @php
                                                    $discount_value = $course->original_price - $course->price;
                                                    $discount_percentage = ($discount_value * 100) / $course->original_price;
                                                @endphp
                                                <span class="price"><span>{{ $course->original_price }}</span><span>SAR</span></span>
                                                <span class="price-discount">{{intval($discount_percentage)}}% خصم .</span>
                                            </div>
                                        @endif
                                    @endif
                                    <a href="/course-content">
                                        <div class="buy-button d-flex justify-content-center align-items-center gap-2">

                                            <div class="price d-flex flex-row-reverse gap-1">
                                                <span>{{ $course->price }}</span><span>SAR</span>
                                            </div>
                                            <span>شراء الآن</span>
                                            <i class="bx bxs-cart"></i>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                                    </div>

                    {{-- <x-scroll-buttons :scrollValue="333" idName="card-id-{{$category->id}}"/> --}}
                </div>
            @endif
        @endforeach

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

<x-footer :pageName="$page_name"/>
