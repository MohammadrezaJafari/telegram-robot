<style>
    .mfPlaceHolder {
        font: inherit;
        cursor: text;
        position: absolute;
        right: 0;
        top: 0;
        padding: 19px 23px;
        line-height: 18px;
        color: #484b4c;
        opacity: 1;
        -moz-transition: 0.3s all ease;
        -o-transition: 0.3s all ease;
        -webkit-transition: 0.3s all ease;
        transition: 0.3s all ease;
    }
</style>
<section class="well">
    <div class="container" style="direction: rtl">
        <h2>ثبت سفارش</h2>

        <form method="post" action="{{URL::to('order')}}" class="mailforms off2 rd-mailforms">
           {{csrf_field()}}
            <fieldset class="row">
                <label class="grid_4 mfInput">
                    <input type="text" name="name" data-constraints="@LettersOnly @NotEmpty" placeholder="نام و نام خانوادگی">
                </label>
                <label class="grid_4 mfInput">
                    <input type="text" name="email" data-constraints="@Email @NotEmpty" placeholder="ایمیل">
                </label>
                <label class="grid_4 mfInput">
                    <input type="text" name="phone" data-constraints="@Phone" placeholder="تلفن">
                </label>
                <label class="grid_12 mfInput">
                    <textarea name="description" data-constraints="@NotEmpty" placeholder="آدرس و مشخصات ملک"></textarea>
                </label>
                <div class="mfControls grid_12">
                    <button type="submit" class="btn mfProgress">
                        ارسال
                    </button>
                </div>
            </fieldset>
        </form>
    </div>
</section>