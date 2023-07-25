<?php
session_start();
?>
<html>

<head>

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <style>
    .header {
      top: 0;
      margin: 0;
      width: 100%;
      color: #FF0404;
      overflow: hidden;
      padding: 2rem 1rem;
      background-color: #333;
    }

    /* Style the header links */
    .header a {
      float: left;
      color: white;
      text-align: center;
      padding: 12px;
      text-decoration: none;
      font-size: 18px;
      line-height: 25px;
      border-radius: 4px;
      font-weight: bold;
    }

    .dropdown-menu {
      background-color: #333;
      border: 1px solid gray;
      box-shadow: 10px 5px 20px #c7c7c7;
      padding: 0px;
    }

    .dropdown-menu a:first-child {
      border-top: none;
    }

    .dropdown-menu a {
      border-top: 1px solid gray;
      border-radius: 0px;
      border: 0px;
      font-size: small;
    }

    /* Style the logo link (notice that we set the same value of line-height and font-size to prevent the header to increase when the font gets bigger */
    .header a.logo {
      font-size: 25px;
      font-weight: bold;
      color: #FF0404;
    }

    /* Change the background color on mouse-over */
    .header-right>a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Float the link section to the right */
    .header-right {
      float: right;
      display: flex;
      gap: 1rem;
    }

    /* Add media queries for responsiveness - when the screen is 500px wide or less, stack the links on top of each other */
    @media screen and (max-width: 500px) {
      .header a {
        float: none;
        display: block;
        text-align: left;
      }

      .header-right {
        float: none;
      }
    }

    /* Style the active/current link*/
    a.act {
      background: linear-gradient(to right, #fd746c 0%, #ff9068 100%);
      color: white;
      border-radius: 30px;
    }

    a.logo2 {
      background-color: #333;
    }

    #avatar {
      text-transform: uppercase;
      border: 2px solid gray;
      background-color: while;
      width: 54px;
      height: 54px;
      /* width: 50px;
      */
      border-radius: 100%;
      cursor: pointer;
    }

    .w3-sidebar {
      display: flex;
      flex-direction: column;
      row-gap: 15px;
      padding-left: 1rem;
      padding-right: 1rem;
      background-color: white;
      /* border-left: 2px solid gray; */
      box-shadow: gray -10vh 0px 50vh;
    }

    .w3-sidebar a,
    button {
      color: black
    }

    .w3-sidebar h1 {
      text-align: center;
    }

    #activityTitleBar {
      display: flex;
      justify-content: space-evenly;
    }

    #activityTitleBar button {
      position: absolute;
      transition: 0.3s ease-in-out;
      left: 0
    }

    #activityTitleBar button:hover {
      border-radius: 50%;
    }

    #activityTitleBar:last-child {
      justify-self: center;
      flex: 1;
      background: #000;
    }

    #siderbarCloseBtn {
      width: fit-content;
      font-size: 25px;
      margin: 1rem;
      min-height: 50px;
      text-align: center;
    }

    #siderbarCloseBtn:hover {
      background-color: gray;
    }

    #usersView {
      padding-bottom: 5rem;
      flex: 1;
    }

    #usersView .messageFound {
      color: #333;
      height: 100%;
      font-size: large;
      text-align: center;
      padding-top: 50%;
    }

    #usersView>div {
      padding: 30px 20px 10px 20px;
      overflow-y: auto;
      border: 1px solid gray;
      height: fit-content;
      display: flex;
      flex-direction: column;
      row-gap: 10px;
      border-radius: 10px;
    }

    #messageView {
      display: flex;
      /* padding-bottom: 5rem; */
      flex: 1;
      height: 85%;
      flex-direction: column;
      /* position: fixed; */
    }

    #chatScreen {
      width: 100%;
      flex: 1;
      display: flex;
      gap: 5px;
      flex-direction: column;
      height: calc(89%);
      position: absolute;
      overflow-y: auto;
      margin-bottom: 3rem;
      padding: 5px;
    }

    /* #messageView h1 {
      margin: 0;
    } */


    #messageView>div:not(#messageComposeView) {
      min-width: 100px;
      /* min-height: 100%; */
      background-color: #c7c7c7;
      padding: 10px;
    }

    #messageView> :nth-child(1) {
      margin-bottom: 0px;
      border-bottom: 1px solid gray;
      border-radius: 10px 10px 0 0;
    }

    #messageView> :nth-child(2) {
      max-height: 100%;
      display: flex;
      flex-direction: column;
      height: 100%;
      position: relative;
      margin-bottom: 1rem;
      border-radius: 0 0 10px 10px;
      /* overflow-y: scroll; */
    }

    #messageComposeView {
      left: 0;
      bottom: 0;
      display: flex;
      width: 100%;
      height: 3rem;
      padding: 0px 10px;
      /* margin-bottom: 2rem; */
      border-radius: 10px;
      position: absolute;
      align-items: center;
      background-color: white;
      border: 2px solid black;
      justify-content: space-evenly;
    }

    #messageComposeView>input {
      outline: none;
      border: none;
      flex: 1;
    }

    #messageComposeView>button {
      background-color: white;
      align-items: center;
      border: none;
      outline: none;
      height: 30px;
      width: 30px;
    }

    #messageComposeView>* {
      display: flex;
      padding: 0px 20px;
      gap: 5px;
      float: inline-end
    }

    .chat {
      display: flex;
      height: 68px;
      gap: 10px;
      flex-direction: column;
      border: 2px solid black;
      justify-content: center;
      padding: 35px;
      cursor: pointer;
      border-radius: 5px;
      position: relative;
    }

    .chat:hover {
      background-color: #cccfcd;
    }

    .chat span:first-child {
      color: black;
      font-size: 20px;
    }

    .chat span:last-child {
      color: black;
      font-size: 15px;
    }

    #chatScreen>div {
      width: 100%;
    }

    .message {
      display: flex;
      color: black;
      margin: 0px 10px;
      padding: 25px;
      padding-top: 5px;
      width: fit-content;
      max-height: 4rem;
      border-radius: 15px;
      border: 1px solid gray;
      flex-direction: column;
      background-color: white;
    }

    .message :first-child {
      font-size: 20px;
    }

    .message :last-child {
      font-size: 10px;
      /* scroll-snap-align: start; */
      transition: 1s ease-in;
    }

    #newspan {
      position: absolute;
      bottom: 45%;
      left: 0.5rem;
    }

    #avatar {
      position: relative;
    }

    #avatar #newspan {
      left: 90%;
      top: 0;
      right: 0;
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
  <div class="header">
    <a href="home.php" class="logo" <?php if ($active == 'home') echo "class='logo2'"; ?>>Blood Bank & Donation </a>
    <div class="header-right">
      <a href="why_donate_blood.php" <?php if ($active == 'why') echo "class='act'"; ?>>Why Donate Blood</a>
      <?php
      $conn = mysqli_connect("localhost", "root", "", "blood_donation") or die("Connection error");


      // print_r($result->num_rows);
      if (isset($_SESSION['user']['uid']) && isset($_SESSION['loggedin'])) {
        $uid = $_SESSION['user']['uid'];
        $sql = "SELECT * FROM donor_details WHERE uid=$uid";
        $result = mysqli_query($conn, $sql) or die("Query unsucessfull");
      ?>
        <a href="donate_blood.php" <?php if ($active == 'donate') echo "class='act'"; ?>>Become A Donor</a>
      <?php
      }
      ?>
      <a href="need_blood.php" <?php if ($active == 'need') echo "class='act'"; ?>>Need Blood</a>
      <a href="about_us.php" <?php if ($active == 'about') echo "class='act'"; ?>>About Us</a>
      <?php
      if (isset($_SESSION['loggedin'])) {
        $username = $_SESSION['username'];
        // getting first letters of first and last name as avatar
        $token = strtok($_SESSION['username'], " ");
        $newMessages = mysqli_query($conn, "SELECT COUNT(readed) as readCount FROM messages WHERE readed=0 AND receiveruid=$uid;");
        $newMessagesSize = mysqli_fetch_assoc($newMessages)['readCount'];
        // if (!$user['readed']) {
      ?>
        <a id="avatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
          if ($newMessagesSize) {
          ?>
            <span id="newspan"><i class="fa-solid fa-circle fa-beat fa-2xs" style="color: #ff7b00;"></i></span>
          <?php
          }
          ?>
          <?php
          while ($token !== false) {
            echo $token[0];
            $token = strtok(" ");
          }
          // }
          ?>
        </a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="profile.php">Profile</a>
          <!-- <hr> -->
          <a title="messages" class=" dropdown-item w3-button" onclick="w3_open()" data-class="navbar-fixed-right" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <?php
            if ($newMessagesSize) {
            ?>
              <span id="newspan"><i class="fa-solid fa-circle fa-beat fa-2xs" style="color: #ff7b00;"></i></span>
            <?php
            }
            ?>
            Messages
          </a>
          <!-- <hr> -->
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
        <div class="w3-sidebar w3-bar-block w3-animate-right" style="width:500px;z-index:50;top:0;right:0;display:none" id="mySidebar">
          <div id="activityTitleBar">
            <button class="w3-bar-item w3-button" id="siderbarCloseBtn" onclick="sidebar_close()">&times;</button>
            <h1 id="activityTitle"></h1>
          </div>
          <!-- listing users only who send messages-->
          <div id="usersView">
            <?php
            // messages without requests
            $sql =
              "WITH message_user_cte AS (
                  SELECT mid, uid, senderuid, receiveruid, uname, timestamp,readed
                  FROM messages
                  JOIN users ON receiveruid = uid AND senderuid = $uid
                  UNION
                  SELECT mid, receiveruid, senderuid, uid, uname, timestamp,readed
                  FROM messages
                  JOIN users ON senderuid = uid AND receiveruid = $uid
              )
              SELECT mid, uid, senderuid, receiveruid, uname,readed,timestamp
              FROM message_user_cte
              GROUP BY uname;";
            // echo $sql;
            // $sql = "SELECT senderuid,receiveruid,message,timestamp,uname FROM messages join users WHERE senderuid=uid AND senderuid=$uid;";
            $users = mysqli_query($conn, $sql) or die("Query unsucessfull");

            $requests = mysqli_query($conn, "SELECT * FROM request join messages where mid=messageid") or die("Query unsucessfull");

            if (!$users->num_rows) {
            ?>
              <div class="messageFound">No Messages</div>
            <?php
            } else {
            ?>
              <div>
                <?php
                // print_r(mysqli_fetch_assoc($users));
                // $usersArr = [];
                while ($user = mysqli_fetch_assoc($users)) {
                  // array_push($usersArr, $user);
                  $senderuid = $user['senderuid'];
                  $recieveruid = $user['receiveruid'];
                  $uname = $user['uname'];
                  $mid = $user['mid'];
                  // print_r($user);

                  if ($recieveruid == $uid)
                    $userid = $senderuid;
                  else
                    $userid = $recieveruid;
                ?>
                  <div class="chat">
                    <span class="username" onclick="handleUserViewClick(<?php echo $userid . ',' . '`' . $uname . '`' ?>)"><?php echo $user['uname'] ?></span>
                    <span class="time"><?php echo $user['timestamp'] ?></span>
                    <?php
                    $sql = "SELECT responded FROM request WHERE messageuid=$mid;";
                    $responded = mysqli_query($conn, $sql);
                    if (!$responded && $uid == $recieveruid) {
                    ?>
                      <div id="requestResponses<?php echo $mid ?>" style="display: flex;position:absolute;gap:1px;right:2px">
                        <button class="btn chatResponseBtn" onclick="acceptRequest(<?php echo $mid ?>,<?php echo $recieveruid ?>)" id="requestAcceptBtn" title="Accept blood request">
                          <i class="fa-solid fa-check fa-lg" style="color: #0dc919;"></i>
                        </button>
                        <button class="btn chatResponseBtn" onclick="rejectRequest(<?php echo $mid ?>,<?php echo $recieveruid ?>)" id="requestRejectBtn" title="Reject blood request">
                          <i class="fa-regular fa-circle-xmark fa-lg" style="color: #ff0000;"></i>
                        </button>
                      </div>
                    <?php
                    }
                    ?>
                    <?php
                    if (!$user['readed']) {
                    ?>
                      <span id="newspan"><i class="fa-solid fa-circle fa-beat fa-2xs" style="color: #ff7b00;"></i></span>
                    <?php
                    }
                    ?>
                  </div>
                <?php
                }
                ?>
              </div>
            <?php
            }
            ?>
          </div>
          <div id="messageView" style="display:none">
            <div>
              <span class="d-flex align-items-baseline">
                <i onclick="handleBackBtnMessageViewClick()" style="cursor:pointer" class="text-secondary fa-solid fa-arrow-left"></i>
                <h2 class="pl-3 text-primary m-0"></h2>
              </span>
            </div>
            <div>
              <div id="chatScreen"></div>
              <div id="messageComposeView">
                <input name="message" id="messageInp" placeholder="type your message" />
                <button value="" id="messageSendBtn" type="btn"><i class="fa-regular fa-paper-plane"></i></button>
              </div>
            </div>
          </div>
        </div>
      <?php
      } else {
      ?>
        <a href="login.php" <?php if ($active == 'login') echo "class='act'"; ?>>Login </a>
      <?php
      }
      ?>
    </div>

  </div>

</body>

<script>
  let rUid;
  document.querySelector("#activityTitleBar h1").innerText = 'Messages'

  const handleUserViewClick = (uid, uname) => {
    console.log(`clicked on user ${uid}`)
    console.log(`clicked on user ${uname}`)
    openChatView(uid, uname)
  }
  const openChatView = (uid, uname) => {
    rUid = uid
    document.querySelector("#activityTitleBar h1").innerText = 'Chats'
    document.getElementById("usersView").style.display = "none"
    document.getElementById("messageView").style.display = "flex"
    document.querySelector("#messageView h2").innerText = uname
    loadChat()
  }
  const loadChat = () => {
    $.ajax({
      url: 'getMessages.php',
      method: "POST",
      data: {
        recieverid: rUid
      },
      success: (res) => {
        // console.log(res)
        res = JSON.parse(res)
        // console.log(res)
        let resHtml = ''
        res.forEach((msg, index) => {
          message = msg['message']
          timestamp = msg['timestamp']
          resHtml += `<div id="messageDiv${index}">
          <div class="message"`
          if (msg['receiveruid'] == rUid)
            resHtml += `style="border-bottom-right-radius: 0;float: right;"`
          else
            resHtml += `style="border-bottom-left-radius: 0;float: left;"`
          resHtml += `>
          <span class="username">${message} </span>
          <span class="userPhn">${timestamp} </span>
          </div>
          </div>`
        });
        document.getElementById("chatScreen").innerHTML = resHtml

        // scroll to last element
        document.getElementById(`messageDiv${res.length-1}`).scrollIntoView(true);
      }
    })
  }
  const handleBackBtnMessageViewClick = () => {
    document.querySelector("#activityTitleBar h1").innerText = 'Messages'
    document.getElementById("usersView").style.display = "flex"
    document.getElementById("usersView").style.flexDirection = 'column'
    document.getElementById("messageView").style.display = "none"

  }

  $(document).on('click', '#messageSendBtn', e => {
    let msg = $('#messageInp').val()
    handleMessageSend(msg)
    console.log(msg)
    $('#messageSendBtn').val("")
  })

  const sendMessage = (msg, load = false) => {
    $.ajax({
      url: 'sendMessages.php',
      method: "POST",
      data: {
        message: {
          recieverid: rUid,
          content: msg
        }
      },
      success: (res) => {
        if (load) loadChat()
      }
    })

  }
  const handleMessageSend = (msg) => {
    console.log(`receipient id ${rUid}`)
    sendMessage(msg, load = true)
  }

  const updateRequest = (requestid, status) => {
    $(`#requestResponses${requestid}`).hide()
    $.ajax({
      url: 'updateRequest.php',
      method: 'POST',
      data: {
        request: {
          id: requestid,
          status: status
        }
      },
      success: res => {
        console.log(res)
      }
    })
  }
  // requestid column in request table
  const acceptRequest = (requestid, receiverId) => {
    console.log(requestid)
    updateRequest(requestid, 1)
    rUid = receiverId
    let msg = "I am available"
    sendMessage(msg, load = false)
  }
  const rejectRequest = (requestid, receiverId) => {
    console.log(requestid)
    updateRequest(requestid, 0)
    rUid = receiverId
    let msg = "Sorry, Not available"
    sendMessage(msg, load = false)
  }

  function w3_open() {
    document.getElementById("mySidebar").style.display = "flex";
  }

  function sidebar_close() {
    document.getElementById("mySidebar").style.display = "none";
  }
</script>

</html>