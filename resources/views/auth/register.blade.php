@extends('layouts.app')

@section('content')
<div class="container-fluid" >
    <div class="row justify-content-center">



<?php $page_name = 'profile' ?>
<x-header :pageName="$page_name"/>


<section id="profile" style="display: flex; justify-content:center">

    <!-- ##################################################################################### -->
    <!-- ############################ Fixed-Content Start #################################### -->
    <!-- ##################################################################################### -->



    <!-- ===== Fixed-Section END ============================================================= -->
    <!-- ===================================================================================== -->


    <!-- ##################################################################################### -->
    <!-- ########################### Section-Content Start ################################### -->
    <!-- ##################################################################################### -->
    <section id="section-content">

        <!-- =============================
        ============ section 1 ============
        ================================== -->
        {{-- @if ($page_id == 1) --}}
        @if (1==1)


            <section class="section-content-1">
                <h1 class="section-name text-center desktop-view">تسجيل حساب</h1>
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="first">
                        <div class="name">
                            <div class="inputs row gy-lg-4 gap-3">

                                <div class="col-12">
                                    <label for="name" class="form-label">الاسم</label>
                                    {{-- <input type="text" name="name" id="name" class="form-control"> --}}
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>


                            </div>
                        </div>
                        <div class="photo-upload">
                            <input type="file" name="image" accept="image/*" id=photo>
                            <label for="photo">
                                <div class="top">
                                    <h1>لإضافة صورة شخصية للحساب </h1>
                                    <h6>Max Size: 50mb</h6>
                                </div>
                                <div class="down">
                                    <div class="image">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="53" height="53" viewBox="0 0 53 53" fill="none">
                                            <path d="M23.1875 39.75V12.7531L14.575 21.3656L9.9375 16.5625L26.5 0L43.0625 16.5625L38.425 21.3656L29.8125 12.7531V39.75H23.1875ZM6.625 53C4.80313 53 3.24294 52.3507 1.94444 51.0522C0.645943 49.7537 -0.00220271 48.1947 5.62394e-06 46.375V36.4375H6.625V46.375H46.375V36.4375H53V46.375C53 48.1969 52.3507 49.7571 51.0522 51.0556C49.7537 52.3541 48.1947 53.0022 46.375 53H6.625Z" fill="#BDBDBD" />
                                        </svg>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="second">
                        <div class="row gx-5 gy-4">
                            <div class="col-lg-6">
                                <label for="phone" class="form-label">رقم الهاتف</label>
                                <input type="text" name="phone_number" id="phone" class="form-control">
                            </div>
{{--

                            <div class="col-lg-6">
                                <label for="phone" class="form-label">الدولة</label>
                                <select  name="country" class="form-control country" aria-label="Default select example">
                                    <option selected>أختر الدولة</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
--}}




                            <div class="col">
                                <label for="email" class="form-label">الإيميل</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>


                        </div>
                    </div>


                    <div class="third row gy-4">
                        <h1>كلمة المرور</h1>
                        <div class="col-12">
                            <label for="new-pass" class="form-label"> كلمة المرور </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <div class="col-12">
                            <label for="new-pass-confirm" class="form-label"> تاكيد كلمة المرور</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="col-md-12 submit-form">
                            {{-- <h1></h1> --}}
                            <button type="submit" class="btn btn-primary">
                                <h1>حفظ التغيرات</h1>
                            </button>

                    </div>
                </form>
            </section>

            <!-- =============================
            ============ section 2 ============
            ================================== -->

@endif

    </section>
</section>

<x-footer :pageName="$page_name"/>
                {{-- _______________________________________ --}}


{{-- الاسم --}}




                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
