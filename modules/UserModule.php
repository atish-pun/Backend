<?php
class UserModule extends DBconnectionModule{
    function __construct(){
        parent::__construct();
    }

    public static function CheckUser_CLIENT(){
        if(isset($_SESSION[GlobalVariables::$USER_SESSION_ID_STR_CLIENT])){ return TRUE; } else{ return FALSE; }
    }

    public static function logout(){
        unset($_SESSION[GlobalVariables::$USER_SESSION_ID_STR_CLIENT]);
        unset($_SESSION[GlobalVariables::$USER_SESSION_FULLNAME_STR_CLIENT]);
        unset($_SESSION[GlobalVariables::$USER_SESSION_EMAIL_STR_CLIENT]);
        unset($_SESSION[GlobalVariables::$USER_SESSION_TYPE_STR_CLIENT]);
        header("location:login.php");
    }

    function login($email,$pass){
        $statement = $this->connection->prepare("SELECT id, name, email, type FROM `users` where email=? and password=? and type='ADMIN'");
        if($statement){
            $statement->bind_param("ss", $email, $pass);
            if($statement->execute()){
                $statement->store_result();
                $statement->bind_result($id, $name, $email, $type);
                $statement->fetch();
                if($statement->num_rows > 0){
                    $_SESSION[GlobalVariables::$USER_SESSION_ID_STR_CLIENT] = $id;
                    $_SESSION[GlobalVariables::$USER_SESSION_FULLNAME_STR_CLIENT] = $name;
                    $_SESSION[GlobalVariables::$USER_SESSION_EMAIL_STR_CLIENT] = $email;
                    $_SESSION[GlobalVariables::$USER_SESSION_TYPE_STR_CLIENT] = $type;
                    header("location:index.php");
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }
    }

    function userList(){
        $datalist = [ "data" => [] ];
        $statement = $this->connection->prepare("select id, name, email, address, phone, type, created_at from users");
        if($statement){
            $statement->execute();
            $statement->bind_result($id, $name, $email, $address, $phone, $type, $created_at);
            $sn = 0;
            while($statement->fetch()){
                $sn++;
                $remove = "<a class='remove' data-id='".$id."' href='#'>Remove</a>";
                if($type == "ADMIN") $remove = "";
                $datalist["data"][] = [
                    "sn" => ($sn),
                    "name" => $name,
                    "email" => $email,
                    "address" => $address,
                    "phone" => $phone,
                    "type" => $type,
                    "created_at" => $created_at,
                    "action" => $remove
                ];
            }
        }
        return $datalist;
    }

    function removeUser($data){
        $id = $data["id"];
        $statement = $this->connection->prepare("delete from users where id=?");
        if($statement){
            $statement->bind_param("i", $id);
            return $statement->execute();
        }
        else return false;
    }

    function profileInfo(){
        $statement = $this->connection->prepare("select id, name, email, address, phone from `users` where id=?");
        if($statement){
            $statement->bind_param("s", $_SESSION[GlobalVariables::$USER_SESSION_ID_STR_CLIENT]);
            if($statement->execute()){
                $statement->store_result();
                $statement->bind_result($id, $name, $email, $address, $phone);
                $statement->fetch();
                if($statement->num_rows > 0) return ["id" => $id, "name" => $name, "email" => $email, "address" => $address, "phone" => $phone];
                else return false;
            }
            else return false;
        }
        else return false;
    }

    function profileSave($data){
        $statement = $this->connection->prepare("update users set name=?, address=?, phone=? where id=?");
        if($statement){
            $statement->bind_param("ssss", $name, $address, $phone, $id);
            $name = $data["fullname"];
            $address = $data["address"];
            $phone = $data["phone"];
            $id = $_SESSION[GlobalVariables::$USER_SESSION_ID_STR_CLIENT];
            $statement->execute();

            $_SESSION[GlobalVariables::$USER_SESSION_FULLNAME_STR_CLIENT] = $name;
            return true;
        }
        else return false;
    }

    //API Methods
   function API_login($data){
        if(isset($data['emailAddress']) && isset($data['Password'])){
            $statement = $this->connection->prepare("select id, fullName, emailAddress, Favourite_token from `account_sign` where emailAddress=? and Password=?");
            if($statement){
                $emailAddress = $data['emailAddress']; 
                $Password = $data['Password'];
                $statement->bind_param("ss", $emailAddress, $Password);
                if($statement->execute()){
                    $statement->store_result();
                    $statement->bind_result($id, $fullName, $emailAddress, $Favourite_token);
                    $statement->fetch();
                    if($statement->num_rows > 0){
                            $key = AuthModule::SessionKey();
                            return ["status" => 200, "content" => "Welcome, ".$fullName, "id" => $id, "emailAddress" => $emailAddress, "fullName" => $fullName, "Favourite_token" => $Favourite_token, "session" => $key];
                       
                    }
                    else return ["status" => 400, "content" => "Email & Password not found."];
                }
                else return ["status" => 400, "content" => "Email & Password not found."];
            }
            else return ["status" => 400, "content" => "Email & Password not found."];
        }
        else return ["status" => 400, "content" => "Email & Password not found."];
    }


    function API_createUser($data){
        try{
            $statement = $this->connection->prepare("insert into `account_sign` (fullName, emailAddress, Password) values (?, ?, ?)");
            if($statement){
                $statement->bind_param("sss", $fullName, $emailAddress, $Password);
                $fullName = $data["fullName"];
                $emailAddress = $data["emailAddress"];
                $Password = $data["Password"];
                if($statement->execute()) return ["status" => 200];
                else return ["status" => 400, "content" => $statement->error];
            }
            else{
                return ["status" => 400, "content" => $this->connection->error];
            }
        }
        catch(Exception $ex){
            return ["status" => 400, "content" => $ex];
        }
    }

    function API_updatePassword($data){
        //Select either password matched and update accordingly
        $user_id = $data["uid"];
        $email = $data["email"];
        $password = $data["password"];
        $npassword = $data["npassword"];
        
        $select_statement = $this->connection->prepare("select `id` as id from `users` where id=? and email=? and password=?");
        if($select_statement){
            $select_statement->bind_param("sss", $user_id, $email, $password);
            if($select_statement->execute()){
                $select_statement->store_result();
                $select_statement->bind_result($selecttoken);
                $select_statement->fetch();
                if($select_statement->num_rows > 0){ //Password Matched
                    $update_statement = $this->connection->prepare("update users set password=? where id=?");
                    if($update_statement){
                        $update_statement->bind_param("ss", $npassword, $user_id);
                        $npassword = $data["npassword"];
                        if($update_statement->execute()) return ["status" => 200, "content" => "Password updated."];
                        return ["status" => 400, "content" => "Error . Code - 0x2104"];
                    }
                    else return ["status" => 400, "content" => "Error . Code - 0x2103"];
                }
                else{
                    return ["status" => 400, "content" => "Password does not matched."]; //Password Does Not Matched
                }
            }
            else return ["status" => 400, "content" => "Error . Code - 0x2102"];
        }
        else return ["status" => 400, "content" => "Error . Code - 0x2101"];
    }

    function API_saveProfileInfo($data){
        $statement = $this->connection->prepare("update users set name=?, address=?, phone=? where id=? and email=? and type='CUSTOMER'");
        if($statement){
            $statement->bind_param("sssss", $name, $address, $phone, $id, $email);
            $name = $data["fullname"];
            $address = $data["address"];
            $phone = $data["phone"];

            $id = $data["id"];
            $email = $data["email"];
            if($statement->execute()) return ["status" => 200, "content" => "Profile info updated."];
            else return ["status" => 400, "content" => "Error. Code: 0x2002"];
        }
        else return ["status" => 400, "content" => "Error. Code: 0x2001"];
    }
}
?>