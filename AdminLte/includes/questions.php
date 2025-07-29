<?php
include 'AdminController/AdminUserController.php';
$users = new AdminUserController();


// Store selected class category in session if passed via GET
if (isset($_GET['class'])) {
    $_SESSION['selected_class'] = $_GET['class'];
}

// Check if class is stored in session
if (!isset($_SESSION['selected_class'])) {
    echo "<div class='alert alert-danger'>No class selected. Please go back and choose a class.</div>";
    exit;
}

$selectedClass = $_SESSION['selected_class'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $class = $_POST['class'];
    $subject = $_POST['subject'];
    $questionText = $_POST['question'];
    $a = $_POST['a'];
    $b = $_POST['b'];
    $c = $_POST['c'];
    $d = $_POST['d'];
    $correct = $_POST['correct'];

    if ($users->addQuestion($class, $subject, $questionText, $a, $b, $c, $d, $correct)) {
        echo "<div class='alert alert-success'>Question added!</div>";
    } else {
        echo "<div class='alert alert-danger'>Failed to add question.</div>";
    }
}
?>
<link rel="stylesheet" href="css/bootstrap.min.css">


<div class="container">
    <div class="row justify-content-center mb-5 p-2">
        <div class="col-md-6">
            <a href="../adminDashboard.php?category" class="btn btn-success">Back</a>
            <form class="form-control mt-5" method="POST">
                <h4 class="text-center mt-3">Log in</h4>
                <div class="">
                    <label for="staticemail" class="col-sm-2 col-form-label">Class:</label>
                    <div class="">
                         <input type="text" class="form-control" name="class" readonly placeholder="<?= $selectedClass ?>" required>
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Subject:</label>
                    <div class="">
              
                     <select name="subject" id="" class="form-select">
                        <option value="Basic Science">Basic Science</option>
                        <option value="English">English</option>
                        <option value="Mathematics">Mathematics</option>
                        <option value="Civic">Civic</option>
                     </select>
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Question:</label>
                    <div class="">
                    <textarea name="question" class="form-control" class="form-control" placeholder="Enter question" required></textarea>
                    </div>
                </div>
        
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Option A:</label>
                    <div class="">
                    <input type="text" name="a" class="form-control" class="form-control" placeholder="Option A" required>
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="form-control" class="form-control" class="col-sm-2 col-form-label">Option B:</label>
                    <div class="">
                    <input type="text" class="form-control" name="b" placeholder="Option B" required>
                    </div>
                </div>
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Option c:</label>
                    <div class="">
                    <input type="text" name="c" class="form-control" placeholder="Option C" required>
                    </div>
                </div>
    

                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Option D:</label>
                    <div class="">
                    <input type="text" name="d" class="form-control" placeholder="Option D" required>
                    </div>
                </div>

                
                <div class="">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Option D:</label>
                    <div class="">
                    <input type="text" class="form-control" name="correct" placeholder="Correct option (A/B/C/D)" maxlength="1" required>
                    </div>
                </div>
               

               
    <button type="submit" class="btn btn-success">Add Question</button>
                
            </form>
        </div>
    </div>

</div>
