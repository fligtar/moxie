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
            <?php if (PAGE != 'index'): ?>
            <li>
                <a href="#" onclick="return false;" class="tab">product</a>
                <ul class="menu">
                    <li><a href="<?php echo $vars['product_base_url'].'/roadmap'; ?>">roadmap</a></li>
                    <li><a href="<?php echo $vars['product_base_url'].'/milestones'; ?>">milestones</a></li>
                    <li><a href="<?php echo $vars['product_base_url'].'/projects'; ?>">projects</a></li>
                    <li class="separator"></li>
                    <li><a href="#" onclick="return false;">edit product</a></li>
                    <li class="separator"></li>
                    <li><a href="#" onclick="return false;">new milestone</a></li>
                    <li><a href="#" onclick="return false;">new project</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if (PAGE == 'milestone'): ?>
            <li>
                <a href="#" onclick="return false;" class="tab">milestone</a>
                <ul class="menu">
                    <li><a href="#" onclick="return false;">edit milestone</a></li>
                    <li><a href="#" onclick="return false;">refresh status</a></li>
                    <li class="separator"></li>
                    <li><a href="#" onclick="return false;">new project</a></li>
                </ul>
            </li>
            <?php endif; ?>
            <?php if (PAGE == 'project'): ?>
            <li>
                <a href="#" onclick="return false;" class="tab">project</a>
                <ul class="menu">
                    <li><a href="#" onclick="return false;">edit project</a></li>
                    <li><a href="#" onclick="return false;">assign to milestone</a></li>
                    <li><a href="#" onclick="return false;">organize deliverables</a></li>
                    <li class="separator"></li>
                    <li><a href="#" onclick="return false;">new deliverable</a></li>
                </ul>
            </li>
            <?php endif; ?>
        </ul>

        <div id="title">
            <img id="logo" src="<?php echo $this->image('logo.png') ?>" alt="<?php echo $vars['product']['name']; ?> logo" />
            <?php if (!empty($vars['page_title'])) { echo "<h1>{$vars['page_title']}</h1>"; } ?>
            <?php if (!empty($vars['page_subtitle'])) { echo "<h2>{$vars['page_subtitle']}</h2>"; } ?>
        </div>
    </div>

    <div id="content">