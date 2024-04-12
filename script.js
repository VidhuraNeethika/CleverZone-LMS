function start_functions() {
    loadTeachers();
    loadAllTeachers();
    load_academic_officers();
    load_all_academic_officers();
    load_students();
    load_all_students();
    load_students_requests();
    load_academic_officers_nv();
    load_teachers_nv();
    load_students_nv();
    load_requests();
    load_user_details();
}

function start_functions_tec() {
    load_lesson_notes();
    load_assignments();
    load_user_details();
    load_results_tec();
}

function start_functions_stu() {
    load_assignments_stu();
    load_user_details();
}

function start_functions_ac() {
    load_results_ac();
}

function scrollEffect() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
        document.getElementById("scroll-top").style.visibility = "visible";
        document.getElementById("headerMainShadow").classList.add("shadow");
    } else {
        document.getElementById("scroll-top").style.visibility = "hidden";
        document.getElementById("headerMainShadow").classList.remove("shadow");
    }
}

function goToSignIn() {
    window.location = "sign-in.php";
}

function goToHome() {
    window.location = "index.php";
}

var k;

function getRequestAlert() {

    swal({
        title: "Request to Login",
        text: "You must first enter your information to access this application and submit a request to us. After that we will check your information and send you your username, password and verification code to your email address.If you are already a verified user of this application, you can proceed by clicking on the 'Already Verified User' button.",
        buttons: ["Already Verified User", "Continue"],
        closeOnClickOutside: false,

    }).then((willDelete) => {
        if (willDelete) {
            k = new bootstrap.Modal(request_model);
            k.show();
        } else {
            alert("delete");
        }
    });

}

function submit_request() {
    var personal_title = document.getElementById("pt");
    var first_name = document.getElementById("fst_name");
    var last_name = document.getElementById("lst_name");
    var email = document.getElementById("mle");
    var gender = document.getElementById("mgender");

    var genderf = "";

    if (gender.checked) {
        genderf = "1";
    } else {
        genderf = "2";
    }

    var form = new FormData();
    form.append("personal_title", personal_title.value);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("email", email.value);
    form.append("gender", genderf);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "fn") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter your first name!",
                });
            } else if (text == "ln") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter your last name!",
                });
            } else if (text == "eml") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter your email address!",
                });
            } else if (text == "ok") {
                swal({
                        icon: "success",
                        title: "Success!",
                        text: "Your request has been sent successfully. Please wait for us to verify your information and send your username, password and verification code to your email address.Please check your email.",
                    })
                    .then(() => {
                        first_name.value = "";
                        last_name.value = "";
                        email.value = "";

                        k.hide();

                    });
            }

        }
    }
    r.open("POST", "send-request.php", true);
    r.send(form);

}

function sendSignInDetails(user_email) {
    var user_name = document.getElementById("createUsername" + user_email);
    var password = document.getElementById("createPassword" + user_email);
    var verification_code = document.getElementById("verificationCode" + user_email);
    var user_role = document.getElementById("userRole" + user_email);

    var form = new FormData();
    form.append("user_name", user_name.value);
    form.append("password", password.value);
    form.append("verification_code", verification_code.value);
    form.append("user_role", user_role.innerHTML);
    form.append("user_email", user_email);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "ok") {
                swal({
                    icon: "success",
                    buttons: false,
                    text: "Success",
                    timer: 2000,
                });
                start_functions();
            }
        }
    }
    r.open("POST", "send-sign-in-details-academic.php", true);
    r.send(form);
}

function signIn() {
    var username = document.getElementById("username");
    var password = document.getElementById("password");
    var verification_code = document.getElementById("verification_code");
    var remember_me = document.getElementById("remember_me");

    var form = new FormData();
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification_code", verification_code.value);
    form.append("remember_me", remember_me.checked);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "done-a") {
                swal({
                        icon: "success",
                        text: "Verified",
                    })
                    .then(() => {
                        window.location = "admin-panel.php";
                    });
            } else if (text == "done-ac") {
                swal({
                        icon: "success",
                        text: "Verified",
                    })
                    .then(() => {
                        window.location = "a-o-panel.php";
                    });
            } else if (text == "done-t") {
                swal({
                        icon: "success",
                        text: "Verified",
                    })
                    .then(() => {
                        window.location = "tec-panel.php";
                    });
            } else if (text == "done-s") {
                swal({
                        icon: "success",
                        text: "Verified",
                    })
                    .then(() => {
                        window.location = "stu-panel.php";
                    });
            } else if (text == "un") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Incorrect Username. Please try again!",
                });
            } else if (text == "pw") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Incorrect Password. Please try again!",
                });
            } else if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Something were Wrong! Please try again.",
                });
            } else if (text == "nvu") {
                document.getElementById("verificationCodeArea").classList.remove("d-none");
            }

        }
    }
    r.open("POST", "sign-in-process.php", true);
    r.send(form);
}

function goToAOPanel() {
    window.location = "a-o-panel.php";
}

function goToTecPanel() {
    window.location = "tec-panel.php";
}

function goToStuPanel() {
    window.location = "stu-panel.php";
}

function goToAdminPanel() {
    window.location = "admin-panel.php";
}

function load_students_nv() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("STUsNV").innerHTML = text;
        }
    }
    r.open("POST", "load-students-nv.php", true);
    r.send();
}

function load_requests() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("requests").innerHTML = text;
        }
    }
    r.open("POST", "load-requests.php", true);
    r.send();
}

function load_teachers_nv() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("TECsNV").innerHTML = text;
        }
    }
    r.open("POST", "load-teachers-nv.php", true);
    r.send();
}

function load_academic_officers_nv() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("AOsNV").innerHTML = text;
        }
    }
    r.open("POST", "load-academic-officers-nv.php", true);
    r.send();
}

function load_students_requests() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("students_requests_area").innerHTML = text;
        }
    }
    r.open("POST", "load-students-requests.php", true);
    r.send();
}

function loadTeachers() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("Allteacs").innerHTML = text;
        }
    }
    r.open("POST", "load-teachers.php", true);
    r.send();
}

function loadAllTeachers() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("Allteacs2").innerHTML = text;
        }
    }
    r.open("POST", "load-all-teachers.php", true);
    r.send();
}

function load_academic_officers() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("AllAcsV").innerHTML = text;
        }
    }
    r.open("POST", "load-academic-officers.php", true);
    r.send();
}

function load_all_academic_officers() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("AllAcss").innerHTML = text;
        }
    }
    r.open("POST", "load-all-academic-officers.php", true);
    r.send();
}

function load_students() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("AllSTUs").innerHTML = text;
        }
    }
    r.open("POST", "load-students.php", true);
    r.send();
}

function load_all_students() {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("AllSTUss").innerHTML = text;
        }
    }
    r.open("POST", "load-all-students.php", true);
    r.send();
}

function add_teachers() {
    var first_name = document.getElementById("mt_fst_name");
    var last_name = document.getElementById("mt_lst_name");
    var personal_title = document.getElementById("mt_pt");
    var city = document.getElementById("mt_city");

    var mobile = document.getElementById("mt_mobile");
    var email = document.getElementById("mt_email");
    var address_line_1 = document.getElementById("mt_address_1");
    var address_line_2 = document.getElementById("mt_address_2");
    var gender = document.getElementById("mt_gender");

    var genderf = "";

    if (gender.checked) {
        genderf = "1";
    } else {
        genderf = "2";
    }

    var form = new FormData();
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("personal_title", personal_title.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address_line_1", address_line_1.value);
    form.append("address_line_2", address_line_2.value);
    form.append("gender", genderf);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "ur") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Name!",
                });
            } else if (text == "mr") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Number!",
                });
            } else if (text == "er") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Email Address!",
                });
            } else if (text == "ar1") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 1!",
                });
            } else if (text == "ar2") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 2!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Added",
                    })
                    .then(() => {
                        first_name.value = "";
                        last_name.value = "";
                        mobile.value = "";
                        email.value = "";
                        address_line_1.value = "";
                        address_line_2.value = "";
                        city.value = 0;

                        start_functions();
                    });
            }

        }
    }
    r.open("POST", "add-teachers-process.php", true);
    r.send(form);
}

function add_academic_officers() {
    var first_name = document.getElementById("ac_fst_name");
    var last_name = document.getElementById("ac_lst_name");
    var personal_title = document.getElementById("ac_pt");
    var city = document.getElementById("ac_city");

    var mobile = document.getElementById("ac_mobile");
    var email = document.getElementById("ac_email");
    var address_line_1 = document.getElementById("ac_address_1");
    var address_line_2 = document.getElementById("ac_address_2");
    var gender = document.getElementById("ac_gender");

    var genderf = "";

    if (gender.checked) {
        genderf = "1";
    } else {
        genderf = "2";
    }

    var form = new FormData();
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("personal_title", personal_title.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address_line_1", address_line_1.value);
    form.append("address_line_2", address_line_2.value);
    form.append("gender", genderf);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "ur") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Name!",
                });
            } else if (text == "mr") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Number!",
                });
            } else if (text == "er") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Email Address!",
                });
            } else if (text == "ar1") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 1!",
                });
            } else if (text == "ar2") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 2!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Added",
                    })
                    .then(() => {
                        first_name.value = "";
                        last_name.value = "";
                        mobile.value = "";
                        email.value = "";
                        address_line_1.value = "";
                        address_line_2.value = "";
                        city.value = 0;

                        start_functions();
                    });
            }

        }
    }
    r.open("POST", "add-academic-officers-process.php", true);
    r.send(form);
}

function add_students() {
    var first_name = document.getElementById("st_fst_name");
    var last_name = document.getElementById("st_lst_name");
    var personal_title = document.getElementById("st_pt");
    var city = document.getElementById("st_city");

    var mobile = document.getElementById("st_mobile");
    var email = document.getElementById("st_email");
    var address_line_1 = document.getElementById("st_address_1");
    var address_line_2 = document.getElementById("st_address_2");
    var gender = document.getElementById("st_gender");

    var grade = document.getElementById("st_grade");

    var genderf = "";

    if (gender.checked) {
        genderf = "1";
    } else {
        genderf = "2";
    }

    var form = new FormData();
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("personal_title", personal_title.value);
    form.append("city", city.value);
    form.append("grade", grade.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address_line_1", address_line_1.value);
    form.append("address_line_2", address_line_2.value);
    form.append("gender", genderf);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "ur") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Name!",
                });
            } else if (text == "mr") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Number!",
                });
            } else if (text == "er") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Email Address!",
                });
            } else if (text == "ar1") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 1!",
                });
            } else if (text == "ar2") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 2!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Added",
                    })
                    .then(() => {
                        first_name.value = "";
                        last_name.value = "";
                        mobile.value = "";
                        email.value = "";
                        address_line_1.value = "";
                        address_line_2.value = "";
                        city.value = 0;
                        grade.value = 0;

                        start_functions();
                    });
            }

        }
    }
    r.open("POST", "add-students-process.php", true);
    r.send(form);
}

function updateTeachers(id) {
    var first_name = document.getElementById("fname" + id);
    var last_name = document.getElementById("lname" + id);
    var city = document.getElementById("tcity" + id);

    var mobile = document.getElementById("mobile" + id);
    var email = document.getElementById("email" + id);
    var address1 = document.getElementById("address1" + id);
    var address2 = document.getElementById("address2" + id);
    var username = document.getElementById("username" + id);
    var password = document.getElementById("password" + id);
    var verification = document.getElementById("verification" + id);

    var verification_status = "";
    if (verification.checked) {
        verification_status = 1;
    } else {
        verification_status = 2;
    }

    var form = new FormData();
    form.append("id", id);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address1", address1.value);
    form.append("address2", address2.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification", verification_status);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please check the form details and try again!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        start_functions();
                    });
            }
        }
    }
    r.open("POST", "update-process.php", true);
    r.send(form);

}

function update_academic_officers(id) {
    var first_name = document.getElementById("Aname" + id);
    var last_name = document.getElementById("Alname" + id);
    var city = document.getElementById("Acity" + id);

    var mobile = document.getElementById("Amobile" + id);
    var email = document.getElementById("Aemail" + id);
    var address1 = document.getElementById("Aaddress1" + id);
    var address2 = document.getElementById("Aaddress2" + id);
    var username = document.getElementById("Ausername" + id);
    var password = document.getElementById("Apassword" + id);
    var verification = document.getElementById("Averification" + id);

    var verification_status = "";
    if (verification.checked) {
        verification_status = 1;
    } else {
        verification_status = 2;
    }

    var form = new FormData();
    form.append("id", id);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address1", address1.value);
    form.append("address2", address2.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification", verification_status);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please check the form details and try again!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        load_academic_officers();
                        load_all_academic_officers();
                    });
            }
        }
    }
    r.open("POST", "update-process.php", true);
    r.send(form);
}

function update_students(id) {
    var first_name = document.getElementById("stfname" + id);
    var last_name = document.getElementById("stlname" + id);
    var city = document.getElementById("stcity" + id);

    var mobile = document.getElementById("stmobile" + id);
    var email = document.getElementById("stemail" + id);
    var address1 = document.getElementById("staddress1" + id);
    var address2 = document.getElementById("staddress2" + id);
    var username = document.getElementById("stusername" + id);
    var password = document.getElementById("stpassword" + id);
    var verification = document.getElementById("stverification" + id);

    var verification_status = "";
    if (verification.checked) {
        verification_status = 1;
    } else {
        verification_status = 2;
    }

    var form = new FormData();
    form.append("id", id);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address1", address1.value);
    form.append("address2", address2.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification", verification_status);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please check the form details and try again!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        start_functions();
                    });
            }
        }
    }
    r.open("POST", "update-process.php", true);
    r.send(form);
}

function update_all_students(id) {
    var first_name = document.getElementById("STUfname" + id);
    var last_name = document.getElementById("STUlname" + id);
    var city = document.getElementById("STUcity" + id);

    var mobile = document.getElementById("STUmobile" + id);
    var email = document.getElementById("STUemail" + id);
    var address1 = document.getElementById("STUaddress1" + id);
    var address2 = document.getElementById("STUaddress2" + id);
    var username = document.getElementById("STUusername" + id);
    var password = document.getElementById("STUpassword" + id);
    var verification = document.getElementById("STUverification" + id);

    var verification_status = "";
    if (verification.checked) {
        verification_status = 1;
    } else {
        verification_status = 2;
    }

    var form = new FormData();
    form.append("id", id);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address1", address1.value);
    form.append("address2", address2.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification", verification_status);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please check the form details and try again!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        start_functions();
                    });
            }
        }
    }
    r.open("POST", "update-process.php", true);
    r.send(form);
}

function updateAllTeachers(id) {
    var first_name = document.getElementById("ATfname" + id);
    var last_name = document.getElementById("ATlname" + id);
    var city = document.getElementById("ATcity" + id);

    var mobile = document.getElementById("ATmobile" + id);
    var email = document.getElementById("ATemail" + id);
    var address1 = document.getElementById("ATaddress1" + id);
    var address2 = document.getElementById("ATaddress2" + id);
    var username = document.getElementById("ATusername" + id);
    var password = document.getElementById("ATpassword" + id);
    var verification = document.getElementById("ATverification" + id);

    var verification_status = "";
    if (verification.checked) {
        verification_status = 1;
    } else {
        verification_status = 2;
    }

    var form = new FormData();
    form.append("id", id);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address1", address1.value);
    form.append("address2", address2.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification", verification_status);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please check the form details and try again!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        start_functions();
                    });
            }
        }
    }
    r.open("POST", "update-process.php", true);
    r.send(form);

}

function update_all_academic_officers(id) {
    var first_name = document.getElementById("ACOname" + id);
    var last_name = document.getElementById("ACOlname" + id);
    var city = document.getElementById("ACOcity" + id);

    var mobile = document.getElementById("ACOmobile" + id);
    var email = document.getElementById("ACOemail" + id);
    var address1 = document.getElementById("ACOaddress1" + id);
    var address2 = document.getElementById("ACOaddress2" + id);
    var username = document.getElementById("ACOusername" + id);
    var password = document.getElementById("ACOpassword" + id);
    var verification = document.getElementById("ACOverification" + id);

    var verification_status = "";
    if (verification.checked) {
        verification_status = 1;
    } else {
        verification_status = 2;
    }

    var form = new FormData();
    form.append("id", id);
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("city", city.value);
    form.append("mobile", mobile.value);
    form.append("email", email.value);
    form.append("address1", address1.value);
    form.append("address2", address2.value);
    form.append("username", username.value);
    form.append("password", password.value);
    form.append("verification", verification_status);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "error") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please check the form details and try again!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        load_academic_officers();
                        load_all_academic_officers();
                    });
            }
        }
    }
    r.open("POST", "update-process.php", true);
    r.send(form);
}

function status_change(id) {
    var user_id = id;
    var veri_label = document.getElementById("veri_label" + user_id);

    var form = new FormData();
    form.append("user_id", user_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "deactivate") {
                veri_label.innerHTML = "Make as verified user.";
            } else if (text = "activate") {
                veri_label.innerHTML = "Make as non-verified user.";
            }

        }
    }
    r.open("POST", "status-change-process.php", true);
    r.send(form);
}

function status_change_all(id) {
    var user_id = id;
    var veri_label = document.getElementById("ATveri_label" + user_id);

    var form = new FormData();
    form.append("user_id", user_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "deactivate") {
                veri_label.innerHTML = "Make as verified user.";
            } else if (text = "activate") {
                veri_label.innerHTML = "Make as non-verified user.";
            }

        }
    }
    r.open("POST", "status-change-process.php", true);
    r.send(form);
}

function status_change_ac(id) {
    var user_id = id;
    var veri_label = document.getElementById("Averi_label" + user_id);

    var form = new FormData();
    form.append("user_id", user_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "deactivate") {
                veri_label.innerHTML = "Make as verified user.";
            } else if (text = "activate") {
                veri_label.innerHTML = "Make as non-verified user.";
            }

        }
    }
    r.open("POST", "status-change-process.php", true);
    r.send(form);
}

function status_change_ac_all(id) {
    var user_id = id;
    var veri_label = document.getElementById("ACOveri_label" + user_id);

    var form = new FormData();
    form.append("user_id", user_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "deactivate") {
                veri_label.innerHTML = "Make as verified user.";
            } else if (text = "activate") {
                veri_label.innerHTML = "Make as non-verified user.";
            }

        }
    }
    r.open("POST", "status-change-process.php", true);
    r.send(form);
}

function status_change_students(id) {
    var user_id = id;
    var veri_label = document.getElementById("stveri_label" + user_id);

    var form = new FormData();
    form.append("user_id", user_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "deactivate") {
                veri_label.innerHTML = "Make as verified user.";
            } else if (text = "activate") {
                veri_label.innerHTML = "Make as non-verified user.";
            }

        }
    }
    r.open("POST", "status-change-process.php", true);
    r.send(form);
}

function status_change_all_students(id) {
    var user_id = id;
    var veri_label = document.getElementById("STUveri_label" + user_id);

    var form = new FormData();
    form.append("user_id", user_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "deactivate") {
                veri_label.innerHTML = "Make as verified user.";
            } else if (text = "activate") {
                veri_label.innerHTML = "Make as non-verified user.";
            }

        }
    }
    r.open("POST", "status-change-process.php", true);
    r.send(form);
}

function delete_teachers(id) {
    swal("Are you sure?", {
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                var form = new FormData();
                form.append("id", id);

                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var text = r.responseText;

                        if (text == "ok") {
                            start_functions();
                        }

                    }
                }
                r.open("POST", "delete-users.php", true);
                r.send(form);
            }

        });
}

function delete_academic_officers(id) {
    swal("Are you sure?", {
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                var form = new FormData();
                form.append("id", id);

                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var text = r.responseText;

                        if (text == "ok") {
                            start_functions();
                        }

                    }
                }
                r.open("POST", "delete-users.php", true);
                r.send(form);
            }

        });
}

function delete_students(id) {
    swal("Are you sure?", {
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                var form = new FormData();
                form.append("id", id);

                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var text = r.responseText;

                        if (text == "ok") {
                            start_functions();
                        }

                    }
                }
                r.open("POST", "delete-users.php", true);
                r.send(form);
            }

        });
}

function add_lessons() {
    var lesson_name = document.getElementById("lname");
    var subject = document.getElementById("lsubject");
    var grade = document.getElementById("lgrade");
    var pdf = document.getElementById("lfile");

    var form = new FormData();
    form.append("lesson_name", lesson_name.value);
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("file", pdf.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "lnE") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter lesson name!",
                });
            } else if (text == "se") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please select subject!",
                });
            } else if (text == "ge") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please select grade!",
                });
            } else if (text == "nt") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please add lesson note!",
                });
            } else if (text == "ok") {
                swal({
                    icon: "success",
                    title: "Success!",
                    text: "Successfully Added Lesson Note!",
                }).then(() => {
                    lesson_name.value = "";
                    subject.value = 0;
                    grade.value = 0;
                    pdf.value = "";
                });
            }

        }
    }
    r.open("POST", "add-lesson-process.php", true);
    r.send(form);
}

function load_lesson_notes() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("manageLN").innerHTML = text;
        }
    }
    r.open("POST", "load-lesson-notes.php", true);
    r.send();

}

function update_lesson(id, old_note) {
    var lesson_id = id;
    var pre_note = old_note;

    var lesson_name = document.getElementById("ulname" + lesson_id);
    var subject = document.getElementById("ulsubject" + lesson_id);
    var grade = document.getElementById("ulgrade" + lesson_id);
    var pdf = document.getElementById("ulfile" + lesson_id);

    var form = new FormData();
    form.append("lesson_name", lesson_name.value);
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("lesson_id", lesson_id);
    form.append("pre_note", pre_note);
    form.append("file", pdf.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "lnE") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter lesson name!",
                });

            } else if (text == "ok") {
                swal({
                    icon: "success",
                    title: "Success!",
                    text: "Successfully Update the Lesson Note!",
                }).then(() => {
                    start_functions_tec();
                });
            }

        }
    }
    r.open("POST", "update-lesson-process.php", true);
    r.send(form);

}

function delete_lesson(lesson_id) {

    swal("Are you sure?", {
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                var form = new FormData();
                form.append("lesson_id", lesson_id);

                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var text = r.responseText;

                        if (text == "ok") {
                            start_functions_tec();
                        }

                    }
                }
                r.open("POST", "delete-lesson-notes.php", true);
                r.send(form);
            }

        });
}

function add_assignment() {
    var assignment_code = document.getElementById("as_code");
    var assignment_name = document.getElementById("as_name");
    var subject = document.getElementById("as_subject");
    var grade = document.getElementById("as_grade");
    var assignment_file = document.getElementById("as_assignment");
    var starting_date = document.getElementById("as_date");
    var closing_date = document.getElementById("as_en_date");

    var form = new FormData();
    form.append("assignment_code", assignment_code.value);
    form.append("assignment_name", assignment_name.value);
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("assignment_file", assignment_file.files[0]);
    form.append("starting_date", starting_date.value);
    form.append("closing_date", closing_date.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "ac") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter assignment code!",
                });
            } else if (text == "an") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter assignment name!",
                });
            } else if (text == "sb") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please select subject!",
                });
            } else if (text == "gd") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please select grade!",
                });
            } else if (text == "sd") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please add starting date!",
                });
            } else if (text == "cd") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please add ending date!",
                });
            } else if (text == "as") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please add assignment file!",
                });
            } else if (text == "ok") {
                swal({
                    icon: "success",
                    title: "Success!",
                    text: "Successfully Added!",
                }).then(() => {
                    start_functions_tec();
                });
            }

        }
    }
    r.open("POST", "add-assignments.php", true);
    r.send(form);
}

function load_assignments() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("manage_assignments").innerHTML = text;
        }
    }
    r.open("POST", "load-assignments.php", true);
    r.send();

}

function update_assignment(assignments_id, assignment) {
    var assignment_code = document.getElementById("as_code" + assignments_id);
    var assignment_name = document.getElementById("as_name" + assignments_id);
    var subject = document.getElementById("as_subject" + assignments_id);
    var grade = document.getElementById("as_grade" + assignments_id);
    var assignment_file = document.getElementById("as_assignment" + assignments_id);
    var starting_date = document.getElementById("as_date" + assignments_id);
    var closing_date = document.getElementById("as_en_date" + assignments_id);

    var form = new FormData();
    form.append("assignment_id", assignments_id);
    form.append("assignment", assignment);
    form.append("assignment_code", assignment_code.value);
    form.append("assignment_name", assignment_name.value);
    form.append("subject", subject.value);
    form.append("grade", grade.value);
    form.append("assignment_file", assignment_file.files[0]);
    form.append("starting_date", starting_date.value);
    form.append("closing_date", closing_date.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;

            if (text == "ac") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter assignment code!",
                });
            } else if (text == "an") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please enter assignment name!",
                });
            } else if (text == "sd") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please add starting date!",
                });
            } else if (text == "cd") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please add ending date!",
                });
            } else if (text == "ok") {
                swal({
                    icon: "success",
                    title: "Success!",
                    text: "Successfully Updated!",
                }).then(() => {
                    start_functions_tec();
                });
            }

        }
    }
    r.open("POST", "update-assignments.php", true);
    r.send(form);
}

function delete_assignment(assignment_id) {
    swal("Are you sure?", {
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                var form = new FormData();
                form.append("assignment_id", assignment_id);

                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var text = r.responseText;

                        if (text == "ok") {
                            start_functions_tec();
                        }

                    }
                }
                r.open("POST", "delete-assignments.php", true);
                r.send(form);
            }

        });
}

function load_assignments_stu() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("assignments_area").innerHTML = text;
        }
    }
    r.open("POST", "load-assignments_stu.php", true);
    r.send();

}

function upload_assignment(assignment_id) {

    var assignment_id = assignment_id;
    var assignment_file = document.getElementById("upload_assignment_file" + assignment_id);

    var modal = document.getElementById("upload_assignment" + assignment_id);

    var form = new FormData();
    form.append("assignment_id", assignment_id);
    form.append("assignment_file", assignment_file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "ok") {

                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Uploaded",
                    })
                    .then(() => {
                        var Assmodal = bootstrap.Modal.getInstance(modal);
                        Assmodal.hide();
                        start_functions_stu();
                    });

            } else if (text == "as") {
                swal({
                    icon: "warning",
                    title: "Warning",
                    text: "Please add a Assignment",
                })
            }
        }
    }

    r.open("POST", "upload-assignment-paper.php", true);
    r.send(form);

}

function load_user_details() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("user-details-area").innerHTML = text;
        }
    }
    r.open("POST", "load-user-details.php", true);
    r.send();

}

function update_user_details() {
    var first_name = document.getElementById("st_fst_name");
    var last_name = document.getElementById("st_lst_name");
    var email = document.getElementById("st_email");
    var mobile = document.getElementById("st_mobile");
    var password = document.getElementById("st_password");
    var address_01 = document.getElementById("st_address_1");
    var address_02 = document.getElementById("st_address_2");
    var city = document.getElementById("st_city");

    var form = new FormData();
    form.append("first_name", first_name.value);
    form.append("last_name", last_name.value);
    form.append("email", email.value);
    form.append("mobile", mobile.value);
    form.append("password", password.value);
    form.append("address_01", address_01.value);
    form.append("address_02", address_02.value);
    form.append("city", city.value);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "ur") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Name!",
                });
            } else if (text == "mr") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Number!",
                });
            } else if (text == "er") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Mobile Email Address!",
                });
            } else if (text == "ar1") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 1!",
                });
            } else if (text == "ar2") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Address Line 2!",
                });
            } else if (text == "pw") {
                swal({
                    icon: "error",
                    title: "Error!",
                    text: "Please Enter Password!",
                });
            } else {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Updated",
                    })
                    .then(() => {
                        load_user_details();
                    });
            }
        }
    }
    r.open("POST", "update-user-details.php", true);
    r.send(form);
}

function log_out() {
    swal("Are you sure?", {
            icon: "warning",
            dangerMode: true,
            buttons: true,
        })
        .then((willDelete) => {

            if (willDelete) {
                go_to_signin();
                var r = new XMLHttpRequest();
                r.onreadystatechange = function() {
                    if (r.readyState == 4) {
                        var text = r.responseText;
                    }
                }
                r.open("POST", "log-out.php", true);
                r.send();
            }

        });
}

function go_to_signin() {
    window.location = "sign-in.php";
}

function load_results() {
    var subject = document.getElementById("st_subject_s");
    var grade = document.getElementById("st_grade_s");

    var form = new FormData();
    form.append("subject", subject.value);
    form.append("grade", grade.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("result-area").innerHTML = text;
        }
    }
    r.open("POST", "load-results.php", true);
    r.send(form);
}

function load_results_ac() {
    var subject = document.getElementById("st_subject_s_ac");
    var grade = document.getElementById("st_grade_s_ac");

    var form = new FormData();
    form.append("subject", subject.value);
    form.append("grade", grade.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("result-area").innerHTML = text;
        }
    }
    r.open("POST", "load-results-ac.php", true);
    r.send(form);
}

function load_results_tec() {
    var subject = document.getElementById("st_subject_s_tec");
    var grade = document.getElementById("st_grade_s_tec");

    var form = new FormData();
    form.append("subject", subject.value);
    form.append("grade", grade.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            document.getElementById("result-area").innerHTML = text;
        }
    }
    r.open("POST", "load-results-tec.php", true);
    r.send(form);
}

function release_marks(assignment_id) {
    var assignment_id = assignment_id;

    var form = new FormData();
    form.append("assignment_id", assignment_id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            load_results_ac();
        }
    }
    r.open("POST", "release-marks.php", true);
    r.send(form);
}

function add_marks(assignment_id) {
    var assignment_id = assignment_id;
    var marks = document.getElementById("ass_marks_add");

    var form = new FormData();
    form.append("assignment_id", assignment_id);
    form.append("marks", marks.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "ok") {
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Added",
                    })
                    .then(() => {
                        load_results_tec();
                    });
            }
        }
    }
    r.open("POST", "add-marks.php", true);
    r.send(form);
}

function enroll() {
    paypal.Buttons({
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '11.00'
                    }
                }]
            });
        },

        onApprove: (data, actions) => {
            return actions.order.capture().then(function(orderData) {
                // Successful capture! For dev/demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                const transaction = orderData.purchase_units[0].payments.captures[0];
                // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                swal({
                        icon: "success",
                        title: "Success",
                        text: "Successfully Enrolled",
                    })
                    .then(() => {
                        updateEnroll();
                    });
            });
        }
    }).render('#paypal-button-container');
}

function updateEnroll() {

    var r = new XMLHttpRequest();
    r.onreadystatechange = function() {
        if (r.readyState == 4) {
            var text = r.responseText;
            if (text == "ok") {
                window.location = "index.php";
            }
        }
    }
    r.open("POST", "update-enroll.php", true);
    r.send();

}