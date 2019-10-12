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
              /* here*/ AND replies.page_name = 'matrix' 
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
               /* here*/ WHERE comments.page_name = 'matrix'
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
            /* here*/           VALUES ('$comment', '$commentID', '".$_SESSION['userID']."', NOW(), 'matrix')"
                      );

        $sql = $conn->query("SELECT replies.id, name, comment, DATE_FORMAT(replies.createdOn, '%Y-%m-%d') 
                             AS createdOn FROM replies INNER JOIN users ON replies.userID = users.id 
                /* here*/             WHERE replies.page_name = 'matrix'
                             ORDER BY replies.id DESC LIMIT 1");
    } else {
        //insert into comments
        if($loggedIn != true)
        {
            $conn->query("INSERT INTO comments (userID, comment, createdOn, page_name) 
         /* here*/              VALUES ('9','$comment',NOW(),'matrix')");
        } else {
            $conn->query("INSERT INTO comments (userID, comment, createdOn, page_name) 
            /* here*/              VALUES ('".$_SESSION['userID']."','$comment',NOW(),'matrix')");
        }
        

        $sql = $conn->query("SELECT comments.id, name, comment, DATE_FORMAT(comments.createdOn, '%Y-%m-%d') 
                             AS createdOn FROM comments INNER JOIN users ON comments.userID = users.id 
            /* here*/                 WHERE comments.page_name = 'matrix'
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
                                WHERE comments.page_name = 'matrix'"); /* here*/
$numComments = $sqlNumComments->num_rows;
$sqlNumReply = $conn->query("SELECT id FROM replies
            /* here*/         WHERE replies.page_name = 'matrix'");
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
    <title>Strassen algorithm</title>
    
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
                        <a href="Matrix.php"> <i>Strassen's Algorithm</i> </a>
                    </li>
                </ol> <!--Di & Co-->

<!-- Backtracking -->
                <li class="list-group-item"> 
                    <i>Backtracking</i>
                </li>
                <ol>
                <li class="list-group-item"> 
                        <a href="../nqueen/nqueen.php"> <i>N Queen</i> </a>
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
    <h1 id="top">Strassen Algorithm</h1>
            <p class="content">
            In linear algebra, the Strassen algorithm, named after Volker Strassen, is an algorithm for matrix multiplication. It is faster than the standard matrix multiplication algorithm and is useful in practice for large matrices, but would be slower than the fastest known algorithms for extremely large matrices. 
                
            </p>
            <p class="content">
            Strassen's algorithm works for any ring, such as plus/multiply, but not all semirings, such as min-plus or boolean algebra, where the naive algorithm still works, and so called combinatorial matrix multiplication.
            </p>

            <p class="content">
            Volker Strassen first published this algorithm in 1969 and proved that the n3 general matrix multiplication algorithm wasn't optimal. The Strassen algorithm is only slightly better than that, but its publication resulted in much more research about matrix multiplication that led to faster approaches, such as the Coppersmith-Winograd algorithm.
            </p>

            

            <p class="content">
                Using Strassen algorithm we can multiply two matrices using only seven multiplications.
            </p>
            

             
            <div class="anim_container">
                <img src="../Pic/ins03.gif" alt="Insertion-sort01" class="img_anim">
            </div>
            <br>

            <!-- pseudocode -->
            <!-- <h4 class="content"> Here is the pseudocode: </h4>
            <br>
            <div class="font-weight-bold">
            <pre>
                min_coins(coin_value[],n,amount)
                {
                for( i= 1 to n )
                    while amount > = to coins[i]
                    {
                    //while loop is needed since one coin can be used multiple times
                    amount = amount - coin_value[i]
                    print coin_value[i]
                    }
                }
            </pre>
            </div> -->

            <!-- Code -->
            <h4 class="content"> CODE:</h4>
            <div class="bg-dark content">
            <pre class="text-white">
   
    #include &#60iostream>
    using namespace std;
        
    int main()
    {
        int a[2][2],b[2][2],c[2][2],i,j;
        int m1,m2,m3,m4,m5,m6,m7;

        printf("Enter the 4 elements of first matrix: ");
        for(i=0;i< 2;i++)
            for(j=0;j< 2;j++)
                scanf("%d",&a[i][j]);

        printf("Enter the 4 elements of second matrix: ");
        for(i=0;i< 2;i++)
            for(j=0;j< 2;j++)
                scanf("%d",&b[i][j]);

        printf("\nThe first matrix is\n");
        for(i=0;i< 2;i++)
        {
            printf("\n");
            for(j=0;j< 2;j++)
                printf("%d\t",a[i][j]);
        }

        printf("\nThe second matrix is\n");
        for(i=0;i< 2;i++)
        {
            printf("\n");
            for(j=0;j< 2;j++)
                printf("%d\t",b[i][j]);
        }

        m1= (a[0][0] + a[1][1])*(b[0][0]+b[1][1]);
        m2= (a[1][0]+a[1][1])*b[0][0];
        m3= a[0][0]*(b[0][1]-b[1][1]);
        m4= a[1][1]*(b[1][0]-b[0][0]);
        m5= (a[0][0]+a[0][1])*b[1][1];
        m6= (a[1][0]-a[0][0])*(b[0][0]+b[0][1]);
        m7= (a[0][1]-a[1][1])*(b[1][0]+b[1][1]);

        c[0][0]=m1+m4-m5+m7;
        c[0][1]=m3+m5;
        c[1][0]=m2+m4;
        c[1][1]=m1-m2+m3+m6;

        printf("\nAfter multiplication using \n");
        for(i=0;i< 2;i++)
        {
            printf("\n");
            for(j=0;j< 2;j++)
                printf("%d\t",c[i][j]);
        }

        return 0;
    }
                     
     </pre>
        </div>

        <!-- Complexity -->
        <h4 class="content">Complexity:</h4>
        <p class="content">The Complexity of Strassen Algorithm is: O( n <sup>log7</sup> )</p>
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
                    url: 'Matrix.php', /* here*/
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
                    url: 'Matrix.php', /* here*/
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
                    url: 'Matrix.php',  /* here*/
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
            url: 'Matrix.php',  /* here*/
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