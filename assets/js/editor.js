wp.domReady( () => {

    wp.blocks.registerBlockStyle( 'core/heading', {
        name: 'default',
        label: 'Default',
        isDefault: true,
    } );

    wp.blocks.registerBlockStyle( 'core/heading', {
        name: 'alt',
        label: 'Alternate',
    } );

} );
