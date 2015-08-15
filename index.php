<?php

$db_link = mysqli_connect("localhost", "cl47-octagondb", "BDBJE!crj", "cl47-octagondb");

if ($_POST["submit"]) {
    $error = "";
    $result = '<div class="alert alert-success">Message sent successfully!</div>';

    if (!$_POST['name']) {
        $error .= "<br/>Please enter your name!";
    }

    if (!$_POST['email']) {
        $error .= "<br/>Please enter your email!";
    }

    if (!$_POST['subject']) {
        $error .= "<br/>Please enter your subject!";
    }

    if (!$_POST['comment']) {
        $error .= "<br/>Please enter a comment!";
    }

    if ($_POST['email'] AND !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $error .= "<br/> Please enter a valid email address";
    }

    if (mysqli_connect_error()) {
        $error .= "<br/>Couldn't connect to database. Please try again later!";
    }

    $name = $_POST['name'];
    $email = $_POST['email'];

    $new_user_query = "INSERT INTO users (`name`, `email`) VALUES ('".mysqli_real_escape_string($db_link, $name)."', '".mysqli_real_escape_string($db_link, $email)."')";

    if (!mysqli_query($db_link, $new_user_query)) {
        $error .= "<br/>An internal error occurred! Please try again later!";
    }

    if ($error) {
        $result = '<div class="alert alert-danger"><strong><p class="lead">There were error(s) in your form: </p></strong>' . $error . '</div>';
    } else {
        $receiver = "sreeharsha11@gmail.com";
        $receiver2 = "tinooctagon@gmail.com";
        $subject = "Comment from Octagon Visitor: ".$_POST['name'];

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $body = "<html><body>";
        $body.= "<strong>Name:</strong> " . $_POST['name']."<br/>";
        $body.= "<br/><hr/><br/><strong>From:</strong> " . $_POST['email']."<br/>";
        $body.= "<br/><hr/><br/><strong>Subject:</strong> ".$_POST['subject']."<br/>";
        $body.= "<br/><hr/><br/><strong>Comment:</strong> ".$_POST['comment']."<br/>";
        $body.= "</body></html>";

        $headers.= "From: " . $_POST['email'];

        if (mail($receiver, $subject, $body, $headers) == 1 AND mail($receiver2, $subject, $body, $headers) == 1) {
            $result = "<div class='alert alert-success'><strong><p class='lead'>Thank you! <p></strong>We'll be in touch.</div>";
        } else {
            $result = "<div class='alert alert-success'><strong><p class='lead'>Sorry, there was an error sending your message. Please try again later.</p></strong></div>";
        }
    }
}

if ($_POST['submit2']) {
    $phoneNumber = "none";
    $error2 = "";
    $result2 = '<div class="alert alert-success">Registration Complete</div>';

    if (!$_POST['fname']) {
        $error2 .= "<br/>Please enter your first name!";
    }

    if (!$_POST['lname']) {
        $error2 .= "<br/>Please enter your last name!";
    }

    if (!$_POST['grade']) {
        $error2 .= "<br/>Please select your grade!";
    }

    if ($_POST["phone1"] AND $_POST["phone2"] AND $_POST["phone3"] AND !(ctype_digit($_POST["phone1"]) AND ctype_digit($_POST["phone2"]) AND ctype_digit($_POST["phone3"]))) {
        $error2 .= "<br/>Please enter a valid phone number!";
    } else {
        $phoneNumber = "1 (".$_POST['phone1'].") - ".$_POST['phone2']." - ".$_POST['phone3'];
    }

    if ($_POST['email2'] AND !filter_var($_POST['email2'], FILTER_VALIDATE_EMAIL)) {
        $error2 .= "<br/> Please enter a valid email address";
    }

    if (mysqli_connect_error()) {
        $error2 .= "<br/>Couldn't connect to database. Please try again later!";
    }

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $grade = $_POST['grade'];
    $email = $_POST['email2'];
    $phone = (int) "1".$_POST['phone1'].$_POST['phone2'].$_POST['phone3'];
    $comment = $_POST['concerns'];

    /*Event Tables:
         - deaf_people_event
         - stanford_concessions_event
    */

    $new_registrant_query = "INSERT INTO stanford_concessions_event (`fname`, `lname`, `grade`, `email`, `phone`, `comment`) VALUES ('".mysqli_real_escape_string($db_link, $fname)."', '".mysqli_real_escape_string($db_link, $lname)."', '".mysqli_real_escape_string($db_link, $grade)."', '".mysqli_real_escape_string($db_link, $email)."', '$phone', '".mysqli_real_escape_string($db_link, $comment)."')";

    if (!mysqli_query($db_link, $new_registrant_query)) {
        $error2 .= "<br/>An internal error occurred! Please try again later!";
    }

    if ($error2) {
        $result2 = '<div class="alert alert-danger"><strong><p class="lead">There were error(s) in your form: </p></strong>' . $error2 . '</div>';
    } else {
        $receiver = "sreeharsha11@gmail.com";
        $receiver2 = "tinooctagon@gmail.com";
        $subject2 = "Deaf People Event Registrant: ".$_POST['fname']." ".$_POST['lname'];

        $headers2  = 'MIME-Version: 1.0' . "\r\n";
        $headers2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $body2 = "<html><body>";
        $body2.= "<strong>Name:</strong> " . $_POST['fname']." ".$_POST['lname']."<br/>";
        $body2.= "<br/><hr/><br/><strong>From:</strong> " . $_POST['email2']."<br/>";
        $body2.= "<br/><hr/><br/><strong>Grade:</strong> ".$_POST['grade']."<br/>";
        $body2.= "<br/><hr/><br/><strong>Phone Number:</strong> ".$phoneNumber."<br/>";
        $body2.= "<br/><hr/><br/><strong>Comment:</strong> " . $_POST['concerns']."<br/>";
        $body2.= "</body></html>";

        $headers2.="From: " . $_POST['email2'];

        if (mail($receiver, $subject2, $body2, $headers2) == 1 AND mail($receiver2, $subject2, $body2, $headers2) == 1) {
            $result2 = "<div class='alert alert-success'><strong><p class='lead'>Registration Complete!<p></strong>We'll be in touch.</div>";
        } else {
            $result2 = "<div class='alert alert-success'><strong><p class='lead'>Sorry, there was an error in your registration. Please try again later.</p></strong></div>";
        }
    }


}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Tino Octagon</title>
    <!-- Bootstrap -->
    <link href="bootstrap-resources/css/bootstrap.min.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="social-likes/social-likes_classic.css">
</head>

<body data-spy="scroll" data-target=".navbar-collapse">
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav nav-pills nav-justified">
                    <li class="active"><a href="#home" id="scrolledToHome">Home</a></li>
                    <li><a href="#about" class="scrolledDown">About Us</a></li>
                    <li><a href="#clubinfo" class="scrolledDown">Club Info</a></li>
                    <li><a href="#contactinfo" class="scrolledDown">Contact</a></li>
                    <li><a href="#forms" class="scrolledDown">Forms</a></li>
                    <li>
                      <div class="dropdown">
                        <a id="dLabel" class="event-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          Events
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu scrollable-menu" aria-labelledby="dropdownMenu1" role="menu">
                          <li><a href="#events" style="background-image: url('images/navbar-bg.jpg'); color: white"><strong>Upcoming Events</strong></a>
                            <ul class="dropdown-sublist">
                              <li><a href="#events" style="color: black">Stanford Concessions</a></li>
                            </ul>
                          </li>
                          <li><a href="#pastEvents" style="background-image: url('images/navbar-bg.jpg'); color: white"><strong>Past Events</strong></a>
                            <ul class="dropdown-sublist">
                              <li><a href="#fiestaEducativa" style="color: black">2015 Freshman Orientation</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#cleanupDay" style="color: black">2015 Eisenhower Spring Movie Night</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#movieNight1" style="color: black">2015 Eisenhower Science Fair</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#movieNight1" style="color: black">2014 Clubs Day</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#halloweenCarnival" style="color: black">2014 Village School Halloween Carnival</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#movieNight1" style="color: black">2014 Eisenhower Fall Movie Night</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#movieNight1" style="color: black">2014 Coastal Creek Cleanup Day</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#movieNight1" style="color: black">2014 Fiesta Educativa</a></li>
                              <li role="separator" class="divider"></li>
                              <li><a href="#movieNight1" style="color: black">2013 M &amp; M Carwash</a></li>
                              <li role="separator" class="divider"></li>
                            </ul>

                          </li>

                        </ul>
                      </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container contentDiv">
        <div id="home">

            <h1 class="title" style="top: 150px"></h1>
            <h1 class="title2" style="top: 160px"></h1>
            <div class="jumbotron" id="titleJumbo">
                <h1>Join Tino Octagon!</h1>
                <h2>The Community Interactions Club!</h2>
                <p>Meetings are biweekly</p>

                <p>Wednesdays at lunch in Room 308</p>
                <div id="fb-root"></div>
                <div class="fb-like" data-href="http://176.32.230.17/saiwebdevdomain.com/php/tino-octagon-website/index.php" data-width="200px" data-layout="standard" data-action="like" data-show-faces="true" data-share="true"></div>
                <div class="social-likes">
                      <div class="twitter" title="Share on Twitter">Twitter</div>
                      <div class="plusone" title="Share on Google+">Google+</div>
                </div>
                <h3><strong>"Work locally, change globally"</strong></h3>

                <p><a class="btn btn-primary btn-lg" href="#clubinfo" id="learnMoreBtn" role="button">Learn more</a></p>
            </div>

        </div>
    </div>
    <div class="container contentDiv">
        <div id="about">
            <h1>About Us</h1>
            <ul id="officerList">
                <li>
                    <div id="officer1"></div>
                    <p class="lead name">Vallab Karanam</p>
                    <p class="lead position">Secretary</p>
                </li>
                <li>
                    <div id="officer2"></div>
                    <p class="lead name">Sai Sujit Madiraju</p>
                    <p class="lead position">Vice President</p>
                </li>
                <li>
                    <div id="officer3"></div>
                    <p class="lead name">Chaitanya Angadala</p>
                    <p class="lead position">Public Relations</p>
                </li>
            </ul>
            <ul id="officerList2">
                <li>
                    <div id="officer4"></div>
                    <p class="lead name">Yaswanth Vura</p>
                    <p class="lead position">President</p>
                </li>
                <li>
                    <div id="officer5"></div>
                    <p class="lead last1">Tejas Vasu</p>
                    <p class="lead positionLast1">Treasurer</p>
                </li>
                <li>
                    <div id="officer6"></div>
                    <p class="lead last2">Eric Shen</p>
                    <p class="lead positionLast2">Event Manager</p>
                </li>
            </ul>
            <div class="jumbotron about-jumbo">
                <h2>You can:</h2>
                <ul>
                    <li>
                        <p>Meet new people!</p>
                    </li>
                    <li>
                        <p>Meet new connections!</p>
                    </li>
                    <li>
                        <p>Strengthen your social skills by serving the community!</p>
                    </li>
                </ul>
                <p>High school division of Junior Optimist Octagon International (international organization)</p>
            </div>
            <div class="jumbotron about-jumbo2">
                <p>JOOI members represent the times well by making their communities better - one service project at a time. With more than 15,000 members in more than 500 communities, JOOI members are constant-working to promote positive change in their communities.</p>
                <p>- Adopted from JOOI Marketing</p>
            </div>
        </div>
    </div>
    <div class="container contentDiv2">
        <div id="clubinfo">
            <h1>Club Info</h1>
            <div id="infoAccordion">
                <h3>Member Qualifications</h3>
                <div>
                    <p class="lead">Qualifications to join our club are really simple. Students do not need a certain grade point average to join this club and no ASB membership as well. We request a donation of $5 from every member to create a well established financial ground for this years events. Money will be used for social events (free food at social events) and fundraisers such as carwashes and etc. In order to be an official member of the JOOI international organization, they request a mandatory payment of $5.00. (Only if students are planning to be enlisted in the international organization.)</p>
                </div>
                <h3>Membership Responsibilities</h3>
                <div>
                    <p class="lead">We request all members to show up to our meetings that take place every other Wednesday in Room 308 during lunch. Sometimes we will be giving out free food without prior notice. Students are expected to be on their best behaviors during all club meetings and events. We stress students need to be on their best behavior at all Tino Octagon events; they will be representing Cupertino High School and JOOI. Students who fail to meet the behavior responsibilities will be meeting with our club advisor and/or school office for consequences. This year we will be hosting events with other clubs on campus and with other clubs in the district and students need to represent Tino Octagon and CHS in a well­behaved manner. Last year, students were very disrespectful at club meetings, however this year students will be reported to club advisor if they are not on their best behavior during all club meetings.</p>
                </div>
                <h3>Presidential Award Info.</h3>
                <div>
                    <p class="lead">Presidential recognition sets you apart from your peers. It is a tremendous honor. Even though you may not seek recognition, your example can deliver a powerful message that encourages others to take action. The President's Volunteer Service Award recognizes United States citizens and lawfully admiited, permanent residents of the United States who have achieved the required number of hours of service over a 12-month time period or cumulative hours over the course of a lifetime. Along with the ultimate honor of presidential recognition, recipients will receive a personalized certificate, an official pin, medallion or coin, a congratulatory letter from the president of the United States for National and Community Service.</p>
                </div>
                <h3>Award Criteria</h3>
                <div>
                    <p class="lead"><strong>Individuals, families and groups that meet the criteria are eligible for the PVSA.</strong></p>
                    <ul>
                        <li>
                            <p class="lead">Recipient(s) must be a United States citizen or a lawfully admitted permanent resident of the United States.</p>
                        </li>
                        <li>
                            <p class="lead">Awards are issued for service hours served within a 12-month time period or over the course of a lifetime.</p>
                        </li>
                        <li>
                            <p class="lead">Awards are issued for volunteer service only; additional levels of participation with the organization (i.e. charitable support) are not a factor considered for the award.</p>
                        </li>
                        <li>
                            <p class="lead">Court-ordered community service does not qualify for the award.</p>
                        </li>
                        <li>
                            <p class="lead">Awards are issued by approved Certifying Organizations.</p>
                        </li>
                        <li>
                            <p class="lead">Service must be with an approved Certifying Organization that is legally established in the United States, the Commonwealth of Puerto Rico or one of the U.S. territories.</p>
                        </li>
                    </ul>
                </div>
                <h3>Award Eligibility</h3>
                <div>
                    <p class="lead">Hours are measured over a 12-month period and awards are designated based on cumulative hours. The awards are offered in multiple levels and are designed to recognize each milestone of your service achievement. Levels include bronze, silver, gold, and the highest honor, the President's Lifetime Achievement Award for those who contribute more than 4,000 hours of service in their lifetime.</p>
                    <img src="images/eligibility.png" width="500" height="400" />
                </div>
            </div>
        </div>
    </div>
    <div class="container contentDiv2">
        <div id="contactinfo">
            <h1>Contact Us</h1>
            <div class="row">
                <div class="col-md-6 col-md-offset-3 emailForm">
                    <?php echo $result; ?>
                    <p class="lead center">Contact us at tinooctagon@gmail.com</p>
                    <form method="post">
                        <div class="form-group-lg">
                            <h3><label for="name">Your Name: </label></h3>
                            <input name="name" type="text" class="form-control" placeholder="Your name" required="required" id="nameInput" value="<?php echo $_POST['name'];?>" />.
                        </div>
                        <div class="form-group-lg">
                            <h3><label for="email">Your Email: </label></h3>
                            <div class="input-group">
                                <span class="input-group-addon emailAddon">@</span>

                                <input name="email" type="email" class="form-control emailInput" placeholder="Your email" required="required" value="<?php echo $_POST['email'];?>" />
                            </div>
                        </div>
                        <div class="form-group-lg">
                            <h3><label for="subject">Subject: </label></h3>
                            <input name="subject" type="text" class="form-control" required="required" id="subjectInput" value="<?php echo $_POST['subject'];?>"/>
                        </div>
                        <div class="form-group-lg">
                            <h3><label for="comment">Comment: </label><h3>
                            <textarea name="comment" class="form-control" id="comment">
                        <?php echo $_POST['comment'];?>
                            </textarea>
                        </div>

                            <input type="submit" name="submit" value="Submit" class="btn btn-primary input-group-lg btn-lg btn-center" id="submitBtn"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container contentDiv">
        <div id="forms" class="pushDown">
            <h1>Forms</h1>

                    <h2 class="formTitle">Member Registration Form</h2>

                     <button type="button" class="btn btn-success btn-lg memberBtn" data-toggle="modal" data-target="#myModal">View</button>

                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true"  data-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="purchaseLabel">Member Registration Form</h4>
                                </div>
                                <div class="modal-body">
                                    <embed embed src="attachments/registration.pdf" height="800" width = "570"/>
                                </div>
                                <div class="modal-footer">
                                     <button type="button" class="btn btn-primary"><a href="attachments/registration.pdf" style="color: white" target="_blank">Download</a></button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                     <a href="attachments/registration.pdf" style="color: white" target="_blank"><button type="button" class="btn btn-success btn-lg memberBtn">Download</button></a>

                    <h2 class="formTitle">Volunteer Hours Form</h2>

                    <button type="button" class="btn btn-success btn-lg memberBtn" data-toggle="modal" data-target="#myModal2">View</button>

                    <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true"  data-backdrop="false">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="purchaseLabel">Volunteer Hours Form</h4>
                                </div>
                                <div class="modal-body">
                                      <embed embed src="attachments/volunteer.pdf" height="600" width = "570"/>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary"><a href="attachments/volunteer.pdf" style="color: white" target="_blank">Download</a></button>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                       <a href="attachments/volunteer.pdf" style="color: white" target="_blank"><button type="button" class="btn btn-success btn-lg memberBtn">Download</button></a>
            </div>
        </div>
    </div>
    <div class="container contentDiv3">
        <div id="events">
            <h1>Events</h1>
            <div class="jumbotron">
                <h3><span class="bold">Upcoming Event</span></h3>
                <p><span class="bold">Date: </span>TBD</p>
                <p>Stanford Concessions</p>
                <p>Event Details:</p>
                    <ul>
                        <li><p><span class="bold">Time: </span>TBD</p></li>
                        <li><p><span class="bold"># of people: </span>TBD<p></li>
                        <li><p><span class="bold">Jobs: </span>TBD</p></li>
                        <li><p><span class="bold">Location: </span>450 Serra Mall, Stanford, CA 94305</li>
                    </ul>
                <p>If you are interested in signing up for this event please use the form below and we will send you a confirmation email with more information once we recieve your submission!</p>
                <p class="lead">Contact us at tinooctagon@gmail.com. Click <a href="#contactinfo" class="bold">here</a> to send us a message.</p>
                    <?php echo $result2; ?>
                    <form method="post">
                        <div class="form-group-lg">
                            <h3><label for="fname">First Name: </label></h3>
                            <input name="fname" type="text" class="form-control" placeholder="Your first name" required="required" id="nameInput" value="<?php echo $_POST['fname'];?>" />.
                        </div>

                        <div class="form-group-lg">
                            <h3><label for="lname">Last Name: </label></h3>
                            <input name="lname" type="text" class="form-control" placeholder="Your last name" required="required" id="nameInput" value="<?php echo $_POST['lname'];?>" />.
                        </div>
                        <div class="form-group-lg">
                            <h3><label for="grade">Grade: </label></h3>
                            <select name="grade" class="form-control grade">
                              <option value="Freshman">Freshman</option>
                              <option value="Sophomore">Sophomore</option>
                              <option value="Junior">Junior</option>
                              <option value="Senior">Senior</option>
                            </select>
                        </div>
                        <div class="form-group-lg">
                            <h3><label for="email2">Your Email: </label></h3>
                            <div class="input-group">
                                <span class="input-group-addon emailAddon">@</span>

                                <input name="email2" type="email" class="form-control emailInput" placeholder="Your email" required="required"value="<?php echo $_POST['email2'];?>" />
                            </div>
                        </div>
                        <div class="form-group-lg form-inline">
                            <h3><label for="phone">Phone: </label></h3>
                                <p class="form-control-static">1</p>
                                <p class="form-control-static">(</p>
                                <input name="phone1" type="tel" class="form-control phone" maxlength = "3" value="<?php echo $_POST['phone'];?>"/>
                                <p class="form-control-static">)</p>
                                <p class="form-control-static">-</p>
                                 <input name="phone2" type="tel" class="form-control phone" maxlength = "3" value="<?php echo $_POST['phone'];?>"/>
                                <p class="form-control-static">-</p>
                                <input name="phone3" type="tel" class="form-control phone" maxlength = "4" value="<?php echo $_POST['phone'];?>"/>
                        </div>
                        <div class="form-group-lg">
                            <h3><label for="concerns">Comments, concerns, or questions: </label><h3>
                            <textarea name="concerns" maxlength="700" class="form-control" id="concerns">
                        <?php echo $_POST['concerns'];?>
                            </textarea>
                        </div>

                            <input type="submit" name="submit2" value="Register" class="btn btn-primary input-group-lg btn-lg btn-center" id="pastEvents"/>
                    </form>
            </div>

            <div class="panel panel-default event-panel"  id="fiestaEducativa">
                  <div class="panel-heading">
                    <h2 class="panel-title big"><span class="bold">Past Events</span></h2>
                  </div>
                  <div class="panel-body">
                    <h4>2015 Freshman Orientation</h4>
                    <ul>
                        <li><p class="medium"><span class="bold">Date: </span>August 2015</p></li>
                        <li><p class="medium"><span class="bold">Event Description:</span> Introduced Tino Octagon to the incoming freshman of 2015.</p></li>
                        <li id="cleanupDay"><p class="medium"><span class="bold">People Present: </span>Vallab K, Sriharsha G, Eric S, Abhinav P, Rohit T</p></li>
                        <li><p class="medium"><span class="bold">Pictures From The Event:</span><a target="_blank" href="orientation2015.html"> View</a></p></li>
                    </ul>

                    <hr/>

                    <h4>Eisenhower Spring Movie Night</h4>
                    <ul>
                        <li><p class="medium"><span class="bold">Date: </span></p>June 2015</li>
                        <li><p class="medium"><span class="bold">Event Description:</span> Helped elementary students at their school's movie night with concessions.</p></li>
                        <li id="cleanupDay"><p class="medium"><span class="bold">People Present: </span>Vallab K, Sriharsha G, Yaswanth V, Sujit M, Tejas V, Eric S, Prajwal B, Pranav M, Tiger Z, Chinmay G, Jai S, Tina N, Palash R, Ayaz A</p></li>
                        <li><p class="medium"><span class="bold">Pictures From The Event:</span> None</p></li>
                    </ul>

                    <hr/>

                    <h4>Eisenhower Science Fair</h4>
                    <ul>
                        <li><p class="medium"><span class="bold">Date: </span></p>February 2015</li>
                        <li><p class="medium"><span class="bold">Event Description:</span> Helped setup and judge Eisenhower students' science fair.</p></li>
                        <li id="cleanupDay"><p class="medium"><span class="bold">People Present: </span>Vallab K, Sriharsha G, Yaswanth V, Sujit M, Chaitanya A, Hussein S, Chinmay G, Jai S, Eric S</p></li>
                        <li><p class="medium"><span class="bold">Pictures From The Event:</span> None</p></li>
                    </ul>

                    <hr/>

                    <h4>2014 Clubs Day</h4>
                    <ul>
                        <li><p class="medium"><span class="bold">Date: </span></p>First Semester 2014</li>
                        <li><p class="medium"><span class="bold">Event Description:</span>Sold many <em>House of Falafel</em> wraps to fundraise for our club.</p></li>
                        <li><p class="medium"><span class="bold">Special Thanks to: </span>Eric S, Hussein S</p></li>
                        <li><p class="medium"><span class="bold">Pictures From The Event:</span><a target="_blank" href="clubsday2014.html"> View</a></p></li>
                    </ul>

                    <hr/>

                    <h4>Village School Halloween Carnival (Elementary School in Campbell)</h4>
                    <ul>
                        <li><p><span class="bold">Date:</span> October 2014</p></li>
                        <li><p><span class="bold">Event Description:</span>
                            Helped at the elementary school's carnival. We helped setup and manage all the booths/games.</p></li>
                        <li><p><span class="bold">People Present:</span> Yaswanth V, Vallab K, Eric S, Palash R, Sriharsha G, Chinmay G, Vishwas M, Barath P, Jonathan S</p></li>
                        <li><p><span class="bold">Pictures From The Event:</span><a target="_blank" href="carnival2014.html"> View</a></p></li>
                    </ul>

                    <hr/>

                    <h4>Eisenhower Fall Movie Night</h4>
                    <ul>
                        <li><p><span class="bold">Date:</span> October 2014</p></li>
                        <li><p><span class="bold">Event Description:</span>
                            High school students helped at the elementary school
                            movie night. We helped setup the
                            projector/computers/studio speakers,
                            moved tables around, and managed their
                            fundraising/concession stands.</p></li>
                        <li id="halloweenCarnival"><p><span class="bold">People Present:</span>Vallab K, Yaswanth V, Sujit M, Eric S, Prajwal B, Ayaz A, Jyothi C, Yuri U, Isabella C, Naman M, Manan D</p></li>
                        <li><p><span class="bold">Pictures From The Event:</span><a target="_blank" href="fallnight2014.html"> View</a></p></li>
                    </ul>

                    <hr/>

                    <h4>Coastal Creek Cleanup Day (Sunnyvale Creek)</h4>
                    <ul>
                        <li><p><span class="bold">Date:</span> September 2014</p></li>
                        <li><p><span class="bold">Event Description:</span> We helped pick up trash in a local marsh in sunnyvale.</p></li>
                        <li id="movieNight1"><p><span class="bold">People Present:</span>Yaswanth V, Vallab K, Eric S, Sujit M, Sriharsha G, Chinmay G</p></li>
                        <li><p><span class="bold">Pictures From The Event:</span><a target="_blank" href="cleanup2014.html"> View</a></p></li>
                    </ul>

                    <hr/>

                    <h4>Fiesta Educativa (Event in Partnership with Spanish Honor Society)</h4>
                    <ul>
                        <li><p class="medium"><span class="bold">Date: </span>September 2014</p></li>
                        <li><p class="medium"><span class="bold">Event Description:</span>A joint event with Spanish Honor Society to help autistic children.</p></li>
                        <li id="cleanupDay"><p class="medium"><span class="bold">People Present:</span>Tejas V, Yaswanth V, Eric S</p></li>
                        <li><p class="medium"><span class="bold">Pictures From The Event:</span> None</p></li>
                    </ul>

                    <hr/>

                    <h4>M &amp; M Carwash</h4>
                    <ul>
                        <li><p class="medium"><span class="bold">Date: </span>May 2014</p></li>
                        <li><p class="medium"><span class="bold">Event Description:</span>A carwash to raise funds for Mr. Munson's wheelchair. We raised $600.</p></li>
                        <li id="cleanupDay"><p class="medium"><span class="bold">People Present:</span>Cupertino High</p></li>
                        <li><p class="medium"><span class="bold">Pictures From The Event:</span><a target="_blank" href="carwash2014.html"> View</a></p></li>
                    </ul>

                    <hr/>

                  </div>
            </div>
        </div>
    </div>

    <div class="container footer">
      <p class="lead copyright">© 2015 Tino Octagon</p>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap-resources/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
    <script src="index.js"></script>
    <script type="text/javascript" src="social-likes/social-likes.min.js"></script>
    <script>
      $(document).ready(function() {
      (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
          program();
      });
    </script>



</body>

</html>
