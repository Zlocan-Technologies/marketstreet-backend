<html>
   <head>
      <title>Workpro Password Reset</title>
      <link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('css/base.css')}}" type="text/css" media="all" />
      <script type = "text/javascript" src = "{{asset('vue.js')}}"></script>
      <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
   </head>
   <style>
       .error{
           color:red;
       }
   </style>
   <body>
        <section class="m-t-80 m-b-30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-xl-5 col-md-6 col-sm-7" style="padding:20px;">
                        <h3 class="text-center" style="font-weight:bolder;">Reset Password</h3>
                        <form method="post" id="password_reset">
                            <input type="hidden" name="_token" id="token" value="{{csrf_token()}}">
                            <input type="hidden" name="email" id="email" value="{{$email}}">
                            
                            <div class="d-flex flex-column m-t-15">
                                <div class="d-flex" style="border:1px solid #e9ecef;">
                                    <input type="password" placeholder="New Password" name="password" id="password" class="form-control">
                                    <span class="d-flex align-items-center justify-content-center p-r-10 p-l-10" onclick="togglePassword()"><i class="lni lni-eye"></i></span>
                                </div>
                                <span class="error"></span>
                            </div>
                            <div class="d-flex flex-column m-t-15">
                                <div class="d-flex" style="border:1px solid #e9ecef;">
                                    <input type="password" placeholder="Confirm New Password" name="confirmpassword" id="confirmpassword" class="form-control">
                                </div>
                                <span class="error"></span>
                            </div>
            
                            <div class="d-flex justify-content-end m-t-20">
                                <button type="submit" name="submit" class="btn btn-primary rounded-all w-full">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>  
            </div>
            <div id="eject" class="container"></div>
        </section>
        <script type = "text/javascript">
            document.getElementById('password_reset').addEventListener("submit", (event) => {
                event.preventDefault();
                let formData = {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    password_confirmation: document.getElementById('confirmpassword').value,
                    _token: document.getElementById('token').value
                };
                const url = 'http://127.0.0.1:8000/api/v1/auth/password-reset/';
                const config = {
                    headers: {
                        Accept: 'application/json',
                        responseType: 'json'
                    }
                };
                axios.post(url,
                    formData,
                    config,
                )
                .then(function(response){
                    data = JSON.stringify(response.data);
                    document.getElementById('eject').innerHTML = data;
                })
                .catch(function(error){
                    error = error.response.data;
                    document.getElementById('eject').innerHTML = JSON.stringify(error);
                    if(error.error.password){
                        document.getElementsByClassName('error')[0].innerHTML = error.error.password[0];
                    }
                    if(error.error.password_confirmation){
                        document.getElementsByClassName('error')[1].innerHTML = error.error.password_confirmation[0];
                    }
                });
            });
        </script>
        <script>
            function togglePassword() {
                var toggle = document.getElementById("password");
                switch (true) {
                    case toggle.type === "password":
                        toggle.type = "text";
                        break;
                    default:
                        toggle.type = "password";
                }
            }
        </script>
   </body>
</html>