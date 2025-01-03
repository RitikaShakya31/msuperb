<!DOCTYPE html>
<html lang="en">
  <head>
    <title>404 Not Found Page</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="styles.css" />
    <style>
    body{
    margin:0;
    padding:0;
    height:100vh;
  background-image: linear-gradient(to top, #2e1753, #1f1746, #131537, #0d1028, #050819);
    display:flex;
    justify-content:center;
    align-items:center;
    overflow:hidden;
  }
     .center {
    align-items: center;
    display: flex;
    justify-content: center;
    height: 100%;
    max-width: 50em;
    margin: 0 auto;
  }
  
  .error {
    text-align: center;
  }
  
  .error__title {
    background: linear-gradient(#00bcd4, #9575cd);
    -webkit-background-clip: text;
            background-clip: text;
    font-family: "Montserrat";
    font-size: 50px;
    font-weight: 200;
    margin: 0;
    -webkit-text-fill-color: transparent;
  }
  .error__type {
    color: #fff;
    font-weight: 600;
    font-size: 2.75rem;
    letter-spacing: 0.125em;
    margin: 0;
    text-transform: uppercase;
  }
  .error__cta {
    color: #fff;
    font-family: "Source Sans Pro";
    font-size: 1.25rem;
    font-weight: 300;
    line-height: 2;
  }
  .error__link {
    color: #fff;
    padding: 0.25em 0.5em;
    text-decoration: none;
    white-space: nowrap;
  }
  .error__link--purple {
    background: #9575cd;
  }
  .error__link--blue {
    background: #00bcd4;
  }
  
  .star{
    position:absolute;
    width:2px;
    height:2px;
    background:#fff;
    right:0;
    animation:starTwinkle 3s infinite linear;
  }
  
  .astronaut img{
    width:100px;
    position:absolute;
    top:55%;
    animation:astronautFly 6s infinite linear;
  }
  
  @keyframes astronautFly{
    0%{
      left:-100px;
    }
    25%{
      top:50%;
      transform:rotate(30deg);
    }
    50%{
      transform:rotate(45deg);
      top:55%;
    }
    75%{
      top:60%;
      transform:rotate(30deg);
    }
    100%{
      left:110%;
      transform:rotate(45deg);
    }
  }
  
  @keyframes starTwinkle{
    0%{
       background:rgba(255,255,255,0.4);
    }
    25%{
      background:rgba(255,255,255,0.8);
    }
    50%{
     background:rgba(255,255,255,1);
    }
    75%{
      background:rgba(255,255,255,0.8);
    }
    100%{
      background:rgba(255,255,255,0.4);
    }
  }
  
  @media (max-width: 40em) {
    .error__title {
      font-size: 30px;
    }
    .error__type {
      font-size: 30px;
    }
    .error__cta {
      font-size: 1rem;
    }
      
  }
    </style>

  </head>
  <body>
  <div class="center">
  <section class="error">    
  	<img style="margin-top:50px;" width="400" src="<?= base_url() ?>assets/images/logo.png" alt="SVGH logo">
    <!--<img src="logo.png" alt="click for HOME page">-->
    <h1 class="error__title">404</h1>
    <h2 class="error__type">Page not found</h2>
   <p class="error__cta">We’re sorry, <br>  the page you have looked for does not exist <br> in our database! <br> Maybe go to our  <a class="error__link error__link--purple" href="#" target="_blank">home</a> <br> or try to use a <a class="error__link error__link--blue" href="#" target="_blank">explore our product</a></p>
  </section>
</div>
<!--<button><img src="" alt=""></button>-->
<!--<div class="astronaut">-->
<!--  <img src="https://images.vexels.com/media/users/3/152639/isolated/preview/506b575739e90613428cdb399175e2c8-space-astronaut-cartoon-by-vexels.png" alt="" class="src">-->
<!--</div>-->
<script src="script.js"></script>
<script>document.addEventListener("DOMContentLoaded",function(){

    var body=document.body;
     setInterval(createStar,100);
     function createStar(){
       var right=Math.random()*500;
       var top=Math.random()*screen.height;
       var star=document.createElement("div");
    star.classList.add("star")
     body.appendChild(star);
     setInterval(runStar,10);
       star.style.top=top+"px";
     function runStar(){
       if(right>=screen.width){
         star.remove();
       }
       right+=3;
       star.style.right=right+"px";
     }
     }
   })</script>
  </body>
</html>