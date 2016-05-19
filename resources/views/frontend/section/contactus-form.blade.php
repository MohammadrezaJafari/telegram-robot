<section class="well">
    <div class="container">
        <h2>ارتباط با ما</h2>
        @if(Session::has('message'))
            <div class="alert alert-info alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('message') }}
                <br>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
        <form method="post" action="{{URL::to('contactus')}}" class="mailform off2 rd-mailform">
            <input type="hidden" name="form-type" value="contact">
            <fieldset class="row">
                <label class="grid_4 mfInput">
                    <input type="text" name="name" data-constraints="">
                    <span class="mfValidation"></span><span class="mfIcon"><span></span></span><span class="mfPlaceHolder">Name</span></label>
                <label class="grid_4 mfInput">
                    <input type="text" name="email" data-constraints="">
                    <span class="mfValidation"></span><span class="mfIcon"><span></span></span><span class="mfPlaceHolder">Email</span></label>
                <label class="grid_4 mfInput">
                    <input type="text" name="phone" data-constraints="">
                    <span class="mfValidation"></span><span class="mfIcon"><span></span></span><span class="mfPlaceHolder">Phone:</span></label>
                <label class="grid_12 mfInput">
                    <textarea name="description" data-constraints=""></textarea>
                    <span class="mfValidation"></span><span class="mfIcon"><span></span></span><span class="mfPlaceHolder">Message</span></label>
                <div class="mfControls grid_12">
                    <button type="submit" class="btn mfProgress"><span class="cnt">Send</span><span class="loader"></span><span class="msg"></span></button>
                </div>
            </fieldset>
        </form>
    </div>
</section>