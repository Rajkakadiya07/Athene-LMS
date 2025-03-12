<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Bootstrap Icons CSS -->
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.3.js"></script>

    <title>Account registration</title>

    <style>
        body {
            background-color: #f3f3f3;
        }

        .card-img-top {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .nav-link:hover {
            color: black;
            border: 0px solid white;
        }

        .nav-link:focus {
            color: #000;
            border: 0px solid white;
        }

        .nav-link {
            color: black;
        }

        #formBody1 {
            min-height: 90vh;
        }

        .input-group-text {
            background-color: whitesmoke;
            font-size: 130%;
        }

        .form-control:focus {
            color: #000000;
            background-color: #f6f6f6;
            border-color: #000;
            outline: 1px solid black;
            box-shadow: 0 0 0 0.0rem rgba(0, 0, 0, 0);
        }

        .form-select:focus {
            border-color: #000;
            outline: 1px solid black;
            box-shadow: 0 0 0 0.0rem rgba(0, 0, 0, 0);
        }

        #nav-tabContent {
            min-height: 50vh;
        }

        .invalid {
            color: red;
            font-size: 80%;
            padding-left: 1%;
            display: none;
        }

        /* Thank you modal css */
        .thank-you-pop {
            width: 100%;
            padding: 20px;
            text-align: center;
        }

        .thank-you-pop img {
            width: 76px;
            height: auto;
            margin: 0 auto;
            display: block;
            margin-bottom: 25px;
        }

        .thank-you-pop h1 {
            font-size: 42px;
            margin-bottom: 25px;
            color: #5C5C5C;
        }

        .thank-you-pop p {
            font-size: 20px;
            margin-bottom: 27px;
            color: #5C5C5C;
        }

        .thank-you-pop h3.cupon-pop {
            font-size: 25px;
            margin-bottom: 40px;
            color: #222;
            display: inline-block;
            text-align: center;
            padding: 10px 20px;
            border: 2px dashed #222;
            clear: both;
            font-weight: normal;
        }

        .thank-you-pop h3.cupon-pop span {
            color: #03A9F4;
        }

        .thank-you-pop a i {
            margin-right: 5px;
            color: #fff;
        }
    </style>
</head>

<body>

    <section class="vh-100">
        <div class="container py-5 h-100 box">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div id="formBody1" class="col col-xl-10 h-100">
                    <div class="card h-100" style="border-radius: 1rem;">
                        <div class="h-100 row g-0">
                            <div class="col-md-6 col-lg-5 h-100 d-none d-md-block">
                                <img src="../assets/img/16.jpg" alt="login form" class="card-img-top" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center h-100 ">
                                <div class="card-body p-4 p-lg-5 text-black">



                                    <!-- Registration form start -->
                                    <form name="regform" action="registration_entry.php" method="post">
                                        <div class="d-flex align-items-center mb-1">
                                            <span class="h1 fw-bold">Athene LMS</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register account</h5>


                                        <!-- tab navigation start -->
                                        <nav>
                                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="perosnaldetailstab" data-bs-target="#personaldetails" type="button" role="tab" aria-controls="nav-personal-details" aria-selected="true">Personal Details</button>
                                                <button class="nav-link" id="userdetailstab" data-bs-target="#userdetails" type="button" role="tab" aria-controls="nav-user-details" aria-selected="false">User & Category</button>
                                                <button class="nav-link" id="passworddetailstab" data-bs-target="#contactdetails" type="button" role="tab" aria-controls="nav-password" aria-selected="false">Password</button>
                                            </div>
                                        </nav>


                                        <div class="container-fluid">
                                            <div class="tab-content" id="nav-tabContent">
                                                <div class="tab-pane fade show active" id="personaldetails" role="tabpanel" aria-labelledby="nav-personal-details">
                                                    <div class="form-outline mt-4 mb-2">
                                                        <label class="form-label" for="fullname">Full Name</label>
                                                        <input type="text" name="fullname" id="fullname" class="form-control form-control-lg" autofocus="on" />
                                                        <span id="nameInvalid" class="invalid">Name should start with a capital letter and does not contain any digits</span>
                                                    </div>
                                                    <div class="form-outline mb-2">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" name="email" id="email" class="form-control form-control-lg" />
                                                        <span id="emailInvalid" class="invalid">Please enter a valid email address</span>
                                                    </div>
                                                    <div class="form-outline mb-2">
                                                        <label class="form-label" for="contactno">Contact Number</label>
                                                        <input type="text" name="contactno" id="contactno" class="form-control form-control-lg" />
                                                        <span id="contactInvalid" class="invalid">Please enter a valid contact number</span>
                                                    </div>
                                                    <div class="form-outline">
                                                        <label class="form-label">Gender</label><br>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input radio-inline" type="radio" name="gender" value="m" id="gendermale" checked>
                                                            <label class="form-check-label" for="gendermale">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio" name="gender" value="f" id="genderfemale">
                                                            <label class="form-check-label" for="genderfemale">Female</label>
                                                        </div>
                                                        <span id="genderInvalid" class="invalid">Please enter a valid contact number</span>
                                                    </div>
                                                </div>

                                                <div class="tab-pane fade" id="userdetails" role="tabpanel" aria-labelledby="nav-user-details">
                                                    <div class="form-outline mb-2">
                                                        <label class="form-label mt-4 mb-2" for="usertype">User Type</label>
                                                        <select class="form-select form-select-lg" id="usertype" name="usertype" aria-label="Default select example">
                                                            <option value="" selected>Choose</option>
                                                            <option value="teacher">Teacher</option>
                                                            <option value="student">Student</option>
                                                        </select>
                                                        <span id="userTypeInvalid" class="invalid">Please select role of user</span>
                                                    </div>
                                                    <div class="form-outline mb-2">
                                                        <label class="form-label" for="userid">User id</label>
                                                        <input type="text" name="userid" id="userid" class="form-control form-control-lg" />
                                                        <span id="userIdInvalid" class="invalid">Please enter a valid user id</span>
                                                        <span id="userIdInvalid2" class="invalid">User id is already in use</span>
                                                    </div>
                                                    <!-- <div class="form-outline mb-2" id="categoryDiv">
                                                        <label class="form-label" for="category">Category</label>
                                                        <select id="category" class="form-select form-select-lg" name="category" aria-label="Default select example">
                                                            <option value="" selected>Choose</option>
                                                            <option value="BCA">BCA</option>
                                                            <option value="MCA">MCA</option>
                                                            <option value="IMCA">IMCA</option>
                                                        </select>
                                                        <span id="categoryInvalid" class="invalid">Please select a category</span>
                                                    </div> -->
                                                </div>

                                                <div class="tab-pane fade" id="contactdetails" role="tabpanel" aria-labelledby="nav-password">
                                                    <div class="form-outline my-4">
                                                        <label class="form-label" for="password">Password</label>
                                                        <div class="d-flex">
                                                            <input type="password" class="form-control form-control-lg" name="password" id="password" autocomplete="off" />
                                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                                <i id="eyeIcon" class="bi bi-eye"></i>
                                                            </span>
                                                        </div>
                                                        <p id="passwordInvalid1" class="invalid">Password must contain at least a lower case letter, an upper case letter, and a number, or special character with minimun 8 characters.</p>
                                                    </div>
                                                    <div id="passwordChecked" class="form-outline my-4">
                                                        <label class="form-label" for="confpassword">Confirm password</label>
                                                        <input type="password" class="form-control form-control-lg" name="confpassword" id="confpassword" autocomplete="off" />
                                                        <span id="passwordInvalid2" class="invalid">Passwords are not matched</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- tabbed form end -->
                                        <div class="form-outline d-flex justify-content-end">
                                            <input type="button" id="previoustab" class="btn me-3" value="Previous" disabled />
                                            <input type="submit" id="submitform" class="btn btn-success" name="signup" value="Next" />
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="tqmodal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="thank-you-pop">
                        <i style='font-size:10vh;color:green;' class="bi bi-check-circle"></i>
                        <h1>Thank You!</h1>
                        <p>Your request is received<br> You can log into your account after your request is approved</p>
                        <p style="margin-top:5vh;">You will be redirected in to login page after <span id="counter">5</span> seconds.</a></p>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="modal fade" id="duplicateidmodal" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="thank-you-pop">
                        <i style='font-size:10vh;color:red;' class="bi bi-x-circle"></i>
                        <h3>User id is not available!</h3>
                        <p>Please verify user id which you entered is incorrect</p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="unkownerror" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="thank-you-pop">
                        <i style='font-size:10vh;color:red;' class="bi bi-x-circle"></i>
                        <h5 id='ukerror'></h5>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // JQuery
        $(document).ready(function() {
            // $('body').click(function() {
            //     $('#duplicateidmodal').modal('show');
            // });

            //This function will show previous tab
            $("#previoustab").on('click', function() {
                var button_count = $('.nav-tabs button').length;
                var current_active = $('.nav-tabs button.active').index();
                if (current_active > 0) {
                    $('.nav-tabs button.active').prev('button').attr('data-toggle', 'tab').tab('show');
                }
            });

            //This function will prevent form submission until the last tab(3rd page)
            $("form").on('submit', function(event) {
                event.preventDefault();

                var button_count = $('.nav-tabs button').length;
                var current_active = $('.nav-tabs button.active').index();
                if (current_active < button_count - 1) {
                    $('.nav-tabs button.active').next('button').attr('data-toggle', 'tab').tab('show');

                    $('#previoustab').removeAttr('disabled');
                    if (current_active == 1) {
                        $("input[type='submit']").attr('value', 'Register');
                    }
                } else {
                    if (formValidation()) {
                        // event.currentTarget.submit();
                        name1 = $('#fullname').val();
                        email1 = $('#email').val();
                        contact1 = $('#contactno').val();
                        gender1 = $('input[name=gender]:checked').val();
                        usertype1 = $('#usertype').val();
                        userid1 = $('#userid').val();
                        // category1 = $('#category').val();
                        password1 = $('#password').val();
                        confirmpassword1 = $('#confpassword').val();
                        if (usertype1 == 'student') {
                            $.ajax({
                                method: "post",
                                url: "registration_entry.php",
                                data: {
                                    fullname: name1,
                                    email: email1,
                                    contactno: contact1,
                                    gender: gender1,
                                    usertype: usertype1,
                                    userid: userid1,
                                    // category: category1,
                                    password: password1,
                                    confpassword: confirmpassword1
                                },
                                success: function(response) {
                                    obj = JSON.parse(response);
                                    if (obj.success == true) {
                                        $('#tqmodal').modal('show');
                                        redirectToLogin();
                                    } else {
                                        if (obj.errorcode == 1062) {
                                            $('#userdetailstab').attr('data-toggle', 'tab').tab('show');
                                            $('#userIdInvalid2').show();
                                            $('#duplicateidmodal').modal('show');
                                        } else {
                                            $('#unknownerror').modal('show');
                                            $('#ukerror').html(obj.errormessage);
                                        }
                                    }
                                }
                            });
                        } else {
                            $.ajax({
                                method: "post",
                                url: "registration_entry.php",
                                data: {
                                    fullname: name1,
                                    email: email1,
                                    contactno: contact1,
                                    gender: gender1,
                                    usertype: usertype1,
                                    userid: userid1,
                                    password: password1,
                                    confpassword: confirmpassword1
                                },
                                success: function(response) {
                                    obj = JSON.parse(response);
                                    if (obj.success == true) {
                                        $('#tqmodal').modal('show');
                                        redirectToLogin();
                                    } else {
                                        if (obj.errorcode == 1062) {
                                            $('#userdetailstab').attr('data-toggle', 'tab').tab('show');
                                            $('#userIdInvalid2').show();
                                            $('#duplicateidmodal').modal('show');
                                        } else {
                                            $('#unknownerror').modal('show');
                                            $('#ukerror').html(obj.errormessage);
                                        }
                                    }
                                }
                            });
                        }
                        return false;
                    }
                }
            });

            //Changes Register button to Next when previous button is clicked
            $("#previoustab").on('click', function() {
                if ($("input[type='submit']").val() == 'Register') {
                    $("input[type='submit']").attr('value', 'Next');
                }
            });

            //This function will enable or disable category selection box
            $('#usertype').on('change', function() {
                if ($(this).val() == 'student' || $(this).val() == 'teacher') {
                    $("#userTypeInvalid").hide();
                }
            });

            // $('#usertype').on('change', function() {
            //     if ($(this).val() == 'student') {
            //         $("#categoryDiv").show();
            //     } else {
            //         $("#categoryDiv").hide();
            //     }
            // });


            //When the value of input box is changed it will remove warning
            $("input:text, #email").on('input', function(event) {
                $(event.target).next().hide();
                $('#userIdInvalid2').hide();
            });

            //When the value of password input box is changed it will remove warning
            $("#password").on('input', function(event) {
                $("#passwordInvalid1").hide();
            });

            //When the value of category select box is changed it will run
            // $("#category").on('change', function(event) {
            //     $(event.target).next().hide();
            // });

            //Match values of password and confirm password while input 
            $("#confpassword, #password").on('input', function(event) {
                var password = document.forms.regform.password.value;
                var confPassword = document.forms.regform.confpassword.value;
                $("#passwordInvalid2").show();
                if (password == confPassword && password != "") {
                    $("#passwordInvalid2").hide();
                    $("#passwordChecked").append("<p id='matched' style='font-size:80%;color:green;padding-left:1%;'>Password matched <b>&check;<b></p>");
                } else {
                    $('#matched').remove();
                }
            });
        });

        //JavaScript
        //Form validation function
        function formValidation() {
            var name = document.forms.regform.fullname.value; //document (dom manipulation object)
            var email = document.forms.regform.email.value; // forms (all forms in webpage)
            var contactNo = document.forms.regform.contactno.value; // regfrom (form which has name attribute value regfrom) 
            var password = document.forms.regform.password.value; //fullname (form input which has name attribute value fullname)
            var confPassword = document.forms.regform.confpassword.value;
            var usertype = document.forms.regform.usertype.value;
            var userid = document.forms.regform.userid.value;
            var regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/; //Javascript reGex for Email Validation.
            var regContactNo = /^\d{10}$/; // Javascript reGex for contact number validation.
            var regUserIdStudent = /^\d{10,15}$/; // Javascript reGex for user id validation.
            var regUserIdTeacher = /[~!%^&*()+=*?\-\"',.;:|]/;
            var regName2 = /^[A-Z][a-zA-Z ]*$/; // Javascript reGex for Name validation
            var regPassword = /^(?=.*[0-9])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*_]{8,16}$/; //regex for passsword checking

            if (name == "" || !regName2.test(name)) {
                $("#perosnaldetailstab").attr('data-toggle', 'tab').tab('show'); // It will switch to tab which has wrong input value
                $("#nameInvalid").show(); //Display warning
                if (email == "" || !regEmail.test(email)) {
                    $("#emailInvalid").show(); //Display warning
                }
                if (contactNo == "" || !regContactNo.test(contactNo)) {
                    $("#contactInvalid").show(); //Display warning
                }
                $("input[type='submit']").attr('value', 'Next');
                return false;
            }

            if (email == "" || !regEmail.test(email)) {
                $("#perosnaldetailstab").attr('data-toggle', 'tab').tab('show');
                $("#emailInvalid").show(); //Display warning
                if (contactNo == "" || !regContactNo.test(contactNo)) {
                    $("#contactInvalid").show(); //Display warning
                }
                $("input[type='submit']").attr('value', 'Next');
                return false;
            }

            if (contactNo == "" || !regContactNo.test(contactNo)) {
                $("#perosnaldetailstab").attr('data-toggle', 'tab').tab('show');
                $("#contactInvalid").show(); //Display warning
                $("input[type='submit']").attr('value', 'Next');
                return false;
            }

            if (usertype == "") { //If user type is not selected warning will be displayed
                $("#userdetailstab").attr('data-toggle', 'tab').tab('show');
                $("#userTypeInvalid").show();
                if (userid == "" || !regUserIdStudent.test(userid)) {
                    $("#userIdInvalid").show();
                }


                $("input[type='submit']").attr('value', 'Next');
                return false;
            }
            if (usertype == 'student') {
                if (userid == "" || !regUserIdStudent.test(userid)) {
                    $("#userdetailstab").attr('data-toggle', 'tab').tab('show');
                    $("#userIdInvalid").show(); //Display warning
                $("input[type='submit']").attr('value', 'Next');
                    return false;
                }
            } else if (usertype == 'teacher') {
                if (userid == "" || regUserIdTeacher.test(userid)) {
                    $("#userdetailstab").attr('data-toggle', 'tab').tab('show');
                    $("#userIdInvalid").show(); //Display warning
                $("input[type='submit']").attr('value', 'Next');
                    return false;
                }
            }


            if (password == "" || !regPassword.test(password) || password.length < 8) {
                $("#passwordInvalid1").css('display', 'block'); //Display warning
                return false;
            }

            if (confPassword != password) {
                $("#passwordInvalid2").show(); //Display warning
                return false;
            }

            return true;
        }


        //Password eye icon toggle
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        const confpassword = document.querySelector("#confpassword");

        togglePassword.addEventListener("click", function() {

            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            confpassword.setAttribute("type", type);

            const pass = document.querySelector("#eyeIcon");
            attr = pass.getAttribute("class") === "bi bi-eye" ? "bi bi-eye-slash-fill" : "bi bi-eye";
            pass.setAttribute("class", attr);
        });

        //Server response 
        function redirectToLogin() {
            function countdown() {
                var i = document.getElementById('counter');
                if (parseInt(i.innerHTML) <= 0) {
                    location.href = '../login/login.php';
                }
                if (parseInt(i.innerHTML) != 0) {
                    i.innerHTML = parseInt(i.innerHTML) - 1;
                }
            }
            setInterval(function() {
                countdown();
            }, 1000);
        }
    </script>
</body>

</html>