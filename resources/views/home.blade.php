@extends('master')

@section('contenido')
<div class="wrapper">
	{{-- <div class="container-fluid text-center"> <br><br> --}}
	<div class="container-fluid text-center"><br><br>	
		<label><h4 class="sombra">Bienvenidos a</h4></label><br>
		<label><h1><b class="sombra">Encuestas Carozzi</b></h1></label>

		<div class="text-center"><br><br><br><br>
			<img style="width: 200px" src="https://www.carozzicorp.com/wp-content/themes/carozzi/img/logo_red.png?v=2" alt="">
		</div>
	</div>
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
	</div>
@endsection
<style>
	.sombra{	
		font-size:50px;
		color: white; text-shadow: black 0.1em 0.1em 0.2em};
	}
	body {
	    height: 100% !important;
	    background-color: white;
	}
	* {
	  box-sizing: border-box;
	  margin: 0;
	  padding: 0;
	  font-weight: 300;
	  font-family: 'Source Sans Pro', sans-serif;
	  color: white;
	}
	.wrapper {
		background: #e3e4e5;
        background: linear-gradient(to bottom right, #a9a9a9 0%, #d3d3d3 50%);
		/*background: linear-gradient(to top left, #ffcccc 0%, #ff5050 65%);*/
		/* background: linear-gradient(to bottom right, #800000  0%, #ff0000  100%);*/
	 /* background: #50a3a2;
	  background: linear-gradient(to bottom right, #50a3a2 0%, #53e3a6 100%);*/
	  position: absolute;
	 /* top: 50%;*/
	/*  left: 0;*/
	  width: 100%;
	  height: 91%;
/*	  margin-top: -200px;*/
	  overflow: hidden;
	}
	.wrapper.form-success .container-fluid h1 {
	  -webkit-transform: translateY(85px);
	          transform: translateY(85px);
	    
	}
	.container-fluid {
	  max-width:  100%;
	  margin: 0 auto;
	  padding: 80px 0;
	  height:  100%;
	  text-align: center;
	}
	.container-fluid h1 {
	  font-size: 40px;
	  transition-duration: 1s;
	  transition-timing-function: ease-in-put;
	  font-weight: 200;
	}
	.bg-bubbles {
	  position: absolute;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	  z-index: 1;
	}
	.bg-bubbles li {
	  position: absolute;
	  list-style: none;
	  display: block;
	  width: 40px;
	  height: 40px;
	  background-color: rgba(255, 255, 255, 0.15);
	  bottom: -160px;
	  -webkit-animation: square 25s infinite;
	  animation: square 25s infinite;
	  transition-timing-function: linear;
	}
	.bg-bubbles li:nth-child(1) {
	  left: 10%;
	}
	.bg-bubbles li:nth-child(2) {
	  left: 20%;
	  width: 80px;
	  height: 80px;
	  -webkit-animation-delay: 2s;
	          animation-delay: 2s;
	  -webkit-animation-duration: 17s;
	          animation-duration: 17s;
	}
	.bg-bubbles li:nth-child(3) {
	  left: 25%;
	  -webkit-animation-delay: 4s;
	          animation-delay: 4s;
	}
	.bg-bubbles li:nth-child(4) {
	  left: 40%;
	  width: 60px;
	  height: 60px;
	  -webkit-animation-duration: 22s;
	          animation-duration: 22s;
	  background-color: rgba(255, 255, 255, 0.25);
	}
	.bg-bubbles li:nth-child(5) {
	  left: 70%;
	}
	.bg-bubbles li:nth-child(6) {
	  left: 80%;
	  width: 120px;
	  height: 120px;
	  -webkit-animation-delay: 3s;
	          animation-delay: 3s;
	  background-color: rgba(255, 255, 255, 0.2);
	}
	.bg-bubbles li:nth-child(7) {
	  left: 32%;
	  width: 160px;
	  height: 160px;
	  -webkit-animation-delay: 7s;
	          animation-delay: 7s;
	}
	.bg-bubbles li:nth-child(8) {
	  left: 55%;
	  width: 20px;
	  height: 20px;
	  -webkit-animation-delay: 15s;
	          animation-delay: 15s;
	  -webkit-animation-duration: 40s;
	          animation-duration: 40s;
	}
	.bg-bubbles li:nth-child(9) {
	  left: 25%;
	  width: 10px;
	  height: 10px;
	  -webkit-animation-delay: 2s;
	          animation-delay: 2s;
	  -webkit-animation-duration: 40s;
	          animation-duration: 40s;
	  background-color: rgba(255, 255, 255, 0.3);
	}
	.bg-bubbles li:nth-child(10) {
	  left: 90%;
	  width: 160px;
	  height: 160px;
	  -webkit-animation-delay: 11s;
	          animation-delay: 11s;
	}
	.bg-bubbles li:nth-child(11) {
	  left: 20%;
	  width: 80px;
	  height: 80px;
	  -webkit-animation-delay: 2s;
	          animation-delay: 2s;
	  -webkit-animation-duration: 17s;
	          animation-duration: 17s;
	}
	.bg-bubbles li:nth-child(12) {
	  left: 25%;
	  -webkit-animation-delay: 4s;
	          animation-delay: 4s;
	}
	.bg-bubbles li:nth-child(13) {
	  left: 40%;
	  width: 60px;
	  height: 60px;
	  -webkit-animation-duration: 22s;
	          animation-duration: 22s;
	  background-color: rgba(255, 255, 255, 0.25);
	}
	.bg-bubbles li:nth-child(14) {
	  left: 70%;
	}
	.bg-bubbles li:nth-child(15) {
	  left: 80%;
	  width: 120px;
	  height: 120px;
	  -webkit-animation-delay: 3s;
	          animation-delay: 3s;
	  background-color: rgba(255, 255, 255, 0.2);
	}
	.bg-bubbles li:nth-child(16) {
	  left: 32%;
	  width: 160px;
	  height: 160px;
	  -webkit-animation-delay: 7s;
	          animation-delay: 7s;
	}
	.bg-bubbles li:nth-child(17) {
	  left: 55%;
	  width: 20px;
	  height: 20px;
	  -webkit-animation-delay: 15s;
	          animation-delay: 15s;
	  -webkit-animation-duration: 40s;
	          animation-duration: 40s;
	}
	.bg-bubbles li:nth-child(18) {
	  left: 25%;
	  width: 10px;
	  height: 10px;
	  -webkit-animation-delay: 2s;
	          animation-delay: 2s;
	  -webkit-animation-duration: 40s;
	          animation-duration: 40s;
	  background-color: rgba(255, 255, 255, 0.3);
	}
	.bg-bubbles li:nth-child(19) {
	  left: 90%;
	  width: 160px;
	  height: 160px;
	  -webkit-animation-delay: 11s;
	          animation-delay: 11s;
	}
	.bg-bubbles li:nth-child(20) {
	  left: 90%;
	  width: 160px;
	  height: 160px;
	  -webkit-animation-delay: 11s;
	          animation-delay: 11s;
	}

	@-webkit-keyframes square {
	  0% {
	    -webkit-transform: translateY(0);
	            transform: translateY(0);
	  }
	  100% {
	    -webkit-transform: translateY(-700px) rotate(600deg);
	            transform: translateY(-700px) rotate(600deg);
	  }
	}
	@keyframes square {
	  0% {
	    -webkit-transform: translateY(0);
	            transform: translateY(0);
	  }
	  100% {
	    -webkit-transform: translateY(-700px) rotate(600deg);
	            transform: translateY(-700px) rotate(600deg);
	  }
	}
</style>
