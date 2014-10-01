<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login'] == "true") {
    header("location:index.php");
}
$title = "Login";
?>

<?php include('includes/head.php'); ?>
<?php include('includes/header.php'); ?>


<div class="container-fluid">
    <div class="row">
        <?php include('includes/leftNavigation.php'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo $title ?></h1>

            <div class="row placeholders">
                <?php echo (isset($_SESSION['error'])?'<span style="color:red">'.$_SESSION['error'].'</span>':null);?>
                <form role="form" class="form-signin" method="post" action="checklogin.php">
                    <h2 class="form-signin-heading">Please log in</h2>
                    <input value="<?php if (isset($_COOKIE['remember_me'])) echo $_COOKIE['remember_me']; ?>" name="username" type="text" equired autofocus placeholder="Username" class="form-control">
                    <input name="password" type="password" required placeholder="Password" class="form-control">
                    <label class="checkbox">
                        <input name="remember" type="checkbox" value="remember_me" <?php if (isset($_COOKIE['remember_me'])) echo 'checked' ?>> Remember me
                    </label>
                    <button type="submit" class="btn btn-lg btn-primary btn-block">Log in</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
<?php
    unset($_SESSION['error']);
?>
