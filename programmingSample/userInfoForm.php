<html>
    <title>Basic Info Form</title>
    <head>
        <link rel="stylesheet" type="text/css" href="formStyle.css">
    </head>
    <body>
        <h1>Basic Info Form</h1>
        <div>
        <form action="contactInfoForm.php" method="post" name="form" >
            <label> Email: </label> <br /> <input type="email" name="email" /> <br />
            <label> Name: </label> <br /> <input type="text" name="name" /> <br />
            <label> Gender: </label> <br />
            Male: <input type="radio" name="gender" value="Male" />
            Female: <input type="radio" name="gender" value="Female"  />
            Other: <input type="radio" name="gender" value="Other"  /> <br />
            <label> Birthdate: </label> <br /> <input type="text" name="birthdate" /> <br />
            <input type="submit" value="Submit" />
            <input type="button" onclick="location.href='form.php';" value="Go Back" />
            <input type="reset"  />
        </form>
        </div>
    </body>
</html>
