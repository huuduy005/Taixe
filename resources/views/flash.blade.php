@if(session()->has('flash_message'))
    <script>
        swal({
            title: "{!!  session('flash_message.title') !!}",
            text: "{!! session('flash_message.message') !!}",
            type: "{{ session('flash_message.level') }}",
            timer: 2000,
            showConfirmButton: false
        });
    </script>
@endif

@if(session()->has('flash_message_overlay'))
    <script>
        swal({
            title: "{!!  session('flash_message_overlay.title') !!}",
            text: "{!! session('flash_message_overlay.message') !!}",
            type: "{{ session('flash_message_overlay.level') }}",
            confirmButtonText: 'OK'
        });
    </script>
@endif

@if(Session::has('flash_message1.message'))
        <div class="alert alert-success {{ Session::pull('flash_message1.flash_message_important')? 'alert-important' : '' }}"
             style="font-size: 14px">{!! Session::pull('flash_message1.message') !!}
            <button type='button' class='close' data-dismiss='alert'>×</button>
        </div>
@endif

@if(Session::has(\App\Http\Controllers\Shared\Constants::$flash_error.'.message'))
    <div class="alert alert-error {{ Session::pull(\App\Http\Controllers\Shared\Constants::$flash_error.'.flash_message_important')? 'alert-important' : '' }}"
         style="font-size: 14px">{!! Session::pull(\App\Http\Controllers\Shared\Constants::$flash_error.'.message') !!}
        <button type='button' class='close' data-dismiss='alert'>×</button>
    </div>
@endif