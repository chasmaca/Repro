

<html>
<head>
<style type="text/css">
@import url(https://fonts.googleapis.com/css?family=Lato:400,700);
ul {
  list-style-type: none;
}

body,
a,p,
ul,
li {
  padding: 0;
  margin: 0;
}
body{
  font-family: 'Lato', sans-serif;
}

#wrapper {
  top: 0px;
  z-index: 10;
  background: url("https://images.unsplash.com/photo-1417353783325-14cb8f9ba1dd?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&s=42734fb16139f1c8ba236412be723f9c") center no-repeat;
  background-size: cover;
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-filter: grayscale(100%);
  /* Chrome, Safari, Opera */
  filter: grayscale(100%);
}

#wrapper:after {
  content: '';
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.7);
}

ul#page {
  width: 960px;
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 999;
  transform: translate(-50%, -50%);
}

ul#page li {
  float:left;
  width: 450px;
  margin-left: 15px;
  
}

ul#page li#right img#logo {
 display:block;
  margin:auto;
}


ul#page li a {
  display: inline-block;
  margin-left:10px;
}

ul#page li a img {
  width: 150px;
  transition: all 300ms ease-in-out;
}

ul#page li a:hover img {
  transform: scale(1.2);
}

p{
  color:#fff;
  margin-top:85px;
  font-size:30px;
  line-height:40px;
  text-align:center;
  
}
.badges{
  position:absolute;
  bottom:0px;
}
 


.btn {
  box-sizing: border-box;
  display: inline-block;
  text-align: left;
  white-space: nowrap;
  text-decoration: none;
  vertical-align: middle;
  -ms-touch-action: manipulation;
      touch-action: manipulation;
  cursor: pointer;
  -webkit-user-select: none;
     -moz-user-select: none;
      -ms-user-select: none;
          user-select: none;
  border: 1px solid #ddd;
  padding: 4px 8px;
  margin: 5px auto;
  border-radius: 4px;
  color: #fff;
  fill: #fff;
  background: #000;
  line-height: 1em;
  min-width: 140px;
  height: 45px;
  -webkit-transition: 0.2s ease-out;
  transition: 0.2s ease-out;
  box-shadow: 0 1px 2px rgba(0,0,0,0.2);
  -webkit-tap-highlight-color: rgba(0,0,0,0);
  font-family: $btn-font;
  font-weight: 500;
  text-rendering: optimizeLegibility;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -moz-font-feature-settings: 'liga', 'kern';
}
.btn:hover,
.btn:focus {
  background: #111;
  color: #fff;
  fill: #fff;
  border-color: #fff;
  -webkit-transform: scale(1.01) translate3d(0, -1px, 0);
          transform: scale(1.01) translate3d(0, -1px, 0);
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}
.btn:active {
  outline: 0;
  background: #353535;
  -webkit-transition: none;
  transition: none;
}
.btn__icon,
.btn__text,
.btn__storename {
  display: inline-block;
  vertical-align: top;
}
.btn__icon {
  width: 30px;
  height: 30px;
  margin-right: 5px;
  margin-top: 2px;
}
.btn__icon--amazon {
  -webkit-transform: scale(0.85);
          transform: scale(0.85);
}
.btn__text {
  letter-spacing: 0.08em;
  margin-top: -0.1em;
  font-size: 10px;
}
.btn__storename {
  display: block;
  margin-left: 38px;
  margin-top: -17px;
  font-size: 22px;
  letter-spacing: -0.03em;
}
.btn--small {
  padding: 2px 8px;
  min-width: 118.75px;
  height: 24px;
  border-radius: 3px;
}
.btn--small .btn__icon {
  width: 16px;
  height: 16px;
  margin: 1px 2px 0 0;
}
.btn--small .btn__text {
  display: none;
}
.btn--small .btn__storename {
  font-size: 12px;
  display: inline-block;
  margin: 0;
  vertical-align: middle;
}
.btn--tiny {
  padding: 3px;
  width: 22px;
  height: 22px;
  min-width: 0;
  border-radius: 3px;
}
.btn--tiny .btn__icon {
  width: 14px;
  height: 14px;
  margin: 0;
}
.btn--tiny .btn__text,
.btn--tiny .btn__storename {
  display: none;
}


@media screen and (max-width:560px) {
	ul#page {
		width: 320px;
	}

	ul#page li{
        display:block;
		width:320px;
		float:none;
	}
  
	ul#page li#left img {
    	width:280px;
   		margin:auto;
	}

	p{
		color:#fff;
		margin-top:15px;
		font-size:15px;
		line-height:30px;
		text-align:center;
		margin-bottom:60px;
	}

	.btn__storename {
		font-size: 16px;
	}
}

		</style>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		
	</head>
	<body>
		<div id="wrapper">
		</div>
		<ul id="page">
			<li id="right">
				<img id="logo" src="images/logo_enea.gif" alt="Reprografía"/>
				<p>
					Como siempre, estamos trabajando en mejorar su satisfaccion de usuario.
					A partir de estos momentos, habilitaremos el servicio en http://www.elpartedigital.com/.
					En breves momentos, ser&aacute; redireccionado a nuestra nueva web.
				</p>
				<div class="badges">
				</div>
	         </li>
		</ul>
<script>
$( document ).ready(function() {

	URL = "http://www.elpartedigital.com";
	var delay = 5000; 
	setTimeout(function(){ window.location = URL; }, delay);
	
//	window.location.replace("http://www.elpartedigital.com").delay( 500 );
});
</script>
	</body>         
</html>
