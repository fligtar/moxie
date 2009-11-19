<?php if (!empty($success_message)) echo '<div class="success-notice">'.$success_message.'</div>'; ?>
<?php if (!empty($error_message)) echo '<div class="error-notice">'.$error_message.'</div>'; ?>

<div class="spacious-form">
<form method="post" action="">
<table>
    <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="3"><?php echo $product_name; ?> product</th>
        </tr>
        <tr>
            <th>Group</th>
            <th>Role</th>
            <th>Product</th>
            <th>Milestones</th>
            <th>Projects</th>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($groups as $group) {
            echo '<tr>';
            echo '<td>'.$group['name'].'</td>';
            echo '<td><select>';
            echo '<option value="">(none)</option>';
            
            // Pre-defined roles
            foreach ($roles as $role) {
                echo '<option value="'.$role['id'].'"';
                if ($role['id'] == $group['role_id']) {
                    echo ' selected';
                }
                echo '>'.$role['name'].'</option>';
            }
            
            // Custom role
            echo '<option value=""';
            if (!empty($group['permissionset_id']) && empty($group['role_id'])) {
            echo ' selected';
            }
            echo '>(custom)</option>';
            
            echo '</select></td>';
            echo '<td>'.$levels[get_permission_level('product', $product['id'], $group['permissions'])].'</td>';
            echo '<td>'.$levels[get_permission_level('milestones', $product['id'], $group['permissions'])].'</td>';
            echo '<td>'.$levels[get_permission_level('projects', $product['id'], $group['permissions'])].'</td>';
            echo '</tr>';
        }
    ?>
    </tbody>
</table>
    
    <div>
        <input type="submit" value="make it so" class="button" />
    </div>
</form>
</div>