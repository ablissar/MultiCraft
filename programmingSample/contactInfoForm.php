<html>
    <title>Contact Info Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>Contact Info Form</h1>
        <div>
        <form action="database.php" method="post" name="form" >
            <label> Phone Number: </label> <br /> <input type="text" name="phone" /> <br />
            <label> Address: </label> <br />
            Street/Apartment: <br /> <input type="text" name="address1" /> <br />
            City: <br /> <input type="text" name="address2" /> <br />
            State: <br /> <input type="text" name="address3" /> <br />
            Zip Code: <br /> <input type="text" name="address4" /> <br />
            <input type="submit" value="Submit" />
            <input type="button" onclick="location.href='userInfoForm.php';" value="Go Back" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
