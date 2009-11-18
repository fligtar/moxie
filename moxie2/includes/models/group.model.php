<?php

class GroupModel extends Model {
    public $table = 'groups';
    
    // Permission levels, with room to grow
    const PERMISSION_NONE = 0;
    const PERMISSION_VIEW = 5;
    const PERMISSION_CONTRIBUTE = 10;
    const PERMISSION_CREATE = 15;
    const PERMISSION_MANAGE = 20;
    
    // Special groups. Special in a good way
    const GROUP_ADMINS = 1;
    const GROUP_REGISTERED = 2;
    const GROUP_EVERYONE = 3;
    
    /**
     * Gets all groups for the given user, including special groups
     */
    public function getGroupsForUser($user_id = 0) {
        if (empty($user_id)) {
            // If no user id is passed, assume the current user if logged-in
            if (!empty($_SESSION['id'])) {
                $user_id = $_SESSION['id'];
            }
        }
        
        // Everyone is in the Everyone group, amazingly
        $group_ids = array(GroupModel::GROUP_EVERYONE);
        
        if (!empty($user_id)) {
            $_group_ids = $this->db->query("SELECT group_id FROM groups_users WHERE user_id = ".escape($user_id));
            if (!empty($_group_ids)) {
                foreach ($_group_ids as $group_id) {
                    $group_ids[] = $group_id['group_id'];
                }
            }
            
            // Add registered users group
            $group_ids[] = GroupModel::GROUP_REGISTERED;
        }
        
        // Get group info and permissions
        $groups = $this->getAll('id IN ('.implode(',', $group_ids).')');
        
        return $groups;
    }
    
    /**
     * Adds the group's permission levels to an array of groups.
     * Optionally can only add permissions for a given product.
     */
    public function addPermissionsToGroups(&$groups, $product_id = 0) {
        if (empty($groups)) return false;
        
        foreach ($groups as $k => $group) {
            // If the group has a role_id instead of a permissionset_id, we need
            // to query the role to get the permissionset_id
            if (!empty($group['role_id'])) {
                $_role = $this->db->query("SELECT permissionset_id FROM roles WHERE id = ".escape($group['role_id']));
                $groups[$k]['permissionset_id'] = $_role[0]['permissionset_id'];
            }
            
            // Now, if we have a permissionset_id, we can get the permissionset
            if (!empty($groups[$k]['permissionset_id'])) {
                // if a product is specified, we filter on that
                $where = !empty($product_id) ? " AND (product_id = ".escape($product_id).") OR product_id IS NULL" : '';
                
                $permissions = $this->db->query("SELECT * FROM permissionsets WHERE id = ".escape($groups[$k]['permissionset_id']).$where);
                
                $groups[$k]['permissions'] = array();
                
                if (!empty($permissions)) {
                    foreach ($permissions as $permission) {
                        $pk = !empty($permission['product_id']) ? $permission['product_id'] : '*';
                        $groups[$k]['permissions'][$pk] = $permission;
                    }
                }
            }
        }
        
        return true;
    }
    
    /**
     * Combines permissions from all the user's group to determine actual
     * permissions for each product
     */
    public function sumPermissions(&$groups) {
        if (empty($groups)) return false;
        
        $permissions = array();
        
        // Iterate through each of the user's groups
        foreach ($groups as $group) {
            if (empty($group['permissions'])) continue;
            
            // Iterate through the each of the group's products
            foreach ($group['permissions'] as $product_id => $group_perms) {
                if (!array_key_exists($product_id, $permissions)) {
                    // No permissions yet for this product. Easy!
                    $permissions[$product_id] = $group_perms;
                }
                else {
                    // We already have some permissions. Figure out if any are more powerful
                    foreach ($group_perms as $perm => $level) {
                        if ($level > $permissions[$product_id][$perm]) {
                            $permissions[$product_id][$perm] = $level;
                        }
                    }
                }
            }
        }
        
        // Now that we have all the products added up, we need to go through the wildcard
        // permissions to apply those to the specific groups. We do this now to save time
        // when doing access checks later. Reasoning: When checking for access, we only
        // look at wildcards if the product isn't defined. If the product is defined, we
        // only look at that product, so it needs to have the entire permissions picture
        // for that product.
        
        // So... let's do that!
        if (!empty($permissions['*'])) {
            // Iterate through each product
            foreach ($permissions as $product_id => $product_perms) {
                if ($product_id == '*') continue;
                
                // Determine if the wildcard perms are more powerful than specific products
                foreach ($product_perms as $perm => $level) {
                    if ($permissions['*'][$perm] > $level) {
                        $permissions[$product_id][$perm] = $permissions['*'][$perm];
                    }
                }
            }
        }
        
        return $permissions;
    }
    
    /**
     * Gets the permission level for a specific permission on a specific product
     */
    public function getPermissionLevel($permission, $product_id, $permissions = array()) {
        // If no permissions array passed, we try to get from the session
        if (empty($permissions) && !empty($_SESSION['permissions'])) {
            $permissions = $_SESSION['permissions'];
        }
        
        // If the product is specifically listed in the user's permissions, use it
        // Otherwise, try to use the defaults
        if (array_key_exists($product_id, $permissions)) {
            return $permission[$product_id][$permission];
        }
        elseif (array_key_exists('*', $permissions)) {
            return $permissions['*'][$permission];
        }
        else {
            return GroupModel::PERMISSION_NONE;
        }
    }
}

?>