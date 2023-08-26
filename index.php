<html lang="en">
<head>
	<title>Guvi Project</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	 <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
	 <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.24/sweetalert2.all.js"></script>
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/1.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" id="login">
					<span class="login100-form-title">
						User Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>
					
					<div class="text-center p-t-136">
						<button type="button"  class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adduser">
                       Create an account 
                   </button>
				   </div>
                   <div class="footer-copyright text-center py-3">© 2023 Copyright saktheeswari
  <!-- <a href="/">© 2023 Copyright saktheeswari</a> -->
</div>
<!-- Copyright -->

</footer>

		</form>
					 

			</div>
		
						  
	</div>
	</div>
	


<div class="modal fade" id="adduser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
   <div class="modal-content">
   <div class="modal-header">
       <h5 class="modal-title" id="exampleModalLabel">New User Registration</h5>
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
   </div>
   <form id="saveuser">
       <div class="modal-body">

           <div id="errorMessagei" class="alert alert-warning d-none"></div>
                           
           <div class="mb-3">
               <label for="">Name *</label>
               <input type="text" name="name" class="form-control" required />
           </div>
		   <div class="mb-3">
               <label for="">Email *</label>
               <input type="text" name="mail" class="form-control" required />
           </div>
           <div class="mb-3">
               <label for="">Password *</label>
               <input type="password" name="pass" class="form-control" required />
           </div>
           <div class="mb-3">
               <label for="">Confirm Password *</label>
               <input type="password" name="cpass" class="form-control" required />
           </div>
       </div>
       <div class="modal-footer">
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-primary">Register</button>
       </div>
   </form>
   </div>
</div>
</div>


<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
	      <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
	
	
	
<script>
//Register

$(document).on('submit', '#saveuser', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_user", true);
			console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422) {
                        $('#errorMessagei').removeClass('d-none');
                        $('#errorMessagei').text(res.message);

                    }else if(res.status == 200){

                        $('#errorMessagei').addClass('d-none');
                        $('#adduser').modal('hide');
                        $('#saveuser')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
						

                    }else if(res.status == 500) {
						$('#errorMessagei').addClass('d-none');
                        $('#adduser').modal('hide');
                        $('#saveuser')[0].reset();
                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
                    }
                }
            });

        });


//Login

$(document).on('submit', '#login', function (e) {
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_login", true);
			console.log(formData);

            $.ajax({
                type: "POST",
                url: "scode.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    
                    var res = jQuery.parseJSON(response);


					if(res.status == 200){
					swal.fire({
					icon: 'success',
					title: 'Success',
					text: 'Login Successful'
						}).then(function() {
					window.location = "test.php";
					});
						

                    }
					
					else if(res.status == 500) {

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);
						window.location.href='index.php';
                    }
                }
            });

        });

</script>

</body>
</html>