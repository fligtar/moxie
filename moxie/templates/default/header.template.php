<div id="global-header">
    <div id="breadcrumbs">
        <ul>
        <?php
            if (!empty($this->breadcrumbs)) {
                foreach ($this->breadcrumbs as $url => $name) {
                    if (isset($first)) {
                        echo '<li class="spacer">&raquo;</li>';
                    }
                    else {
                        $first = true;
                    }
                    echo '<li><a href="'.$url.'">'.$name.'</a></li>';
                }
            }
        ?>
        </ul>
    </div>
    
    <div id="account-box">
        <div id="login-form">
            <form method="post" action="">
                <label>E-mail</label>
                <input type="text" name="email" />
                <label>Password</label>
                <input type="password" name="password" />
                <input type="submit" value="Log in" />
            </form>
        </div>
        
        <ul id="account-links">
            <!--<li><a href="#">Log in</a></li>
            <li><a href="#">Sign up</a></li>-->
            <li><a href="#">Logged in as <b>fligtar@gmail.com</b></a></li>
            <li><a href="#">Log out</a></li>
        </ul>
    </div>
</div>

<div id="page">

    <div id="header">
        <ul id="toolbar">
            <li><a href="#">project</a></li>
            <li><a href="#">milestone</a></li>
        </ul>
    
        <div id="title">
            <img id="logo" src="<?php echo $this->image('logo.png') ?>" alt="<?php echo $vars['project']['name']; ?> logo" />
            <h1><?php echo $vars['project']['name']; ?></h1>
            <h2><?php echo $vars['milestone']['name']; ?></h2>
        </div>
    </div>

    <div id="content">