<?php
function registermail($username, $password, $link)
{

    return '
  <html>

<body style="box-sizing: border-box; background: #ffffff;
background: linear-gradient(to bottom, #ffffff 0%,#e1e8ed 100%); height: 100%; margin: 0; background-repeat: no-repeat; background-attachment: fixed;
        background: url(backgroundimg.jpg);">

    <div class=content style=" @media (min-width:600px) {
    max-width: 1000px;
      margin: 0 auto;
    }">
        <div class="wrapper-1" style="width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);
    box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 0.2);
    height: initial;
        max-width: 620px;
        margin: 0 auto;
        margin-top: 50px;
  ">

            <div class="wrapper-2" style="padding: 30px;
      text-align: justify; background: #ffffff;
    background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);">

                <div style="display: block; text-align: center;">
                    <img src="' . base_url() . 'assets/images/logo.png" alt="SVGH Healthcare | Farm Fresh Product in Bhopal, Madhya Pradesh" style="height: 50px;">
                </div>
                <h1 style="font-family: Kaushan Script;
        font-size: 3.5rem;
        letter-spacing: 3px;
        color: #005b6a;
        margin: 0;
        margin-bottom: 30px;
        text-align: center;  @media (min-width:360px) {
       font-size: 3.5rem;
      }">Thank you !</h1>
                <h6 style="margin: 0;
        font-size: 1.3em;
        color: rgb(80, 79, 79);
        font-family: Source Sans Pro;
        letter-spacing: 1px;">Hey there! </h6><br>
                <p style="margin: 0;
        font-size: 1.3em;
        color: rgb(80, 79, 79);
        font-family: Source Sans Pro;
        letter-spacing: 1px;">We just Wanted to say Thanks for Being a Valued Member<br>
                    Please find the login credentials below <br>
                   <br>
  Your  Username is  - <span style=" color: #ffa800;
          font-weight: 700;">' . $username . '</span> <br>
  Your  Password is  - <span style=" color: #ffa800;
          font-weight: 700;">' . $password . '</span> <br>
                </p>
                <p> Click Here to login  - <a href="' . $link . '" style=" color: #ffa800;
          font-weight: 700;">' . $link . '</a></p>
                
                
                <br> <br>
                <div class="go-home" style="text-align: center !important;
        display: block !important;
        margin: 30px 0; @media (min-width:360px) {
      
        margin-bottom: 20px;
        margin-top: 30px;
     
    }">
                 
                </div>
            </div>
            <div class="footer-like" style=" margin-top: auto;
      background: #D7E6FE;
      padding: 6px;
      text-align: center;">
                <p style="margin: 0;
        padding: 4px;
        color: #5892FF;
        font-family: Source Sans Pro;
        letter-spacing: 1px;"> <a href="' . base_url() . '" style="text-decoration: none;
      color: #006573;
      font-weight: 600;">SVGH Healthcare | Farm Fresh Product in Bhopal, Madhya Pradesh</a>
                </p>
            </div>
        </div>
    </div>
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
</body>

</html>';
}


function checkoutmail($username, $orderId)
{

    return '
  <html>

<body style="box-sizing: border-box; background: #ffffff;
background: linear-gradient(to bottom, #ffffff 0%,#e1e8ed 100%); height: 100%; margin: 0; background-repeat: no-repeat; background-attachment: fixed;
        background: url(backgroundimg.jpg);">

    <div class=content style=" @media (min-width:600px) {
    max-width: 1000px;
      margin: 0 auto;
    }">
        <div class="wrapper-1" style="width: 100%;
    height: 100vh;
    display: flex;
    flex-direction: column;
    background: #ffffff;
    background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);
    box-shadow: 4px 8px 40px 8px rgba(88, 146, 255, 0.2);
    height: initial;
        max-width: 620px;
        margin: 0 auto;
        margin-top: 50px;
  ">

            <div class="wrapper-2" style="padding: 30px;
      text-align: justify; background: #ffffff;
    background: linear-gradient(to bottom, #ffffff 0%, #e1e8ed 100%);">

                <div style="display: block; text-align: center;">
                    <img src="' . base_url() . 'assets/images/logo.png" alt="SVGH Healthcare | Farm Fresh Product in Bhopal, Madhya Pradesh" style="height: 50px;">
                </div>
                <h1 style="font-family: Kaushan Script;
        font-size: 3.5rem;
        letter-spacing: 3px;
        color: #005b6a;
        margin: 0;
        margin-bottom: 30px;
        text-align: center;  @media (min-width:360px) {
       font-size: 3.5rem;
      }">Thank you !</h1>
                <h6 style="margin: 0;
        font-size: 1.3em;
        color: rgb(80, 79, 79);
        font-family: Source Sans Pro;
        letter-spacing: 1px;">Hey ' . $username . '! </h6><br>
                <p style="margin: 0;
        font-size: 1.3em;
        color: rgb(80, 79, 79);
        font-family: Source Sans Pro;
        letter-spacing: 1px;">
        
        
        We just Wanted to say Thanks for Being a Valued Customers<br>

          We Have Received Your Order. <br> Your Order ID is - <span style=" color: #ffa800;
          font-weight: 700;">' . $orderId . '</span> <br> Once Your Order Shiped,
          We will send you a message with a Tracking Number and Link to track it. <br>
           If you have any Questions, Drop us a note. We are here to help! 
         <br> <br> <div class="go-home" style="text-align: center !important;
        display: block !important; margin: 30px 0; @media (min-width:360px) {
      
        margin-bottom: 20px;
        margin-top: 30px;
     
    }">
                 
                </div>
            </div>
            <div class="footer-like" style=" margin-top: auto;
      background: #D7E6FE;
      padding: 6px;
      text-align: center;">
                <p style="margin: 0;
        padding: 4px;
        color: #5892FF;
        font-family: Source Sans Pro;
        letter-spacing: 1px;"> <a href="' . base_url() . '" style="text-decoration: none;
      color: #006573;
      font-weight: 600;">SVGH Healthcare | Farm Fresh Product in Bhopal, Madhya Pradesh</a>
                </p>
            </div>
        </div>
    </div>
  <link href="https://fonts.googleapis.com/css?family=Kaushan+Script|Source+Sans+Pro" rel="stylesheet">
</body>

</html>';
}
