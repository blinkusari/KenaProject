<?php
/**
 * View template for Foody Menu widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */
?>
<div class="cafe-wrap cafe-foody-menu">
    <?php
    $repeater = $settings['repeater'];
    if($repeater && is_array($repeater)){
        foreach ($repeater as $value) { ?>
            <?php
            $open_link = '';
            $close_link = '';
            if ($value['link']['url'] != '') {
                $open_link = '<a href="' . esc_url($value['link']['url']) . '"';
                $open_link .= $value['link']['is_external'] == 'on' ? 'target="_blank"' : '';
                $open_link .= $value['link']['nofollow'] == 'on' ? 'rel="nofollow"' : '';
                $open_link .= '>';
                $close_link = '</a>';
            }
            ?>
            <div class="foody-menu-item">
                <?php if( $value['image']['url'] ) { ?>
                <div class="cafe-wrap-image" >
                    <div class="image" style="background-image: url(<?php echo esc_url($value['image']['url']) ?>);"></div>
                </div>
                <?php } ?>
                
                <div class="cafe-wrap-content">
                    <div class="wrap-title">
                        <h3 class="title"><?php echo  $value['title']; ?></h3>
                        <p class="description"><?php echo  $value['description']; ?></p>
                    </div>
                    <div class="wrap-price">
                        <div class="price"><?php echo $value['price']; ?></div>
                        <div class="order">
                        <?php echo $open_link.$value['text'].$close_link; ?>
                        <?php if($value['star']) { ?>
                        <span class="star"><i class="fa fa-star"></i></span>
                        <?php } ?>
                    </div>
                </div>
                </div>
                
            </div>
            <?php
        }
    }
    ?>
</div>