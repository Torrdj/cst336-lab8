<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>AJAX: Sign Up Page</title>

        <link href="styles.css" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <script>
        
            function validateForm() {
                
                return false;
           
            }
            
        </script>
        
        <script>
            
            $(document).ready( function(){
                $("#username").change(function()
                {
                    $.ajax({

                        type: "GET",
                        url: "checkUsername.php",
                        dataType: "json",
                        data: { "username": $("#username").val()   },
                        success: function(data,status) {
                            if (!data)
                            {
                                document.getElementById("username").style.borderColor = 'green';
                                $("#isok").html("Available");
                                $("#isok").attr("style", "color:green");
                                $("#username").attr("style", "color:green");
                            }
                            else
                            {
                                document.getElementById("username").style.borderColor = 'red';
                                $("#isok").html("Unavailabale");
                                $("#isok").attr("style", "color:red");
                                $("#username").attr("style", "color:red");
                            }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                });
                
                $("#state").change(function() {
                    //alert($("#state").val());
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/countyList.php",
                        dataType: "json",
                        data: { "state": $("#state").val()},
                        success: function(data,status) {
                          
                        //   alert(data[0].county);
                        $("#county").html("<option> - Select One -</option>");
                        for(var i = 0; i < data.length; i++){
                             $("#county").append("<option>" + data[i].county + "</option>");
                        }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                    
                    });//ajax
                    
                    
                    
                });
                
                $("#zipCode").change( function(){  
                    
                    //alert( $("#zipCode").val() );  
                    
                    $.ajax({

                        type: "GET",
                        url: "http://itcdland.csumb.edu/~milara/ajax/cityInfoByZip.php",
                        dataType: "json",
                        data: { "zip": $("#zipCode").val()   },
                        success: function(data,status) {
                          
                          if (data)
                          {
                              document.getElementById("zipCode").style.borderColor = 'green';
                              $("#zip").html("");
                              $("#city").html(data.city);
                              $("#latitude").html(data.latitude);
                              $("#longitude").html(data.longitude);
                              $("#zipCode").attr("style", "color:green");
                          }
                          else
                          {
                            document.getElementById("zipCode").style.borderColor = 'red';
                            $("#zip").html("Zip code not found");
                            $("#zip").attr("style", "color:red");
                            $("#city").html("");
                            $("#latitude").html("");
                            $("#longitude").html("");
                            $("#zipCode").attr("style", "color:red");
                          }
                        
                        },
                        complete: function(data,status) { //optional, used for debugging purposes
                        //alert(status);
                        }
                        
                    });//ajax
                    
                    
                    
                } );
                
                $("#submit").click(function()
                {
                    if ($("#pass1").val() == $("#pass2").val())
                    {
                        $("#passspan").html("");
                        document.getElementById("pass2").style.borderColor = 'green';
                        $("#pass2").attr("style", "color:green");
                    }
                    else
                    {
                        $("#passspan").html("Should be the same password");
                        $("#passspan").attr("style", "color:red");
                        document.getElementById("pass2").style.borderColor = 'red';
                        $("#pass2").attr("style", "color:red");
                    }
                });
                
            }   ); //documentReady
            
            
            
        </script>

    </head>

    <body>
    
       <h1> Sign Up Form </h1>
    
        <form onsubmit="return validateForm()">
            <fieldset>
               <legend>Sign Up</legend>
                First Name:  <input type="text"><br> 
                Last Name:   <input type="text"><br> 
                Email:       <input type="text"><br> 
                Phone Number:<input type="text"><br><br>
                Zip Code:    <input type="text" id="zipCode"> <span id="zip"></span><br>
                City:        <span id="city"></span>
                <br>
                Latitude:    <span id="latitude"></span>
                <br>
                Longitude:   <span id="longitude"></span>
                <br><br>
                State: 
                <select id="state">
                    <option value="">Select One</option>
                    <option value="ca"> California</option>
                    <option value="ny"> New York</option>
                    <option value="tx"> Texas</option>
                    <option value="va"> Virginia</option>
                </select><br />
                
                Select a County: <select id="county"></select><br>
                
                
                Desired Username: <input type="text" id = "username"> <span id="isok"></span><br>
                
                Password: <input type="password" id="pass1"><br>
                
                Type Password Again: <input type="password" id="pass2"> <span id="passspan"></span><br>
                
                <input type="submit" value="Sign up!" id="submit">
            </fieldset>
        </form>
    
    </body>
</html>