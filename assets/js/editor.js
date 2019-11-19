/**
 *
 *
 *  Custom changes to Gutenberg editor to make it more NHS Friendly
 *
 * @package Nightingale
 * @copyright NHS Leadership Academy, Tony Blacker
 * @version 1.1 21st August 2019
 */

wp.domReady( function() {
   //take out a chunk of the complexity for end users, leave them with tools they will actually use
    wp.blocks.unregisterBlockType( 'core/verse' );
    wp.blocks.unregisterBlockType( 'core/quote' );
    wp.blocks.unregisterBlockType( 'core/column' );
    wp.blocks.unregisterBlockType( 'core/columns' );
    wp.blocks.unregisterBlockType( 'core/cover' );
    wp.blocks.unregisterBlockType( 'core/video' );
    wp.blocks.unregisterBlockType( 'core/preformatted' );
    wp.blocks.unregisterBlockType( 'core/pullquote' );
    wp.blocks.unregisterBlockType( 'core/button' );
    wp.blocks.unregisterBlockType( 'core/shortcode' );
    wp.blocks.unregisterBlockType( 'core/latest-comments' );
    wp.blocks.unregisterBlockType( 'core-embed/soundcloud' );
    wp.blocks.unregisterBlockType( 'core-embed/spotify' );
    wp.blocks.unregisterBlockType( 'core-embed/animoto' );
    wp.blocks.unregisterBlockType( 'core-embed/cloudup' );
    wp.blocks.unregisterBlockType( 'core-embed/crowdsignal' );
    wp.blocks.unregisterBlockType( 'core-embed/collegehumor' );
    wp.blocks.unregisterBlockType( 'core-embed/dailymotion' );
    wp.blocks.unregisterBlockType( 'core-embed/videopress' );
    wp.blocks.unregisterBlockType( 'core-embed/tumblr' );
    wp.blocks.unregisterBlockType( 'core-embed/amazon-kindle' );
    wp.blocks.unregisterBlockType( 'core-embed/hulu' );
    wp.blocks.unregisterBlockType( 'core-embed/imgur' );
    wp.blocks.unregisterBlockType( 'core-embed/issuu' );
    wp.blocks.unregisterBlockType( 'core-embed/kickstarter' );
    wp.blocks.unregisterBlockType( 'core-embed/mixcloud' );
    wp.blocks.unregisterBlockType( 'core-embed/polldaddy' );
    wp.blocks.unregisterBlockType( 'core-embed/reddit' );
    wp.blocks.unregisterBlockType( 'core-embed/reverbnation' );
    wp.blocks.unregisterBlockType( 'core-embed/scribd' );
    wp.blocks.unregisterBlockType( 'core-embed/smugmug' );
    wp.blocks.unregisterBlockType( 'core-embed/speaker' );
    wp.blocks.unregisterBlockType( 'core-embed/speaker-deck' );
    wp.blocks.unregisterBlockType( 'core-embed/wordpress-tv' );


    // modify classname added to images
    /*function setBlockCustomClassName(className, blockName) {
        return blockName === 'core/image' ?
            'nhsuk-image' :
            className;
    }

    wp.hooks.addFilter(
        'blocks.getBlockDefaultClassName',
        'nightingale/set-block-custom-class-name',
        setBlockCustomClassName
    );
    */
/*
    if(jQuery("*[data-type='nhsblocks/heroblock']"). length){
        jQuery(".block-editor-block-list__layout").prepend(jQuery('*[data-type="nhsblocks/heroblock"]'));
    }*/

} );

