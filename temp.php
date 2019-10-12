

 $sql = $conn->query("SELECT id FROM users WHERE name='$name'");

        if ($sql->num_rows > 0)
            exit('failedUserNameExists');


 else if (response === 'failedUserNameExists')
                            alert('User with this username already exists!');