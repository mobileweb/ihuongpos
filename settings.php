<?php include('includes/head.php'); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/utils.php'); ?>

<?php

    $title = "Settings";

    $config = simplexml_load_file("xml/config.xml");

    if (isset($_POST['APIKey'])) {
        try {
            $newAPIKey = $_POST['APIKey'];
            $config->key = $newAPIKey;
            $config->asXML("xml/config.xml");
            $_SESSION['setting_ok']='Settings have been saved successfully.';
        } catch (Exception $ex) {
            $_SESSION['setting_error']='Save error.';
        }
    }

    if (isset($_POST['username']) && $_POST['username'] != "") {
        try {
            $newUsername = $_POST['username'];
            $config->logins->login[0]->username = $newUsername;
            $config->asXML("xml/config.xml");
            $_SESSION['setting_ok']='Settings have been saved successfully.';
        } catch (Exception $ex) {
            $_SESSION['setting_error']='Save error.';
        }
    }

    if (isset($_POST['password']) && $_POST['password'] != "") {
        try {
            $newPassword = $_POST['password'];
            $newPassword = doHash($newPassword);
            $config->logins->login[0]->password = $newPassword;
            $config->asXML("xml/config.xml");
            $_SESSION['setting_ok']='Settings have been saved successfully.';
        } catch (Exception $ex) {
            $_SESSION['setting_error']='Save error.';
        }
    }

    $APIKey = $config->key;
    $username = $config->logins->login[0]->username;
?>
<div class="container-fluid">
    <div class="row">
        <?php include('includes/leftNavigation.php'); ?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
            <h1 class="page-header"><?php echo $title ?></h1>

            <div class="row">
                <?php echo (isset($_SESSION['setting_ok'])?'<span style="color:green">'.$_SESSION['setting_ok'].'</span>':null);?>
                <?php echo (isset($_SESSION['setting_error'])?'<span style="color:red">'.$_SESSION['setting_error'].'</span>':null);?>
                <form id="settingForm" name="settingForm" role="form" method="post">
                    <h4>API Key</h4>
                    <input value="<?php echo $APIKey?>" id="APIKey" name="APIKey" type="text" class="form-control" placeholder="API Key" required autofocus><br/>
                    <h4>Username</h4>
                    <input required value="<?php echo $username?>" pattern=".{4,}" title="Minimum length is 4" id="username" name="username" type="text" class="form-control" placeholder="Username"><br/>
                    <h4>Password</h4>
                    <input autocomplete="off" pattern=".{4,}" title="Minimum length is 4" id="password" name="password" type="password" class="form-control" placeholder="Password"><br/>
                    <button id="submitButton" disabled class="btn btn-lg btn-primary btn-block" type="submit">Save</button>
                </form>
            </div>
        </div>

    </div>
</div>

<?php include('includes/footer.php'); ?>
?>
<?php
    unset($_SESSION['setting_error']);
    unset($_SESSION['setting_ok']);
?>
