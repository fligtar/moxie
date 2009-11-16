<?php if ($context == 'full'): ?>
<div id="global-header">
    <div id="site-name">
        <a href="<?php echo $this->url(); ?>"><strong><?php echo $site_name; ?></strong> moxie</a>
    </div>
</div>

<div class="page">
    <div id="content">
<?php endif; ?>

<div id="login-form" class="<?php echo $context; ?>">
    <form method="post" action="<?php echo $this->url('login'); ?>">
    <?php if ($context == 'global'): ?>
    <input type="hidden" name="redirect" value="<?php echo htmlentities($this->getCurrentURL()); ?>" />
    <?php endif; ?>
    <?php
    if (!empty($error)) {
        echo '<div class="error">'.$error.'</div>';
    }
    ?>
    <dl>
        <dt><label for="login-email">e-mail address</label></dt>
        <dd><input type="text" name="email" id="login-email" /></dd>
        <dt><label for="login-password">password</label></dt>
        <dd><input type="password" name="password" id="login-password" /></dd>
    </dl>
    
    <div class="actions">
        <?php if ($context == 'global'): ?>
        <a href="#" onclick="global.hideLoginForm(); return false;">never mind</a>
        <?php endif; ?>
        <?php
        // random login button. this is important
        $login_choices = array(
            'this is it!',
            'yes, please!',
            'whatever',
            'here we go!'
        );
        ?>
        <input type="submit" value="<?php echo $login_choices[array_rand($login_choices)]; ?>" />
    </div>
    </form>
</div>