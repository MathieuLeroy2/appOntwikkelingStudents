<?php
/**
 * Plugin Name: Cursuscatalogus (voorbeeld)
 * Description: Klein lesvoorbeeld voor een gamecatalogus; pas het model aan je eigen onderwerp aan.
 * Version: 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

add_action( 'init', function () {
    register_post_type( 'cursus_game', array(
        'labels'       => array( 'name' => 'Games', 'singular_name' => 'Game' ),
        'public'       => true,
        'has_archive'  => true,
        'rewrite'      => array( 'slug' => 'games' ),
        'show_in_rest' => true,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'comments', 'custom-fields' ),
        'taxonomies'   => array( 'cursus_genre' ),
    ) );

    register_taxonomy( 'cursus_genre', array( 'cursus_game' ), array(
        'labels'       => array( 'name' => 'Genres', 'singular_name' => 'Genre' ),
        'public'       => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'genre' ),
    ) );
} );

add_action( 'add_meta_boxes_cursus_game', function () {
    add_meta_box( 'cursus_game_gegevens', 'Gamegegevens', function ( $post ) {
        wp_nonce_field( 'cursus_game_bewaren', 'cursus_game_nonce' );
        $studio  = get_post_meta( $post->ID, 'cursus_studio', true );
        $spelers = get_post_meta( $post->ID, 'cursus_spelers', true );
        echo '<p><label for="cursus_studio">Studio</label><br>';
        echo '<input id="cursus_studio" name="cursus_studio" type="text" value="' . esc_attr( $studio ) . '"></p>';
        echo '<p><label for="cursus_spelers">Aantal spelers</label><br>';
        echo '<input id="cursus_spelers" name="cursus_spelers" type="number" min="1" step="1" value="' . esc_attr( $spelers ) . '"></p>';
    }, 'cursus_game' );
} );

add_action( 'save_post_cursus_game', function ( $post_id ) {
    if ( ! isset( $_POST['cursus_game_nonce'] ) ||
         ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cursus_game_nonce'] ) ), 'cursus_game_bewaren' ) ||
         ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
         ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['cursus_studio'] ) ) {
        $studio = sanitize_text_field( wp_unslash( $_POST['cursus_studio'] ) );
        if ( '' === $studio ) {
            delete_post_meta( $post_id, 'cursus_studio' );
        } else {
            update_post_meta( $post_id, 'cursus_studio', $studio );
        }
    }

    if ( isset( $_POST['cursus_spelers'] ) ) {
        $raw = wp_unslash( $_POST['cursus_spelers'] );
        if ( '' === $raw ) {
            delete_post_meta( $post_id, 'cursus_spelers' );
        } elseif ( filter_var( $raw, FILTER_VALIDATE_INT, array( 'options' => array( 'min_range' => 1 ) ) ) !== false ) {
            update_post_meta( $post_id, 'cursus_spelers', (int) $raw );
        }
    }
} );

add_shortcode( 'cursus_gamegegevens', function () {
    if ( 'cursus_game' !== get_post_type() ) {
        return '';
    }
    $studio  = get_post_meta( get_the_ID(), 'cursus_studio', true );
    $spelers = get_post_meta( get_the_ID(), 'cursus_spelers', true );
    $regels  = array();
    if ( '' !== $studio ) {
        $regels[] = '<li>Studio: ' . esc_html( $studio ) . '</li>';
    }
    if ( '' !== $spelers ) {
        $regels[] = '<li>Spelers: ' . esc_html( $spelers ) . '</li>';
    }
    return $regels ? '<ul class="cursus-gamegegevens">' . implode( '', $regels ) . '</ul>' : '';
} );
