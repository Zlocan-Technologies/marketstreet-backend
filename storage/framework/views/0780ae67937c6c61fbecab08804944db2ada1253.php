<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8" />
        <!-- SEO Meta Tags-->
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="" />
        <!-- Viewport-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

        <meta property="fb:app_id" content="" />
        <meta property="0g:url" content="" />
        <meta property="og:type" content="website" />
        <meta property="og:title" content="" />
        <meta property="og:image" content="" />
        <meta property="og:description" content="" />
        <meta property="og:site_name" content="WorkPro" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:image:alt" content="" />

        <meta name="twitter:card" content="summary" />
        <meta name="twitter:site" content="@WorkPro" />
        <meta name="twitter:creator" content="@Softech" />
        <meta name="twitter:url" content="https://www.myworkpro.ng" />
        <meta name="twitter:title" content="" />
        <meta name="twitter:description" content="" />
        <meta name="twitter:image" content="" />
        <meta name="twitter:image:alt" content="" />

        <meta itemprop="name" content="" />
        <meta itemprop="description" content="" />
        <meta itemprop="image" content="" />

        <meta name="theme-color" content="#3734A9" />
        <meta name="apple-mobile-web-app-status-bar-style" content="#3734A9" />

        <title>WorkPro</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Comforter&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@500&display=swap" rel="stylesheet">
    </head>
    <body style="font-family: 'Dancing Script', cursive;">
        <table width="100%" cellspacing="0" cellpadding="0" height="200px">
            <tr>
                <td style="text-align:center;background-color:#CDF2F4;">
                    <img src="<?php echo e(asset('images/Vector1.png')); ?>" style="
                    height:150px;
                    width:150px;"
                    >
                </td>
            </tr>
            <tr>
                <td  style="text-align:center">
                    <img src="<?php echo e(asset('images/Vector.png')); ?>" style="
                        height:134px;
                        width:190.66666666px;padding-top:40px;"
                    >
                    <div style="">
                        <h2 style="">Password Reset Request</h2>
                        <div style="">Please click on the link below or copy it into the address bar of your browser to reset your password:</div>
                        <h3><b><?php echo e($token); ?></b></h3>
                    </div>
                    <div style="margin-top:80px;">
                        <a href="<?php echo e(env('APP_URL')); ?>verify/reset/token/?email=<?php echo e($user->email); ?>&token=<?php echo e($token); ?>" style="
                        background-color:#1D99A2;
                        color:white;
                        padding:12px 50px;
                        text-decoration:none;
                        border-radius:5px;"
                        >Reset Password</a>
                    </div>
                    <div style="
                    padding-top:40px;"
                    >
                        <span style=""
                        >
                            <img src="<?php echo e(asset('images/image1.png')); ?>" style="
                            height:60px;
                            width:60px"
                            >
                        </span>
                        <span style=""
                        >
                            <img src="<?php echo e(asset('images/image2.png')); ?>" style="
                            height:60px;
                            width:60px;
                            margin-left:10px;"
                            >
                        </span>
                    </div>
                </td>
            </tr>
            <tr class="footer">
                <td>
                <section class="footer" style="
                height:40px;
                border:2px solid red;
                width:100%;
                margin-top:30px;"
                >

                </section>
                </td>
            </tr>
        </table>
        
    </body>
</html>
<?php /**PATH /Users/obinnajeze/Documents/GitHub/marketstreet-backend/resources/views/email/password_recovery.blade.php ENDPATH**/ ?>