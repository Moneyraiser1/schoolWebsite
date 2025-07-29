<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    require_once __DIR__ . "/../AdminAbstract/Admininterface.php";
    require_once __DIR__ . "/../Model/Database.php";

    class AdminUserController implements AdminInterface{
        private $username;
        private $userid;
        private $phone;
        private $class;
        private $userPassword;
        private $db;
        public function __construct(){
            $this->db =  new Database();
        }
       
        public function register($userid, $username, $phone, $userPassword, $class){
            $this->userid = $userid;
            $this->username = $username;
            $this->phone = $phone;
            $this->userPassword = $userPassword;
            $this->class = $class;

            if(empty($this->userid) || empty($this->username) || empty($this->phone) || empty($this->userPassword) || empty($this->class)){
                return "fields required!";
            }

            
            $this->db->query("SELECT * FROM students WHERE userId=:em");
            $this->db->bind(':em', $this->userid);
            $row = $this->db->singleRecord();
            if($row){
                return "User already in Records";
            }

                    $this->userPassword = password_hash($this->userPassword, PASSWORD_DEFAULT);


                    $this->db->query('INSERT INTO students(userId, username, phone_number, password, class) VALUES(:ui, :un, :pn, :up, :class)');
                    $this->db->bind(':ui', $this->userid); 
                    $this->db->bind(':un', $this->username); 
                    $this->db->bind(':pn', $this->phone); 
                    $this->db->bind(':up', $this->userPassword); 
                    $this->db->bind(':class', $this->class);  

                    if($this->db->execute()){
                        return true;
                    }
            }
        
        public function Logout(){
            unset($_SESSION['userid']);
            unset($_SESSION['userem']);
        }      
        
        public function showUsers(){
            $this->db->query('SELECT * FROM students WHERE Class IS NOT NULL');
            $rows = $this->db->resultSetObj();

            if(count($rows) > 0){
                return $rows;
            }else{
                return false;
            }

        }
        public function remove($id){
            //$this->role = $role;
            $role = "User";
            $this->db->query('DELETE FROM user WHERE userid=:uid AND role=:role');
            $this->db->bind(':uid', $id);
            $this->db->bind(':role', $role);
            
            if($this->db->execute()){
                header('Location: adminDashboard.php?register');
                return 'User removed successfully';
            }else{
                return false;
            }
        }

        public function singleUser($userid){
            $this->db->query("SELECT * FROM students WHERE id=:uid");
            $this->db->bind(":uid", $userid);
            return $this->db->singleRecord();
            
        }
        
        public function adminChangePassword($id, $userid, $username, $phone, $class, $schoolFee) {
            $this->db->query("SELECT * FROM students WHERE id = :id");
            $this->db->bind(":id", $id);
            $row = $this->db->singleRecordObj();
        
            if (!$row) {
                return "User not found.";
            }
        
            $this->db->query("UPDATE students SET userId = :ui, username = :un, phone_number = :ph, Class = :cl, school_fees =:sf WHERE id = :id");
            $this->db->bind(":ui", $userid);
            $this->db->bind(":un", $username);
            $this->db->bind(":ph", $phone);
            $this->db->bind(":cl", $class);
            $this->db->bind(":sf", $schoolFee);
            $this->db->bind(":id", $id);
        
            return $this->db->execute() ? true : "Failed to update user details.";
        }

        

    public function fetchComplaints() {
        $this->db->query("SELECT * FROM contact ORDER BY is_read = 'read' ASC, date_sent DESC");
        return $this->db->resultSet();
    }
    public function countContact() {
        $this->db->query("SELECT COUNT(*) as num_message FROM contact WHERE is_read = 'read'");
            return $this->db->singleRecordObj();
    }
    public function markAsRead($id) {
        $this->db->query("UPDATE contact SET is_read = 'read' WHERE id = :id");
        $this->db->bind(":id", $id);
        if($this->db->execute()){
            return true;
        }
    }

    // public function getNewComplaints() {

    //     $this->db->query("SELECT * FROM contact WHERE is_read = 0");
    //     return $this->db->resultSet();
    // }
    public function addQuestion($class, $subject, $question, $a, $b, $c, $d, $correct) {
        $this->db->query("INSERT INTO questions (class_level, subject, question, option_a, option_b, option_c, option_d, correct_option) 
                                      VALUES (:class, :subject, :question, :a, :b, :c, :d, :correct)");
    
    $this->db->bind(':class', $class);
    $this->db->bind(':subject', $subject);
    $this->db->bind(':question', $question);
    $this->db->bind(':a', $a);
    $this->db->bind(':b', $b);
    $this->db->bind(':c', $c);
    $this->db->bind(':d', $d);
    $this->db->bind(':correct', $correct);
    
        return $this->db->execute();
    }

    public function countRegisteredStudents() {
            $this->db->query("SELECT COUNT(*) as num_students FROM students WHERE role_as = 0");
            return $this->db->singleRecordObj(); // Make sure you return the result
        }

  
    
    }
 
