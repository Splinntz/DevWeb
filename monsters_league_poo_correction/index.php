<?php

require __DIR__ . '/functions.php';

$monsters = getMonstersObjet();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Monsters League</title>

        <!-- CSS files -->
        <link rel="stylesheet" href="bootstrap-4.1.3-dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">Monsters League</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

                <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>

        <div class="jumbotron">
            <h1 class="display-4">Hello, world!</h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
            <hr class="my-4">
        </div>

        <div class="container">
            <table class="table table-hover">
                <caption><i class="fas fa-info"></i> Members of the monster league</caption>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Strength</th>
                        <th>Life</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($monsters as $monster) { ?>
                        <tr>
                            <td><?php echo $monster->getName(); ?></td>
                            <td><?php echo $monster->getStrength(); ?></td>
                            <td><?php echo $monster->getLife(); ?></td>
                            <td><?php echo $monster->getType(); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <form method="post">
                <legend>Add monster </legend>
                <fieldset>
                <label for="name" > Name<em>*</em></label> <input type="text" id="name" name="name">	
		        <label for="strength"> Strength <em>*</em> <input type="int" id="strength" name="strength" >
		        <label for="life"> Life <em>*</em> <input type="int" id="life" name="life" >
                <label for="type"> Type <em>*</em> <input type="text" id="type" name="type">
                <input type="submit" value="Add Monster">
                </fieldset>
            </form>
            
            <?php

            if ((isset($_POST['name']) && !empty($_POST['name'])) 
            && (isset($_POST['strength']) && !empty($_POST['strength'])) 
            && (isset($_POST['life']) && !empty($_POST['life']))
            && (isset($_POST['type']) && !empty($_POST['type']))) {

                $dsn = 'mysql:host=localhost;dbname=monsters';
                $username = 'root';
                $password = 'newPass';
                $dbh = new PDO($dsn, $username, $password);
                $name = $_POST['name'];	
                $strength = $_POST['strength'];
                $life = $_POST['life'];
                $type = $_POST['type'];
                $query = "INSERT INTO monster ( name, strength, life, type)
                VALUES( '".$name."', '".$strength."', '".$life."', '".$type."')";
                $result = $dbh -> query($query);
                $monster = $result -> fetchAll();
                //echo ("done");
                header('Location: index.php');
            }
            else {
                //echo "fail";
            }
?>

            <div class="row border p-3">
                <div class="form-group col-md-6 offset-md-3">
                    <form method="POST" action="fight.php">
                        <h2 class="text-center">The battle</h2>
                        <select class=" form-control" name="first_monster_name">
                            <option value="">Choose a Monster</option>
                            <?php foreach ($monsters as $key => $monster) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $monster->getName(); ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <p class="text-center">AGAINST</p>
                        <br>
                        <select class="form-control" name="second_monster_name">
                            <option value="">Choose a Monster</option>
                            <?php foreach ($monsters as $key => $monster) { ?>
                                <option value="<?php echo $key; ?>"><?php echo $monster->getName(); ?></option>
                            <?php } ?>
                        </select>
                        <br>
                        <button class="btn btn-md btn-danger center-block" type="submit">Fight!</button>
                    </form>
                </div>
            </div>
        </div>

        <footer>
            <div class="container">
                <p>Copyright © 2019 Monsters League</p>
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="bootstrap-4.1.3-dist/js/bootstrap.min.js"></script>
    </body>
</html>