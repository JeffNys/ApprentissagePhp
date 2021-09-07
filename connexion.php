<?php
session_start();
include('./script/functions.php');

if (!empty($_POST)) {
    $securePost = treatFormData(
        $_POST,
        "email",
        "password",
    );
    extract($securePost, EXTR_OVERWRITE);

    $data = openDB();
    $users = $data["user"];
    foreach ($users as $user) {
        if ($email == $user["email"]) {
            $canConnect = password_verify($password, $user["password"]);
            if ($canConnect) {
                $_SESSION["user"] = [
                    "name" => $user["name"],
                    "firstName" => $user["firstName"],
                    "email" => $user["email"],
                    "role" => $user["role"],
                ];
                header("Location: /");
            }
        }
    }
    $errorMessage = "le courriel ou le mot de passe est invalide";
}
?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.min.css">

    <title>Connexion</title>
</head>

<body>
    <?php include("./partial/_navBar.php"); ?>
    <div class="container">
        <h1>Connexion</h1>

        <?php if ($errorMessage) : ?>
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <h4 class="alert-heading">Attention!</h4>
                <p class="mb-0"><?php echo $errorMessage ?></p>
            </div>
        <?php endif ?>

        <form method="post">
            <div class="form-group">
                <label class="col-form-label" for="email">Courriel : </label>
                <input type="email" class="form-control border border-3" name="email">
            </div>
            <div class="form-group">
                <label class="col-form-label" for="password">Mot de passe : </label>
                <input type="password" class="form-control border border-3" name="password">
            </div>
            <input class="btn btn-primary mb-4 mt-3" type="submit" value="S'inscrire">
        </form>
    </div>
    <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>