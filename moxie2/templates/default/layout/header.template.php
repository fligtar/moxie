<?php $this->render('layout/head'); ?>

<div id="global-header">
    <div id="site-name">
        <a href="<?php echo $this->url(); ?>"><strong><?php echo $site_name; ?></strong> moxie</a>
    </div>
    
    <div id="account-box">
        <ul id="account-links">
        <?php if (!empty($_SESSION['id'])): ?>
            <li>hello, <a href="<?php echo $this->url('account'); ?>"><strong><?php echo htmlentities($_SESSION['name']); ?></strong></a></li>
            <?php if (true): ?>
            <li class="separator">/</li>
            <li><a href="<?php echo $this->url('admin'); ?>">admin</a></li>
            <?php endif; ?>
            <li class="separator">/</li>
            <li><a href="<?php echo $this->url('logout'); ?>">log out</a></li>
        <?php else: ?>
            <li><a href="<?php echo $this->url('login'); ?>" onclick="global.showLoginForm(); return false;">log in</a></li>
            <li class="separator">/</li>
            <li><a href="<?php echo $this->url('register'); ?>">register</a></li>
        <?php endif; ?>
        </ul>
        
        <?php $this->setAndRender('account/login', array('context' => 'global')); ?>
    </div>
</div>

<div class="page">

    <div id="header">
    <?php if (!empty($product_name)): ?>
        <ul id="toolbar">
            <li><a href="<?php echo $this->url('%product%/roadmap'); ?>">roadmap</a></li>
            <li><a href="<?php echo $this->url('%product%/milestones'); ?>">milestones</a></li>
            <li><a href="<?php echo $this->url('%product%/projects'); ?>">projects</a></li>
            <?php if (true): ?>
            <li><a href="<?php echo $this->url('%product%/settings'); ?>">settings</a></li>
            <?php endif; ?>
        </ul>

        <div id="title">
            <a href="<?php echo $this->url('%product%'); ?>">
                <img id="logo" src="<?php echo $this->image('logo.png') ?>" alt="<?php echo $product_name; ?> logo" />
            </a>
            
            <div>
                <h1><a href="<?php echo $this->url('%product%'); ?>"><?php echo $product_name; ?></a></h1>
                <?php
                if (!empty($page_type) || !empty($page_name)) {
                    echo '<h2>';
                    
                    if (!empty($page_type)) {
                        echo '<span><a href="'.$this->url('%product%/'.$page_type).'">'.$page_type.'</a>';
                        
                        if (!empty($page_name)) {
                            echo ' &raquo; ';
                        }
                        
                        echo '</span>';
                    }
                    
                    if (!empty($page_name)) {
                        echo $page_name;
                    }
                    
                    echo '</h2>';
                }
                ?>
            </div>
        </div>
    <?php endif; ?>
    </div>

    <div id="content">