<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Ajax Validation Example</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

</head>
<body>

<div class="container">
    <h2>Laravel  Ajax Validation </h2>

    <div class="alert alert-danger print-error-msg" style="display:none">
        <ul></ul>
    </div>

    <form action="{{ route('my.form') }}" method="post" id="main_form">
        @csrf

        <div class="form-group">
            <label>First Name:</label>
            <input type="text" name="first_name" class="form-control" placeholder="First Name">
            <span class="text-danger error-text name_error"></span>

        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" name="last_name" class="form-control" placeholder="Last Name">
            <span class="text-danger error-text last_error"></span>
        </div>

        <div class="form-group">
            <strong>Email:</strong>
            <input type="text" name="email" class="form-control" placeholder="Email">
            <span class="text-danger error-text email_error"></span>
        </div>

        <div class="form-group">
            <strong>Address:</strong>
            <textarea class="form-control" name="address" placeholder="Address"></textarea>
            <span class="text-danger error-text address_error"></span>
        </div>

        <div class="form-group">
            <button class="btn btn-success btn-submit">Submit</button>
        </div>
    </form>
</div>

<script type="text/javascript">

    {{--$(document).ready(function() {--}}
    {{--    $(".btn-submit").click(function(e){--}}
    {{--        e.preventDefault();--}}

    {{--        var _token = $("input[name='_token']").val();--}}
    {{--        var first_name = $("input[name='first_name']").val();--}}
    {{--        var last_name = $("input[name='last_name']").val();--}}
    {{--        var email = $("input[name='email']").val();--}}
    {{--        var address = $("textarea[name='address']").val();--}}

    {{--        $.ajax({--}}
    {{--            url: "{{ route('my.form') }}",--}}
    {{--            type:'POST',--}}
    {{--            data: {_token:_token, first_name:first_name, last_name:last_name, email:email, address:address},--}}
    {{--            success: function(data) {--}}
    {{--                if($.isEmptyObject(data.error)){--}}
    {{--                    alert(data.success);--}}
    {{--                }else{--}}
    {{--                    printErrorMsg(data.error);--}}
    {{--                }--}}
    {{--            }--}}
    {{--        });--}}

    {{--    });--}}

    {{--    function printErrorMsg (msg) {--}}
    {{--        $(".print-error-msg").find("ul").html('');--}}
    {{--        $(".print-error-msg").css('display','block');--}}
    {{--        $.each( msg, function( key, value ) {--}}
    {{--            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');--}}
    {{--        });--}}
    {{--    }--}}
    {{--});--}}
    // $(function(){
    //     $("#main_form").on('submit', function(e){
    //         e.preventDefault();
    //         console.log(new FormData(this))
    //
    //                 $.ajax({
    //                     url: $(this).attr("action"),
    //                     method: $(this).attr("method"),
    //                     data: new FormData(this),
    //                     processData: false,
    //                     dataType:'json',
    //                     contentType:false,
    //
    //                   beforeSend: function() {
    //                    $(document).find("span.error-text").text("please fill up all field ");
    //                   },
    //                     success: function(data) {
    //                         if(data.status === 0){
    //                            $.each(data.error, function(prefix, val){
    //                                $('span.'+prefix+'_error').text(val[0]);
    //                            })
    //                         }else{
    //
    //                             $('#main_form')[0].reset();
    //                             alert('data.msg');
    //
    //                         }
    //                     }
    //                 });
    //
    //     })
    // });

    $(document).ready(function(){
        $("#contactForm").submit(function(e) {
            e.preventDefault();

            $("#formResult").html("");

            var formData = $(this).serialize();

            $.ajax({
                url : 'my.form',
                type : 'POST',
                dataType : 'json',
                data : formData,
                cache : false,
                beforeSend : function () {
                    $("#main_form").text('Validation...');
                    $("#main_form").prop('disabled', true);
                },
                success : function ( result ) {
                    $("#main_form").text('Send Message');
                    $("#main_form").prop('disabled', false);

                    /* for(x in result['error']){
                        alert('key: ' + x + '\n' + 'value: ' + result['error'][x]);
                    } */

                    if( result['success'] === true ) {
                        //$('#contactForm')[0].reset();
                        $("#formResult").html('<div class="alert alert-danger">'+result['msg'][0]+'</div>');
                        //$("#formResult").html('<div class="alert alert-danger">Your message has been sent. I will contact with you asap.</div>');

                        var i = 5;
                        setInterval(function () {
                            i--;
                            $("#counter").html("you'll be redirect in " +i+ " seconds");
                        }, 1000);

                        setTimeout(function () {
                            window.location.href = 'mysite.com/portfolio/contact.php';
                        }, i*1000);

                    }else{

                        for(x in result['msg']){
                            //alert('key: ' + x + '\n' + 'value: ' + result['msg'][x]);
                            $("#formResult").append('<div class="alert alert-danger">'+result['msg'][x]+'</div>'+"\n");
                        }
                    }

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" +thrownError);
                }
            });
        });
    });


</script>


</body>
</html>
