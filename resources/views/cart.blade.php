<x-header :pageName="$page_name"/>
<x-navbar :pageName="$page_name"/>


<section id="cart">
    <header>
        <h1>السلة</h1>
    </header>

    <section id="cart-content">
        @foreach($cart_courses->courses as $course)
            <div class="cart-element">

                <div class="course-image"></div>

                <div class="course-details">
                    <!-- <div class="description"> -->
                        <h5>{{ $course->category->name }}</h5>
                        <h1>{{ $course->title }}</h1>
                        <h4>دورة مقدما من قبل المهندس: {{ $course->instractor }}</h4>
                        <p>{{ $course->small_description }}</p>
                    <!-- </div> -->
                    <div class="price">
                        <h1>السعر :</h1>
                        <div class="before-after">
                            @if($course->original_price)
                                <p class="before">ر.س {{ $course->original_price }}</p>
                            @endif
                            <p class="after">ر.س {{ $course->price }}</p>
                        </div>
                    </div>
                </div>

                <div>
                    <form class="remove-to-cart" >
                        @csrf
                        <input type="hidden" name="course_id" value="{{ $course->id }}">
                        <button type="button" class="btn btn-primary remove-to-cart-btn" >حذف من السلة</button>
                    </form>
                </div>

            </div>
        @endforeach
    </section>

    @if($cart_courses->courses->count() > 0)
        <div id="cart-price-box" >
            <section id="cart-price">
                <div class="breaf">
                    <h1>لديك قسيمة شراء؟ أنقر هنا لإدخال رمز القسيمة</h1>
                    <div class="buttons">
                        <a class="update" href="{{ route('courses.index') }}">
                            <p>متابعة التسوق</p>
                        </a>
                    </div>
                </div>
                <div class="prices">
                    <div class="price-line">
                        <h1>إجمالي سلة الشراء</h1>
                        <p>ر.س <span class="total-price" >{{ $total_price }}</span></p>
                    </div>

                    <div class="line"></div>

                    <div class="price-line">
                        <h1>الإجمالي</h1>
                        <p>ر.س <span class="total-price" >{{ $total_price }}</span></p>
                    </div>

                    <div class="line"></div>

                    <div class="price-line">
                        <h1>المبلغ قبل رسوم الشحن</h1>
                        <p>ر.س <span class="total-price" >{{ $total_price }}</span></p>
                    </div>
                </div>

            </section>

            <form method="POST" id="checkout-form" action="{{ route('checkout') }}" class="submit">
                @csrf
                @php
                    $purchased_courses = $cart_courses->courses->pluck('id');
                @endphp
                <input type="hidden" name="purchased_courses" value="{{ $purchased_courses }}">
                <a role="button" onclick="event.preventDefault(); document.getElementById('checkout-form').submit();">
                    <p>المتابعة الي الدفع</p>
                </a>
            </form>
        </div>
    @else
        <h2 class="text-center" >ليس لديك أي كورسات في السلة ليتم عرضها</h2>
    @endif
</section>

<x-footer :pageName="$page_name"/>

<!-- في الجافاسكريبت -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        $('.remove-to-cart-btn').click(function(e) {

            var data = $(this).parent().serialize()
            $(this).closest('.cart-element').addClass('d-none');

            $.ajax({
                type: 'POST',
                url: '{{ route("cart.remove-to-cart") }}',
                data: data,
                success: function(response) {
                    $('.total-price').html(response.total_price);

                    $('#card-counter').html(response.courses_number);

                    if(response.courses_number == 0) {
                        $('#cart-price-box').addClass('d-none');
                        $('#cart').append('<h2 class="text-center" >ليس لديك أي كورسات في السلة ليتم عرضها</h2>');
                    }

                    Swal.fire({
                        iconHtml: '<i style="color: #fd9802" class="fas fa-shopping-cart fa-2x mb-3"></i>', // Use cart icon at the top
                        title: 'تمت الحذف من السلة بنجاح',
                        showConfirmButton: false,
                        timer: 1500
                    });

                },
                error: function(response) {
                    // alert('حدث خطأ أثناء إضافة المنتج إلى العربة!');
                }
            });
        });
    });
</script>




