<?php
$categories = ['JSS1', 'JSS2', 'JSS3', 'SS1', 'SS2', 'SS3'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Select Class</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 20px;
            margin-bottom: 20px;
            min-height: 160px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            text-align: center;
        }
        .card h4 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h3 class="text-center" style="margin-top: 40px; margin-bottom: 30px;">Choose Your Class</h3>
    <div class="row">
        <?php foreach ($categories as $category): ?>
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <h4><?= $category ?></h4>
                    <a href="includes/questions.php?class=<?= $category ?>" class="btn btn-primary">Start</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</body>
</html>

