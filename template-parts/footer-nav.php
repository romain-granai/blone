<?php 
    $menuName = 'footer';
    $menuFooter = wp_get_nav_menu_object($menuName);

    if (!$menuFooter) {
        echo 'Menu not found';
        return;
    }

    $menuId = $menuFooter->term_id;

    $menuItems = wp_get_nav_menu_items($menuId);

    if (!$menuItems) {
        echo 'No menu items found';
        return;
    }

    $menuItemsByParent = [];

    foreach ($menuItems as $menuItem) {
        $menuItemsByParent[$menuItem->menu_item_parent][] = $menuItem;
    }
?>
<?php if (isset($menuItemsByParent[0])): ?>
    <?php foreach ($menuItemsByParent[0] as $menuItem): ?>
    <div>
        <ul>
            <li>
                <?php if ($menuItem->url === '#'): ?>
                    <span><?php echo esc_html($menuItem->title); ?></span>
                <?php else: ?>
                    <a href="<?php echo esc_url($menuItem->url); ?>" title="<?php echo esc_html($menuItem->title); ?>" traget><?php echo esc_html($menuItem->title); ?></a>
                <?php endif; ?>
            </li>
            
            <?php if (isset($menuItemsByParent[$menuItem->ID])): ?>
                
                <?php foreach ($menuItemsByParent[$menuItem->ID] as $subMenuItem): 
                    $target = $subMenuItem->target == '_blank' ? ' target="_blank"' : '';    
                ?>

                    <a href="<?php echo esc_url($subMenuItem->url); ?>" title="<?php echo esc_html($subMenuItem->title) ?>" <?php echo $target; ?>><?php echo esc_html($subMenuItem->title) ?></a>

                <?php endforeach; ?>
            <?php endif; ?>

        </ul>
    </div>
    <?php endforeach; ?>
<?php endif; ?>