<div id="global-header">
    <div id="site-name">
        <a href="<?php echo $this->getBaseURL(); ?>"><strong><?php echo $vars['site_name']; ?></strong> moxie</a>
    </div>
    
    <div id="account-box">
        <ul id="account-links">
        <?php if (!empty($_SESSION['id'])): ?>
            <li>hello, <a href="<?php echo $this->getBaseURL(); ?>/account"><strong>Justin Scott</strong></a></li>
            <li class="separator">/</li>
            <li><a href="<?php echo $this->getBaseURL(); ?>/logout">log out</a></li>
        <?php else: ?>
            <li><a href="<?php echo $this->getBaseURL(); ?>/login" onclick="global.showLoginForm(); return false;">log in</a></li>
            <li class="separator">/</li>
            <li><a href="<?php echo $this->getBaseURL(); ?>/register">register</a></li>
        <?php endif; ?>
        </ul>
        
        <div id="login-form">
            <form method="post" action="<?php echo $this->getBaseURL(); ?>/login">
            <input type="hidden" name="redirect" value="<?php echo htmlentities($this->getCurrentURL()); ?>" />
            <dl>
                <dt><label for="login_email">e-mail address</label></dt>
                <dd><input type="text" name="email" id="login_email" /></dd>
                <dt><label for="login_password">password</label></dt>
                <dd><input type="password" name="password" id="login_password" /></dd>
            </dl>
            
            <div class="actions">
                <a href="#" onclick="global.hideLoginForm(); return false;">never mind</a>
                <?php
                // random login button. this is important
                $login_choices = array(
                    'this is it!',
                    'yes, please!',
                    'whatever',
                    'here we go!'
                );
                $this->getCurrentURL();
                ?>
                <input type="submit" value="<?php echo $login_choices[array_rand($login_choices)]; ?>" />
            </div>
            </form>
        </div>
    </div>
</div>

<div class="page">

    <div id="header">
    <?php if (!empty($vars['product_name'])): ?>
        <ul id="toolbar">
            <li><a href="<?php echo $vars['product_base_url'].'/roadmap'; ?>">roadmap</a></li>
            <li><a href="<?php echo $vars['product_base_url'].'/milestones'; ?>">milestones</a></li>
            <li><a href="<?php echo $vars['product_base_url'].'/projects'; ?>">projects</a></li>
        </ul>

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
    <?php endif; ?>
    </div>

    <div id="content">