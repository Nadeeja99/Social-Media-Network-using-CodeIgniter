
<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>PicsShare</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        

    </head>

    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">


            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand mt-2 mt-lg-0" href="<?php echo site_url('/PostController/userTimeLine'); ?>">
                <img
                src=<?php echo base_url('./uploads/picsshare-logo.png'); ?>
                height="50"
                width=100%
                alt="picsshare"
                loading="lazy"
                />
            </a>
            </div>
            <div class="d-flex align-items-center">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('/PostController/getAllUserPost'); ?>">
                    Explore</i>
                </a>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('index.php/UserController/LogoutUser'); ?>">
                    Logout</i>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="<?php echo site_url('/PostController/userProfileView'); ?>"><?php echo $this->session->userdata('username'); ?></a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

