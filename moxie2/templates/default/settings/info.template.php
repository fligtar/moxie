<?php if (!empty($success_message)) echo '<div class="success-notice">'.$success_message.'</div>'; ?>
<?php if (!empty($error_message)) echo '<div class="error-notice">'.$error_message.'</div>'; ?>

<div class="spacious-form">
<form method="post" action="">
    <dl<?php if (!empty($errors['name'])) echo ' class="errors"'; ?>>
        <dt><label for="info-name">product name</label></dt>
        <dd>
            <?php if (!empty($errors['name'])) echo '<p class="error">'.$errors['name'].'</p>'; ?>
            <p class="description">What's the name of your product?</p>
            <p><input type="text" name="name" id="info-name" class="medium" value="<?php echo $this->formValue('name', $product); ?>" /></p>
        </dd>
    </dl>
    
    <dl<?php if (!empty($errors['description'])) echo ' class="errors"'; ?>>
        <dt><label for="info-description">product description</label></dt>
        <dd>
            <?php if (!empty($errors['description'])) echo '<p class="error">'.$errors['description'].'</p>'; ?>
            <p class="description">Briefly describe your product.</p>
            <p><textarea name="description" id="info-description" rows="3" cols="50" class="full"><?php echo $this->formValue('description', $product); ?></textarea></p>
        </dd>
    </dl>
    
    <dl<?php if (!empty($errors['url'])) echo ' class="errors"'; ?>>
        <dt><label for="info-url">product URL</label></dt>
        <dd>
            <?php if (!empty($errors['url'])) echo '<p class="error">'.$errors['url'].'</p>'; ?>
            <p class="description">Give your product a short name to be used in its URL.</p>
            <p><?php echo $this->url(); ?><input type="text" name="url" id="info-url" class="small" value="<?php echo $this->formValue('url', $product); ?>" /></p>
        </dd>
    </dl>
    
    <div>
        <input type="submit" value="make it so" class="button" />
    </div>
</form>
</div>