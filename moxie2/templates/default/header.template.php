<div id="global-header">
    <div id="breadcrumbs">
        <a href="<?php echo $this->getBaseURL(); ?>"><?php echo $vars['site_name']; ?> moxie</a>
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

<div class="page">

    <div id="header">
    <?php if (PAGE != 'index'): ?>
        <ul id="toolbar">
            <li><a href="<?php echo $vars['product_base_url'].'/roadmap'; ?>">roadmap</a></li>
            <li><a href="<?php echo $vars['product_base_url'].'/milestones'; ?>">milestones</a></li>
            <li><a href="<?php echo $vars['product_base_url'].'/projects'; ?>">projects</a></li>
        </ul>
    <?php endif; ?>
    
    <?php if (!empty($vars['product_name'])): ?>
        <div id="title">
            <a href="<?php echo $vars['product_base_url']; ?>">
                <img id="logo" src="<?php echo $this->image('logo.png') ?>" alt="<?php echo $vars['product_name']; ?> logo" />
            </a>
            
            <div>
                <h1><a href="<?php echo $vars['product_base_url']; ?>"><?php echo $vars['product_name']; ?></a></h1>
                <?php
                if (!empty($vars['page_type']) || !empty($vars['page_name'])) {
                    echo '<h2>';
                    
                    if (!empty($vars['page_type'])) {
                        echo '<span><a href="'.$vars['product_base_url'].'/'.$vars['page_type'].'">'.$vars['page_type'].'</a>';
                        
                        if (!empty($vars['page_name'])) {
                            echo ' &raquo; ';
                        }
                        
                        echo '</span>';
                    }
                    
                    if (!empty($vars['page_name'])) {
                        echo $vars['page_name'];
                    }
                    
                    echo '</h2>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <div id="content">