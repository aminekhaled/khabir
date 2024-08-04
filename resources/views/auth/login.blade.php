@extends('layouts.app')


@section('content')
<div class="container">
    <section class="section-content-1">
        <h1 class="section-name text-center desktop-view">حسابي</h1>
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="row mb-3">
                <label for="email" class="form-label">الإيميل</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="password" class="form-label">كلمة المرور</label>

                <div class="col-md-6">
                    {{-- <label for="new-pass" class="form-label">  </label> --}}
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>





            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-label">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            تذكرني
                        </label>
                    </div>
                </div>
            </div>


            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        تسجيل الدخول
                    </button>

                    @if (Route::has('password.request'))
                        <a class="btn btn-danger" href="{{ route('password.request') }}">
                            نسيت كلمة السر؟
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
