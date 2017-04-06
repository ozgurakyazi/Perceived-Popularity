<?php
if( get_theme_mod( 'sabino-social-email' ) ) :
    echo '<a href="' . esc_url( 'mailto:' . antispambot( get_theme_mod( 'sabino-social-email' ), 1 ) ) . '" title="' . esc_attr__( 'Send Us an Email', 'sabino' ) . '" class="header-social-icon social-email"><i class="fa fa-envelope-o"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-skype' ) ) :
    echo '<a href="skype:' . esc_html( get_theme_mod( 'sabino-social-skype' ) ) . '?userinfo" title="' . esc_attr__( 'Contact Us on Skype', 'sabino' ) . '" class="header-social-icon social-skype"><i class="fa fa-skype"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-facebook' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-facebook' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Facebook', 'sabino' ) . '" class="header-social-icon social-facebook"><i class="fa fa-facebook"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-twitter' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-twitter' ) ) . '" target="_blank" title="' . esc_attr__( 'Follow Us on Twitter', 'sabino' ) . '" class="header-social-icon social-twitter"><i class="fa fa-twitter"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-google-plus' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-google-plus' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Google Plus', 'sabino' ) . '" class="header-social-icon social-gplus"><i class="fa fa-google-plus"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-linkedin' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-linkedin' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on LinkedIn', 'sabino' ) . '" class="header-social-icon social-linkedin"><i class="fa fa-linkedin"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-tumblr' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-tumblr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Tumblr', 'sabino' ) . '" class="header-social-icon social-tumblr"><i class="fa fa-tumblr"></i></a>';
endif;

if( get_theme_mod( 'sabino-social-flickr' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'sabino-social-flickr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Flickr', 'sabino' ) . '" class="header-social-icon social-flickr"><i class="fa fa-flickr"></i></a>';
endif;
