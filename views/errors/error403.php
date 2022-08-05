<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require '../views/shared/header.php';
    ?>
</head>

<body>
    <?php
    require '../views/shared/noscript.php';
    ?>

    <div id="app">
        <div class="container">
            <?php
            require '../views/shared/navbar.php';
            ?>
            <div class="error" class="col-lg-12" align="center">
                <h2>403 | Unauthorized</h2>
            </div>
        </div>
    </div>

    <style scoped>
        .error {
            margin-top: 30%;
        }
    </style>
    <script defer>
    </script>
</body>

</html>