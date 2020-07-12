<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $title ?></title>
        <link href="<?php echo base_url('assets/font-awesome-4.7.0/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" type="text/css">
         <link rel="shortcut icon" href="<?php echo base_url('assets/images/logoGh.png') ?>">
        <style type="text/css">
                body, html {
                    background-color: #1A9B6F !important;
                    transition: all 0.6s cubic-bezier(0.945, 0.020, 0.270, 0.665);
                    transform-origin: bottom left;
                }

                .card-container.card {
                    max-width: 350px;
                    padding: 40px 40px;
                }

                .btn {
                    font-weight: 700;
                    height: 36px;
                    -moz-user-select: none;
                    -webkit-user-select: none;
                    user-select: none;
                    cursor: default;
                    margin-top: 15px;
                }

                .card {
                    background-color: #F7F7F7;
                    /*opacity:0.9;filter:alpha(opacity=90);*/                    
                    padding: 20px 25px 30px;
                    margin: 0 auto 25px;
                    margin-top: 50px;
                    -moz-border-radius: 2px;
                    -webkit-border-radius: 2px;
                    border-radius: 50px 10px 50px 10px;
                    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
                }

                .profile-img-card {
                    width: 130px;
                    height: 130px;
                    margin: 0 auto 10px;
                    display: block;
                }

                .profile-name-card {
                    font-size: 16px;
                    font-weight: bold;
                    text-align: center;
                    margin: 10px 0 0;
                    min-height: 1em;
                    color: #4EBC5E;
                }

                .btn.btn-signin {
                    background-color: #4E9D4A;
                    padding: 0px;
                    font-weight: 700;
                    font-size: 14px;
                    height: 36px;
                    -moz-border-radius: 3px;
                    -webkit-border-radius: 3px;
                    border-radius: 3px;
                    border: none;
                    -o-transition: all 0.218s;
                    -moz-transition: all 0.218s;
                    -webkit-transition: all 0.218s;
                    transition: all 0.218s;
                }

                .btn.btn-signin:hover,
                .btn.btn-signin:active,
                .btn.btn-signin:focus {
                    background-color: #136508
                }

                #response{display: none;
                         text-align:center;}

                .input {
                    margin-top: 20px;
                }
</style>
</head>
    <body>     
    <div class="container">
        <div class="card card-container">
            <img id="profile-img" class="profile-img-card" src="<?php echo base_url('assets/images/logoGh.png') ?>" />
            <h3 id="profile-name" class="profile-name-card">LOGIN Admin </h3><br>
            <form action="#" id="form" class="signin" autocomplete="on"> 
                <div class="alert alert-danger" role="alert" style="margin-top:10px;" id="response"><b>Email atau Password salah</b></div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email"  name="email" placeholder="Email" autofocus>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password"  placeholder="Password">
                </div>
            </form>
            <button type="button" id="btnSimpan" onclick="login()" class="btn btn-lg btn-primary btn-block btn-signin">LOGIN</button>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo base_url('assets/classie.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery-slim.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery-2.1.4.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/popper.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/jquery-ui.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function (){
            $( "div" ).each(function( index ) {
            var cl = $(this).attr('class');
            if(cl =='')
                {
                    $(this).hide();
                }
            });
        });

        function login()
        {
            $('#Login').text('Login...'); 
            $('#Login').attr('disabled',true); 
            var url = "<?php echo site_url('auth/login')?>";
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status) 
                    {
                        window.location.href="<?php echo base_url('petugas') ?>";
                    }
                    else
                    {
                        $("#response").show('fast');
                        $("#response").effect( "shake" );
                    }
                    $('#btnLogin').text('Login'); 
                    $('#btnLogin').attr('disabled',false);  
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    $("#response").show('fast');
                    $("#response").effect( "shake" );
                    $('#btnLogin').text('Login'); 
                    $('#btnLogin').attr('disabled',false); 
                }
            });
        }
    </script>
    </body>
</html>