/**
 *  Custom changes to Gutenberg editor to make it more NHS Friendly
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */

wp.domReady( function() {
   /* //take out a chunk of the complexity for end users, leave them with tools they will actually use
    wp.blocks.unregisterBlockType( 'core/verse' );
    wp.blocks.unregisterBlockType( 'core/list' );
    wp.blocks.unregisterBlockType( 'core/quote' );
    wp.blocks.unregisterBlockType( 'core/cover' );
    wp.blocks.unregisterBlockType( 'core/file' );
    wp.blocks.unregisterBlockType( 'core/video' );
    wp.blocks.unregisterBlockType( 'core/preformatted' );
    wp.blocks.unregisterBlockType( 'core/pullquote' );
    wp.blocks.unregisterBlockType( 'core/button' );
    wp.blocks.unregisterBlockType( 'core/shortcode' );
    wp.blocks.unregisterBlockType( 'core/latest-comments' );
    wp.blocks.unregisterBlockType( 'core/soundcloud' );
    wp.blocks.unregisterBlockType( 'core/spotify' );
    wp.blocks.unregisterBlockType( 'core/animoto' );
    wp.blocks.unregisterBlockType( 'core/cloudup' );
    wp.blocks.unregisterBlockType( 'core/collegehumor' );
    wp.blocks.unregisterBlockType( 'core/dailymotion' );
    wp.blocks.unregisterBlockType( 'core/funnyordie' );
    wp.blocks.unregisterBlockType( 'core/hulu' );
    wp.blocks.unregisterBlockType( 'core/imgur' );
    wp.blocks.unregisterBlockType( 'core/issuu' );
    wp.blocks.unregisterBlockType( 'core/kickstarter' );
    wp.blocks.unregisterBlockType( 'core/mixcloud' );
    wp.blocks.unregisterBlockType( 'core/polldaddy' );
    wp.blocks.unregisterBlockType( 'core/reddit' );
    wp.blocks.unregisterBlockType( 'core/reverbnation' );
    wp.blocks.unregisterBlockType( 'core/scribd' );
    wp.blocks.unregisterBlockType( 'core/smugmug' );
    wp.blocks.unregisterBlockType( 'core/wordpress-tv' );
    */


    // modify classname added to images
    function setBlockCustomClassName(className, blockName) {
        return blockName === 'core/image' ?
            'nhsuk-image' :
            className;
    }

    wp.hooks.addFilter(
        'blocks.getBlockDefaultClassName',
        'nightingale_2_0/set-block-custom-class-name',
        setBlockCustomClassName
    );

} );
