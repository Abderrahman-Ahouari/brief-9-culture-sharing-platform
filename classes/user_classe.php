 <?php
 require('connection.php');
class users{
        private $id;
        private $first_name;
        private $last_name;
        private $email;
        private $phone;
        private $password;
        private $role;
     
     public function getid() {
        return $this->id;
    }

    public function getfirstName() {
        return $this->first_name;
    }

    public function getlastName() {
        return $this->last_name;
    }

    public function getemail() {
        return $this->email;
    }

    public function getphone() {
        return $this->phone;
    }

    public function getpassword() {
        return $this->password;
    }

    public function setid($id) {
        $this->id = $id;
    }

    public function setfirstname($first_name) {
        if (preg_match("/^[a-zA-Z]+$/", $first_name)) {
            $this->first_name = $first_name;
        } else {
            die("Invalid first name.");
        }
    }
    
    public function setlastname($last_name) {
        if (preg_match("/^[a-zA-Z]+$/", $last_name)) {
            $this->last_name = $last_name;
        } else {
            die("Invalid last name.");
        }
    }
    public function setemail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email = $email;
        } else {
            die("Invalid email format.");
        }
    }
    public function setphone($phone) {
        if (preg_match("/^\+?[0-9]{10,15}$/",    $phone)) {
            $this->phone = $phone;
        } else {
            die("Invalid phone number.");
        }
    }
    public function setpassword($password) {
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
            $this->password = $hashed_password;
    }
    
    public function setrole($role) {
        if (preg_match("/^[a-z]+$/", $role)) {
            $this->role = $role;
        } else {
            die("Invalid role.");
        }
    }
    public function getrole(){
        return $this->role;
    }


    public function signup($first_name, $last_name, $email, $phone, $password, $role){
        session_start(); 
       try{ 

        $db_connect = new Database_connection;
        $connection = $db_connect->connect();

        $sql = "INSERT INTO users(first_name, last_name, email, phone, password, role) 
VALUES(:first_name, :last_name, :email, :phone, :password , :role);";

$hashed_password = password_hash($password,PASSWORD_DEFAULT);

        $query = $connection->prepare($sql);

        $query->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $query->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':phone', $phone, PDO::PARAM_STR);
        $query->bindParam(':password', $hashed_password, PDO::PARAM_STR);
        $query->bindParam(':role', $role, PDO::PARAM_STR);   
        
        $query->execute(); 
        $db_connect->disconnect(); 

    $_SESSION['id'] = $connection->lastInsertId();
    $_SESSION['role'] = $role;
    }catch(PDOException $error){
      die("an error while registering" . $error->getMessage());
    }   
             }


    public function login($email, $password){
        session_start();
        try{
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
            
            $sql="SELECT * FROM users WHERE email=:email;";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':email', $email, PDO::PARAM_STR);
    
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);

                
                if($user && password_verify($password, $user['password']) ){
                $_SESSION['id'] = $user['id'];             
                $_SESSION['role'] = $user['role'];
            }else{
                die("Invalid email or password.");
            }
      
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in login: " . $error->getMessage());
        }
        
    }
    
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
    }   

}  
     

?>

   