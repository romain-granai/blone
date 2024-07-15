<?php
        $model = get_field('3d_model', 'option');

// Define custom query arguments
$args = array(
    'post_type'      => 'product',
    'posts_per_page' => -1, // To retrieve all products, use -1. You can specify a number to limit the posts.
    'post_status'    => 'publish'
);

// Instantiate the custom query
$loop = new WP_Query( $args );

// Initialize the JavaScript object as a string
$products_js = 'let products = [';

// Initialize variables for the first product's details
$first_product_title = '';
$first_product_colors = [];
$first_product_permalink = '';

// Start the loop
if ( $loop->have_posts() ) :
    $is_first_product = true;
    while ( $loop->have_posts() ) : $loop->the_post();
        global $product;
        
        // Get product title
        $product_title = get_the_title();
        
        // Get product permalink
        $permalink = get_permalink();

        // Initialize colors array
        $colors_array = [];

        // Fetch ACF color fields
        for ($i = 1; $i <= 4; $i++) {
            $color = get_field('color_' . $i);
            if ($color) {
                $colors_array[] = $color;
            }
        }

        // Append to the JavaScript object string
        $products_js .= '{';
        $products_js .= '"productTitle": "' . esc_js($product_title) . '",';
        $products_js .= '"colors": ' . json_encode($colors_array) . ',';
        $products_js .= '"permalink": "' . esc_url($permalink) . '"';
        $products_js .= '},';

        // Capture the first product's details
        if ($is_first_product) {
            $first_product_title = $product_title;
            $first_product_colors = $colors_array;
            $first_product_permalink = $permalink;
            $is_first_product = false;
        }

    endwhile;

    // Remove the trailing comma and close the array
    $products_js = rtrim($products_js, ',') . '];';
else :
    $products_js = 'let products = [];';
endif;

// Restore original Post Data
wp_reset_postdata();
    ?>
    <script type="text/javascript">
        <?php echo $products_js; ?>
        console.log(products); 
    </script>
    <div class="bottle-screen" data-model="<?php echo $model['url']; ?>" style="--bg-opacity: 0; --color-1: <?php echo $first_product_colors[0]; ?>; --color-2:  <?php echo $first_product_colors[1]; ?>; --color-3: <?php echo $first_product_colors[2]; ?>; --color-4: <?php echo $first_product_colors[3]; ?>;">
        <div class="bottle-screen__bg">
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">5</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">4</span>
            <span class="bottle-screen__number">6</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">8</span>
            <span class="bottle-screen__number">7</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">1</span>
            <span class="bottle-screen__number">2</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
            <span class="bottle-screen__number">3</span>
            <span class="bottle-screen__number">9</span>
            <span class="bottle-screen__number">0</span>
        </div>
        <div class="bottle-screen__fg">
            <div class="bottle-screen__model" id="model-container"></div>
            <div class="bottle-screen__current-number"><span><?php echo $first_product_title; ?></span></div>
        </div>
        <div class="bottle-screen__ctas">
            <button class="btn btn--big btn--rounded btn--dark-neg prev-next prev-next--prev" data-text="Prev"><span>Prev</span></button>
                <a href="<?php echo $first_product_permalink; ?>" class="btn btn--big btn--rounded btn--dark-neg" title="See Product" data-text="See Product"><span>See Product</span></a>
            <button class="btn btn--big btn--rounded btn--dark-neg prev-next prev-next--next" data-text="next"><span>next</span></button>
        </div>
    </div>