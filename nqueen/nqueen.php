<?php
session_start();
$loggedIn = false;

if (isset($_SESSION['loggedIn']) && isset($_SESSION['name'])) {
    $loggedIn = true;
}

// connection
$conn = new mysqli('localhost', 'root', '', 'Algorithms');

function createCommentRow($data) {
    global $conn;

    $response = '
            <div class="comment">
                <div class="user">'.$data['name'].' <span class="time">'.$data['createdOn'].'</span></div>
                <div class="userComment">'.$data['comment'].'</div>
                <div class="replies">';
//show replies
    $sql = $conn->query("SELECT replies.id, name, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') 
                        AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id 
                        WHERE replies.commentID = '".$data['id']."' 
              /* here*/ AND replies.page_name = 'nqueen' 
                        ORDER BY replies.id DESC LIMIT 1");
    while($dataR = $sql->fetch_assoc())
        $response .= createCommentRow($dataR);

    $response .= '
                        </div>
            </div>
        ';

    return $response;
}

//show comments
if (isset($_POST['getAllComments'])) {
    $start = $conn->real_escape_string($_POST['start']);

    $response = "";
    $sql = $conn->query("SELECT comments.id, name, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') 
                         AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id 
               /* here*/ WHERE comments.page_name = 'nqueen'
                         ORDER BY comments.id DESC LIMIT $start, 20");
    while($data = $sql->fetch_assoc())
        $response .= createCommentRow($data);

    exit($response);
}

//add comment or reply
if (isset($_POST['addComment'])) {
    $comment = $conn->real_escape_string($_POST['comment']);
    $isReply = $conn->real_escape_string($_POST['isReply']);
    $commentID = $conn->real_escape_string($_POST['commentID']);
 //insert into reply
    if ($isReply != 'false') {
        $conn->query("INSERT INTO replies (comment, commentID, userID, createdOn, page_name) 
            /* here*/           VALUES ('$comment', '$commentID', '".$_SESSION['userID']."', NOW(), 'nqueen')"
                      );

        $sql = $conn->query("SELECT replies.id, name, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') 
                             AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id 
                /* here*/             WHERE replies.page_name = 'nqueen'
                             ORDER BY replies.id DESC LIMIT 1");
    } else {
        //insert into comments
        if($loggedIn != true)
        {
            $conn->query("INSERT INTO comments (userID, comment, createdOn, page_name) 
         /* here*/              VALUES ('9','$comment',NOW(),'nqueen')");
        } else {
            $conn->query("INSERT INTO comments (userID, comment, createdOn, page_name) 
            /* here*/              VALUES ('".$_SESSION['userID']."','$comment',NOW(),'nqueen')");
        }
        

        $sql = $conn->query("SELECT comments.id, name, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') 
                             AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id 
            /* here*/                 WHERE comments.page_name = 'nqueen'
                             ORDER BY comments.id DESC LIMIT 1");
    }

    $data = $sql->fetch_assoc();
    exit(createCommentRow($data));
}

//registration
if (isset($_POST['register'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = $conn->query("SELECT id FROM users WHERE email='$email'");
        if ($sql->num_rows > 0)
            exit('failedUserExists');
        else {
            //add new user
            $ePassword = password_hash($password, PASSWORD_BCRYPT);
            $conn->query("INSERT INTO users (name,email,password,createdOn) VALUES ('$name', '$email', '$ePassword', NOW())");

            $sql = $conn->query("SELECT id FROM users ORDER BY id DESC LIMIT 1");
            $data = $sql->fetch_assoc();

            $_SESSION['loggedIn'] = 1;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['userID'] = $data['id'];

            exit('success');
        }
    } else
        exit('failedEmail');
}

//login
if (isset($_POST['logIn'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    //validation
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $sql = $conn->query("SELECT id, password, name FROM users WHERE email='$email'");
        if ($sql->num_rows == 0)
            exit('failed');
        else {
            $data = $sql->fetch_assoc();
            $passwordHash = $data['password'];

            if (password_verify($password, $passwordHash)) {
                $_SESSION['loggedIn'] = 1;
                $_SESSION['name'] = $data['name'];
                $_SESSION['email'] = $email;
                $_SESSION['userID'] = $data['id'];

                exit('success');
            } else
                exit('failed');
        }
    } else
        exit('failed');
}

//showing the number of comments
$sqlNumComments = $conn->query("SELECT id FROM comments
                                WHERE comments.page_name = 'nqueen'"); /* here*/
$numComments = $sqlNumComments->num_rows;
$sqlNumReply = $conn->query("SELECT id FROM replies
            /* here*/         WHERE replies.page_name = 'nqueen'");
$numReplies = $sqlNumReply->num_rows;
$TotalComments = $numComments+$numReplies;
?>







<!-- start of html -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
          crossorigin="anonymous">

    <link rel="stylesheet" href="../css/home.css">

    <link rel="stylesheet" href="../insertion_sort/insertion.css">
    
    <!-- Styling for the comment section -->
    <style type="text/css">
        .comment {
            margin-bottom: 20px;
            min-height: 30px;
            border-radius: 3px;
            font-family: Arial;
            font-size: 14px;
            line-height: 1.5;
            color: #797979;
            position: relative;
            max-width: 300px;
            height: auto;
            margin: 20px 10px;
            padding: 5px;
            background-color: #DADADA;
            border-radius: 3px;
            border: 5px solid #ccc;
        }

        .user {
            font-weight: bold;
            color: black;
        }

        .time, .reply {
            color: gray;
        }

        .userComment {
            color: #000;
        }

        .replies .comment {
            margin-top: 20px;

        }

        .replies {
            margin-left: 20px;
        }

        #registerModal input, #logInModal input {
            margin-top: 10px;
        }
    </style>
    <title>N Queen</title>
    
</head>





<body>
    <!-- navigation bar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-success ">
    <!-- collapse -->
        <span class="navbar-text" id="logo">
            <a class="nav-link" href="../html/home.php">Algorithms</a>
        </span>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#collapse_target">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="collapse_target">
            
        <!-- navbar menus -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../html/home.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../About/About.html">ABOUT</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Referrence/referrence.html">REFERRENCES</a>
                </li>
            </ul>
        </div>
    </nav>





    
              
        
    <!-- middle part -->
    <div class="container-fluid">
    <div class="row">
        <div class="col-3 col-lg-2 main">
            <ul class="list-group list-group-flush">
<!--Sorting-->  <li class="list-group-item">
                    <i>Sorting</i>
                </li>
                <ol>
                    <li class="list-group-item"> 
                        <a href="../Bubble/bubble.php"> <i>Bubble Sort</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../selection/selection.php"> <i>Selection Sort</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../Insertion_sort/insertion.php"> <i>Insertion Sort</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../Merge_sort/mergeSort.php"> <i>Merge Sort</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="quickSort.php"> <i>Quick Sort</i> </a>
                    </li>
                </ol><!-- sorting -->

<!-- searching -->
                <li class="list-group-item">
                    <i> Searching </i>
                </li>
                <ol>
                    <li class="list-group-item"> 
                        <a href="../linear/linear.php"> <i>Linear Search</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../binary/binary.php"> <i> Binary Search </i> </a>
                    </li>
                </ol>


                
<!-- Graph -->  <li class="list-group-item">
                    <i> Graph Algorithms</i>
                </li>
                <ol>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../BFS/bfs.php"><i>Bfs</i> </a>
                    </li>
                    <li class="list-group-item"> 
                            <a href="../DFS/dfs.php"><i>Dfs</i></a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../PRIM/prims.php"><i>Prim's Algorithm</i></a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../Kruskal/kruskal.php"><i>Kruskal's Algorithm</i> </a>
                    </li>                    
                </ol> <!-- graph -->

<!-- Greedy --> <li class="list-group-item"> 
                    <i>Greedy</i>
                </li>
                <ol>
                    <li class="list-group-item"> 
                        <a href="../coin/Coin.php"> <i>Coin Change</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../KnapsackBruteForce/KnapsackBrute.php"> <i>Knapsack Brute Force</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../KnapsackGreedy/knapsackGreedy.php"> <i>Knapsack</i> </a>
                    </li>
                </ol> <!--Greedy-->

<!-- Di & co--> <li class="list-group-item"> 
                <i>Divide & Concure</i>
                </li>
                <ol>
                    <li class="list-group-item"> 
                        <a href="../Merge_sort/mergeSort.php"> <i>Merge Sort</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../Quick_sort/quickSort.php"> <i>Quick Sort</i> </a>
                    </li>
                    <li class="list-group-item"> 
                        <a href="../Matrix/Matrix.php"> <i>Strassen's Algorithm</i> </a>
                    </li>
                </ol> <!--Di & Co-->

<!-- Backtracking -->
                <li class="list-group-item"> 
                    <i>Backtracking</i>
                </li>
                <ol>
                <li class="list-group-item"> 
                        <a href="nqueen.php"> <i>N Queen</i> </a>
                    </li>

                </ol>
               
                
            </ul>
        </div> <!--col-3.. main div-->

        <div class="col-9 main ">
            <div class="modal" id="registerModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Registration Form</h5>
                        </div>
                         <div class="modal-body">
                            <input type="text" id="userName" class="form-control" placeholder="Your Name">
                            <input type="email" id="userEmail" class="form-control" placeholder="Your Email">
                            <input type="password" id="userPassword" class="form-control" placeholder="Password">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" id="registerBtn">Register</button>
                            <button class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

<div class="modal" id="logInModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Log In Form</h5>
            </div>
            <div class="modal-body">
                <input type="email" id="userLEmail" class="form-control" placeholder="Your Email">
                <input type="password" id="userLPassword" class="form-control" placeholder="Password">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="loginBtn">Log In</button>
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top:50px;">
    <div class="row">
        <div class="col-md-12" align ="right">
            <?php
            if (!$loggedIn)
                echo '
                        <button class="btn btn-primary" data-toggle="modal" data-target="#registerModal">Register</button>
                        <button class="btn btn-success" data-toggle="modal" data-target="#logInModal">Log In</button>
                ';
            else
                echo '
                    <a href="logout.php" class="btn btn-warning">Log Out</a>
                ';
            ?>
        </div>
    </div>
    <!-- here -->
    <h1 id="top">N Queen</h1>
            <p class="content">
            Backtracking is a general algorithm for finding all (or some) solutions to some computational problems, notably constraint satisfaction problems, that incrementally builds candidates to the solutions, and abandons a candidate ("backtracks") as soon as it determines that the candidate cannot possibly be completed to a valid solution.
                
            </p>
            <p class="content">
            The classic textbook example of the use of backtracking is the eight queens puzzle, that asks for all arrangements of eight chess queens on a standard chessboard so that no queen attacks any other. In the common backtracking approach, the partial candidates are arrangements of k queens in the first k rows of the board, all in different rows and columns. Any partial solution that contains two mutually attacking queens can be abandoned.
            </p>

            <p class="content">
            Backtracking can be applied only for problems which admit the concept of a "partial candidate solution" and a relatively quick test of whether it can possibly be completed to a valid solution. It is useless, for example, for locating a given value in an unordered table. When it is applicable, however, backtracking is often much faster than brute force enumeration of all complete candidates, since it can eliminate many candidates with a single test.
            </p>

            

            
            
            <h4 class="content"> Here is an animation explaining n queen problem: </h4>

            <!-- A gif explaining insertion sort  -->
            <div class="anim_container">
                <img src="../Pic/Eight-queens-animation.gif" alt="Insertion-sort01" class="img_anim">
            </div>

            <!-- pseudocode -->
            <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
                Begin
                if all columns are filled, then
                    return true
                for each row of the board, do
                    if isValid(board, i, col), then
                        set queen at place (i, col) in the board
                        if solveNQueen(board, col+1) = true, then
                            return true
                        otherwise remove queen from place (i, col) from board.
                done
                return false
                End
            </pre>
            </div>

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include &#60iostream>
    using namespace std;
        
    #define N 8

    void printBoard(int board[N][N]) {
    for (int i = 0; i < N; i++) {
        for (int j = 0; j < N; j++)
            cout << board[i][j] << " ";
        cout << endl;
    }
    }

    bool isValid(int board[N][N], int row, int col) {
    for (int i = 0; i < col; i++)    //check whether there is queen in the left or not
        if (board[row][i])
            return false;
    for (int i=row, j=col; i>=0 && j>=0; i--, j--)
        if (board[i][j])       //check whether there is queen in the left upper diagonal or not
            return false;
    for (int i=row, j=col; j>=0 && i < N; i++, j--)
        if (board[i][j])      //check whether there is queen in the left lower diagonal or not
            return false;
    return true;
    }

    bool solveNQueen(int board[N][N], int col) {
    if (col >= N)           //when N queens are placed successfully
        return true;
    for (int i = 0; i < N; i++) {     //for each row, check placing of queen is possible or not
        if (isValid(board, i, col) ) {
            board[i][col] = 1;      //if validate, place the queen at place (i, col)
            if ( solveNQueen(board, col + 1))    //Go for the other columns recursively
                return true;
                    
            board[i][col] = 0;        //When no place is vacant remove that queen
        }
    }
    return false;       //when no possible order is found
    }

    bool checkSolution() {
    int board[N][N];
    for(int i = 0; i< N; i++)
        for(int j = 0; j< N; j++)
            board[i][j] = 0;      //set all elements to 0
                
    if ( solveNQueen(board, 0) == false ) {     //starting from 0th column
        cout << "Solution does not exist";
        return false;
    }
    printBoard(board);
    return true;
    }

    int main() {
    checkSolution();
    }
                     
     </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of n queen  problem is: O( n! )</p>
        <br>
        <br>

    <div class="row" style="margin-top: 20px;margin-bottom: 20px;">
       
    </div>
    <div class="row">
        <div class="col-md-12">
            <textarea class="form-control" id="mainComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
            <button style="float:right" class="btn-primary btn" onclick="isReply = false;" id="addComment">Add Comment</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2><b id="numComments"> <?php echo $TotalComments ?> Comments</b></h2>
            <div class="userComments">

            </div>
        </div>
    </div>
</div>

<div class="row replyRow" style="display:none">
    <div class="col-md-12">
        <textarea class="form-control" id="replyComment" placeholder="Add Public Comment" cols="30" rows="2"></textarea><br>
        <button style="float:right" class="btn-primary btn" onclick="isReply = true;" id="addReply">Add Reply</button>
        <button style="float:right" class="btn-default btn" onclick="$('.replyRow').hide();">Close</button>
    </div>
    
</div>
<br>
<br>
</div>
</div>
</div>
<nav class="navbar navbar-expand-sm bg-success navbar-dark ">
       <h5 class="text-white navbar-center" >@copy Algorithms</h5> 
</nav>


<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script type="text/javascript">
    var isReply = false, commentID = 0, max = <?php echo $TotalComments ?>;

    $(document).ready(function () {
        $("#addComment, #addReply").on('click', function () {
            var comment;

            if (!isReply)
                comment = $("#mainComment").val();
            else
                comment = $("#replyComment").val();

            if (comment.length > 0) {
                $.ajax({
                    url: 'nqueen.php', /* here*/
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        addComment: 1,
                        comment: comment,
                        isReply: isReply,
                        commentID: commentID
                    }, success: function (response) {
                        max++;
                        $("#numComments").text(max + " Comments");

                        if (!isReply) {
                            $(".userComments").prepend(response);
                            $("#mainComment").val("");
                        } else {
                            commentID = 0;
                            $("#replyComment").val("");
                            $(".replyRow").hide();
                            $('.replyRow').parent().next().append(response);
                        }
                    }
                });
            } else
                alert('Please Check Your Inputs');
        });

        $("#registerBtn").on('click', function () {
            var name = $("#userName").val();
            var email = $("#userEmail").val();
            var password = $("#userPassword").val();

            if (name != "" && email != "" && password != "") {
                $.ajax({
                    url: 'nqueen.php', /* here*/
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        register: 1,
                        name: name,
                        email: email,
                        password: password
                    }, success: function (response) {
                        if (response === 'failedEmail')
                            alert('Please insert valid email address!');
                        else if (response === 'failedUserExists')
                            alert('User with this email already exists!');
                        else
                            window.location = window.location;
                    }
                });
            } else
                alert('Please Check Your Inputs');
        });

        $("#loginBtn").on('click', function () {
            var email = $("#userLEmail").val();
            var password = $("#userLPassword").val();

            if (email != "" && password != "") {
                $.ajax({
                    url: 'nqueen.php',  /* here*/
                    method: 'POST',
                    dataType: 'text',
                    data: {
                        logIn: 1,
                        email: email,
                        password: password
                    }, success: function (response) {
                        if (response === 'failed')
                            alert('Please check your login details!');
                        else
                            window.location = window.location;
                    }
                });
            } else
                alert('Please Check Your Inputs');
        });

        getAllComments(0, max);
    });

    function reply(caller) {
        commentID = $(caller).attr('data-commentID');
        $(".replyRow").insertAfter($(caller));
        $('.replyRow').show();
    }

    function getAllComments(start, max) {
        if (start > max) {
            return;
        }

        $.ajax({
            url: 'nqueen.php',  /* here*/
            method: 'POST',
            dataType: 'text',
            data: {
                getAllComments: 1,
                start: start
            }, success: function (response) {
                $(".userComments").append(response);
                getAllComments((start+20), max);
            }
        });
    }
</script>

</body>
</html>