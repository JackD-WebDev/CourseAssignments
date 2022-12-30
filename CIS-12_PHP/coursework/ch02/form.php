<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Simple HTML Form</title>
    <style>
        label {
            font-weight: bold;
            color: #300ACC;
        }
    </style>
</head>
<body>
<!-- CSC-12.43560 Jack Daly 🥷 Updated 03/04/22 -->
<form action="handle_form.php"
      method="post">

    <fieldset>
        <legend>
            Enter your information in the form below:
        </legend>
        <p>
            <label>
                Name: <input type="text"
                             name="name"
                             size="20"
                             maxlength="40">
            </label>
        </p>
        <p>
            <label>
                Email Address: <input type="email"
                                      name="email"
                                      size="40"
                                      maxlength="60">
            </label>
        </p>
        <p>
            <label for="gender">
                Gender: <input type="radio"
                               name="gender"
                               value="M"> Male
                        <input type="radio"
                               name="gender"
                               value="F"> Female
            </label>
        </p>
        <p>
            <label>
                Age:
                <select name="age">
                    <option value="0-29">Under 30</option>
                    <option value="30-60">Between 30 and 60</option>
                    <option value="60+">Over 60</option>
                </select>
            </label>
        </p>
        <p>
            <label>Comments: <textarea name="comments"
                                    rows="3"
                                    cols="40"></textarea>
            </label>
        </p>
    </fieldset>
    <p>
        <input type="submit"
               name="submit"
               value="Submit My Information">
    </p>

</form>

</body>
</html>