<?php if (!empty($success_message)) echo '<div class="success-notice">'.$success_message.'</div>'; ?>
<?php if (!empty($error_message)) echo '<div class="error-notice">'.$error_message.'</div>'; ?>

<div class="spacious-form">
<form method="post" action="">
<table>
    <thead>
        <tr>
            <th colspan="2"></th>
            <th colspan="3"><?php echo $product['name']; ?> product</th>
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
        <tr>
            <td>Administrators</td>
            <td><select>
                <option></option>
            </select></td>
            <td>Manage</td>
            <td>Manage</td>
            <td>Manage</td>
        </tr>
    </tbody>
</table>
    
    <div>
        <input type="submit" value="make it so" class="button" />
    </div>
</form>
</div>