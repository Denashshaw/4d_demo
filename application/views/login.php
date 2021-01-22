<!DOCTYPE html>
<html lang="en">
<head>
  <title>4D Global-CRM</title>
  <meta name="description" content="HRMS" />
  <meta name="keywords" content="" />
  <meta name="robots" content="index, follow"> 
  <!-- <link rel="canonical" href="#" /> -->
  <meta property="og:title" content="HRMS" />
  <meta property="og:type" content="website" />
  <!-- <meta property="og:url" content="#" /> -->
  <meta property="og:image" content="og.png" />
  <!--<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>-->  
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/theme.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>css/jquerysctipttop.css" type="text/css">
  <!-- <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" type="text/css"> -->

  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="<?php echo base_url();?>js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>js/popper.min.js"></script>
  <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>

  <script src="<?php echo base_url();?>js/slim.min.js"></script>
  <!-- <script src="<?php echo base_url();?>js/popper.min.js"></script> -->
  <script src="<?php echo base_url();?>js/BsMultiSelect.js"></script>
</head>

<style type="text/css">
html{
  background-color: #56baed;
}

body{
  font-family: "Poppins", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  font-family: 'Montserrat', sans-serif;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}

/* TABS */
h2.inactive {
  color: #cccccc;
}
h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}

/* FORM TYPOGRAPHY*/
input[type=button],input[type=submit],input[type=reset]{
  background-color: #5c7cdc;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  font-weight: 500;
  font-family: 'Montserrat', sans-serif;
  border-radius: 45px 45px 45px 45px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #3fc98e;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type=text],input[type=password] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-family: 'Montserrat', sans-serif;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type=text]:focus,input[type=password]:placeholder {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder,input[type=password]:placeholder {
  color: #cccccc;
}


/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@-moz-keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
@keyframes fadeIn { from { opacity:0; } to { opacity:1; } }

.fadeIn {
  opacity:0;
  -webkit-animation:fadeIn ease-in 1;
  -moz-animation:fadeIn ease-in 1;
  animation:fadeIn ease-in 1;

  -webkit-animation-fill-mode:forwards;
  -moz-animation-fill-mode:forwards;
  animation-fill-mode:forwards;

  -webkit-animation-duration:1s;
  -moz-animation-duration:1s;
  animation-duration:1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}


/* OTHERS */
*:focus{
  outline: none;
} 
#icon{
  width:60%;
}
.footer_text{
  color:#114c92 !important;
}

@media only screen and (max-width: 1024px){
  body{
    height: auto !important;
  }
}
@media only screen and (max-width: 425px){
  body{
    height: auto !important;
  }
}
.client_dd{
  width:85%;
  margin:1% 0px 2% 8%;
}
.custom-control{
  background-color: #f6f6f6 !important;
  font-size: 14px !important;

}
.clitxt{
  font-family: 'Montserrat', sans-serif;  
}
</style>

<body>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <!-- Icon -->
    <div class="fadeIn first">
     <img style="padding:20px 0;" src="<?php echo base_url();?>img/logo.jpg">
    </div>

    <!-- Login Form -->
    <?php if($errors != ""){ echo $errors;} ?>
    <form method="post" action="<?php echo base_url();?>login/index">
      <p id="err"></p>
      <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username" required="">
      <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password" required="">
      <!-- <input type="submit" name="verify" class="fadeIn fourth" value="Log In" id="verify"> -->
      <input type="text" name="captcha" class="fadeIn fourth" placeholder="Captcha" id="cpatchaTextBox" onChange="checkCaptcha();" required="" autocomplete="off"/><br>
      <input type="hidden" name="oriCaptcha" id="oriCaptcha">
      <span id="captcha" style=""></span>

      <div id="captchaValidate"></div>
      <input type="submit" name="login" class="fadeIn fourth" value="Log In" id="login" >
    </form>

  </div>
</div>


</body>
<!-- <script type="text/javascript" src="<?php echo base_url();?>js.js"></script> -->
<script>$("select").bsMultiSelect();</script>


<script type="text/javascript">
var captcha;
 $(document).ready(function(){
  createCaptcha();
  $('#login').hide();
 });
  

$("#cpatchaTextBox").keyup(checkCaptcha);

function checkCaptcha(){
  var captcha_text   = $("#cpatchaTextBox").val();
  if(captcha_text != code){
    $('#oriCaptcha').val(code);
    $("#captchaValidate").html("Captcha did't match!");
    $("#captchaValidate").css({"color":"red"});
    $('#login').hide();
  }
  else{
    $("#captchaValidate").html("Captcha Match.");
   $("#captchaValidate").css({"color":"green"});
    $('#login').show();
  }
}

var code;
function createCaptcha() {
  //clear the contents of captcha div first 
  document.getElementById('captcha').innerHTML = "";
  var charsArray = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
  var lengthOtp  = 6;
  var captcha    = [];
  for(var i = 0; i < lengthOtp; i++){
    //below code will not allow Repetition of Characters
    var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
    if(captcha.indexOf(charsArray[index]) == -1)
      captcha.push(charsArray[index]);
    else i--;
  }
  var canv = document.createElement("canvas");
  canv.id = "captcha";
  canv.width  = 100;
  canv.height = 50;
  var ctx = canv.getContext("2d");
  ctx.font = "25px Georgia";
  ctx.strokeText(captcha.join(""), 0, 30);
  //storing captcha so that can validate you can save it somewhere else according to your specific requirements
  code = captcha.join("");
  document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}
</script>
</html>