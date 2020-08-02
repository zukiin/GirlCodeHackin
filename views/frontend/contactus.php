<!DOCTYPE html>
<html lang="en">
    <?php require_once dirname(__FILE__,2). '/universal/signedout/header.php';?>

    <head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
.fa {
            padding: 10px;
            font-size: 20px;
            width: 30px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
            float: right;
        }
        
        .fa:hover {
            opacity: 0.7;
        }
        
        .fa-facebook {
            background: #3B5998;
            color: white;
        }
        
        .fa-twitter {
            background: #55ACEE;
            color: white;
        }
        
        .fa-linkedin {
            background: #007bb5;
            color: white;
        }
        
        .fa-youtube {
            background: #bb0000;
            color: white;
        }
        
        .fa-instagram {
            background: #125688;
            color: white;
        }

</style>
</head>

    <body style="background-color:white;">
        <?php require_once dirname(__FILE__,2). '/universal/signedout/navigation.php';?>

        <p style="text-align: right;">
            Follow Us <br/>
            <!-- Add font awesome icons -->
                <a href="https://www.facebook.com/bongy.dubeeh.7" class="fa fa-facebook"></a>
                <a href="https://twitter.com/kween_Bex?s=09S" class="fa fa-twitter"></a>
                <a href="https://www.linkedin.com/in/thobeka-zuki-nkalitshana-6b855759" class="fa fa-linkedin"></a>
                <a href="https://www.instagram.com/kween.bex" class="fa fa-instagram"></a>
        </p>
        

            <h1>Contact Us</h1>
            <h4><i>Want to know more about us? Give us a shout.</i></h4>

            <div class="container">
                <form action="/action_page.php">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" name="firstname" placeholder="Your name..">

                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" name="lastname" placeholder="Your last name..">

                    <label for="province">Province</label>
                    <select id="province" name="province">
                <option value="kwazulu-natal">KwaZulu-Natal</option>
                <option value="freestate">FreeState</option>
                <option value="gauteng">Gauteng</option>
                <option value="mpumalanga">Mpumalanga</option>
                <option value="easterncape">EasternCape</option>
                <option value="northerncape">NorthernCape</option>
                <option value="westerncape">WestenCape</option>
                <option value="northwest">NorthWest</option>
                <option value="limpopo">Limpopo</option>
              </select>

                    <label for="subject">Subject</label>
                    <textarea id="subject" name="subject" placeholder="Have any questions or would like to set up appointments.We would love to hear from you" style="height:200px"></textarea>

                    <input type="submit" value="Submit">
                </form>
            </div>

        <style>
          * {
        box-sizing: border-box;
    }
    
    input[type=text],
    select,
    textarea {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-top: 6px;
        margin-bottom: 16px;
        resize: vertical;
    }
    
    input[type=submit] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    
    input[type=submit]:hover {
        background-color: #45a049;
    }
    
    .container {
        border-radius: 5px;
        background-color: #f2f2f2;
        padding: 20px;
    }

    .fa {
            padding: 10px;
            font-size: 20px;
            width: 30px;
            text-align: center;
            text-decoration: none;
            margin: 5px 2px;
        }
        
        .fa:hover {
            opacity: 0.7;
        }
        
        .fa-facebook {
            background: #3B5998;
            color: white;
        }
        
        .fa-twitter {
            background: #55ACEE;
            color: white;
        }
        
        .fa-linkedin {
            background: #007bb5;
            color: white;
        }
        
        .fa-youtube {
            background: #bb0000;
            color: white;
        }
        
        .fa-instagram {
            background: #125688;
            color: white;
        }
        </style>
        <?php require_once dirname(__FILE__,2). '/universal/signedout/footer.php';?>
    </body>
</html>