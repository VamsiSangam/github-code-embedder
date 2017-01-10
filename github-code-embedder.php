<?php
/*
Plugin Name: GitHub Code Embedder
Plugin URI: http://vamsisangam.com/
Description: A simple WordPress plugin to embed source code hosted on GitHub with syntax highlighting.
Version: 1.0
Author: Vamsi Sangam
Author URI: http://vamsisangam.com
License: MIT
*/
if (is_admin()) {
    /* Call the html code */
    add_action('admin_menu', 'github_code_embedder_admin_menu');

    function github_code_embedder_admin_menu() {
        add_options_page('GitHub Code Embedder', 'GitHub Code Embedder', 'administrator',
        'github_code_embedder', 'github_code_embedder_html_page');
    }
}

add_action('wp_footer', 'github_code_embedder_wp_footer');

function github_code_embedder_wp_footer() {
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="/wp-content/plugins/github-code-embedder/prism.js"></script>
    <script>
            $(document).ready(function () {
                $('.dynamic-prism code').each(function (index) {
                    var url = $(this).attr("data-github-raw");
                    var pre = $(this);

                    $.get(url, function (data) {
                        pre.text(data);
                        Prism.highlightAll();
                    });
                });
            });
        </script>
    <?php
}

function gh_code_func($atts) {
    ?>
    <pre class="dynamic-prism language-<?= $atts['lang'] ?> line-numbers">
        <code data-github-raw="<?= $atts['url'] ?>"></code>
    </pre>
    <?php
}

add_shortcode( 'gh_code', 'gh_code_func' );

function github_code_embedder_html_page() {
    ?>
    <div>
        <h2>GitHub Code Embedder</h2>
        <p>The GitHub code embedder uses jQuery and PrismJS to display your GitHub code in your website.</p>
        <p><b>Plugin Developer</b> - <a href="https://github.com/VamsiSangam">Vamsi Sangam</a></p>
    <?php
}
?>