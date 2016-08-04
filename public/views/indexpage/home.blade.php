<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/main.css">
<link rel="stylesheet" href="../../css/parsley.css">
	<meta charset="UTF-8">
	<title>Angular-Authetication</title>
    <base href="/">
</head>
<!--our module name-->
<body ng-app="authApp">

<!--nav-->
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" ui-sref="#">logo</a>
    </div>
    <ul class="nav navbar-nav">
        <li class="active"><a ui-sref="auth">Home</a></li>
        <li><a ui-sref="about">About Us</a></li>
        <li><a ui-sref="contact">Contact Us</a></li>
    </ul>
</nav>
<!--end of nav-->

	<div class="container">
	    <!--place to inject our views-->
		<div ui-view></div>
	</div>


    <hr>
    <p class="text-center">copyright 2016 epsotech solutions - All Rights Reserved</p>

    <script src="../../js/jquery-3.1.0.min.js"></script>
	<script src="http://code.angularjs.org/1.2.13/angular.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.13/angular-ui-router.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../js/angular-ui-router-grant.js" type="text/javascript" charset="utf-8"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-router/0.2.8/angular-ui-router.min.js"></script> -->
    <script src="//cdn.jsdelivr.net/satellizer/0.14.1/satellizer.min.js"></script>
    <script src="../../js/app.js"></script>
    <script src="../../js/authController.js"></script>
    <script src="../../controllers/registerController.js"></script>
     <script src="../../controllers/userController.js"></script>
    
</body>
</html>