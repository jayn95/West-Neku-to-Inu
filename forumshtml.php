<!DOCTYPE html>
<html>
<head>
    <title>West Neko to Inu Forum Prototype</title>
    <link rel="stylesheet" type="text/css" href="forumscss.css">
</head>
<body>
    <div class="header">
        <h1>West Neko to Inu!</h1>
    </div>
    <div class="welcome">
        <h1>Hi Taga-West! Welcome to our Forum!</h1>
        <form action="phpcon.php" method="post"> <!-- Changed action to "con.php" to submit form data to the PHP script -->
            <div class="subject">
                <label for="subject">Subject:</label><br>
                <textarea id="subject" name="subject"></textarea>
            </div>
            <div class="textbody">
                <label>Body:</label><br>
                <textarea placeholder="Thoughts, comments, suggestions...." id="content" name="content"></textarea> <!-- Changed name attribute to "content" to match PHP script -->
            </div>
            <div class="submit">
                <button type="submit">Submit</button> <!-- Added type="submit" to the button to submit the form -->
            </div>
        </form>
    </div>
</body>
</html>
