/**
 *  NHS Section Element (Placeholder - either full width or column width)
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 15th August 2019
 */

const { registerBlockType } = wp.blocks;


const { Fragment } = wp.element;
const {
    PanelBody,
    SelectControl,
    BaseControl,
    IconButton,
} = wp.components;
const {    InnerBlocks } = wp.editor;
const { __, _x } = wp.i18n;


registerBlockType("nhsblocks/section", {
    title: __( 'Section', 'nhsblocks' ),
    description: __( 'Add a section that separates content, and put any other block into it.', 'nhsblocks' ),
    category: 'nhsblocks',
    icon: 'welcome-widgets-menus',
    supports: {
        align: [ 'wide', 'full' ],
        anchor: true,
    },
    attributes: {

    },
    edit: props => {
        const { attributes, setAttributes } = props;
        const { colorScheme, contentMaxWidth, attachmentId, attachmentUrl } = attributes;
        const onSelectImage = media => {
            if ( ! media || ! media.id || ! media.url ) {
                setAttributes( { attachmentId: undefined, attachmentUrl: undefined } );
                return;
            }
            setAttributes( { attachmentId: media.id, attachmentUrl: media.url } );
        };

        return (
            <div className="nhsuk-grid-row">
            <div className="nhsuk-panel-group nhsuk-grid-column-full">
            <InnerBlocks />
            </div>
        </div>
    );
    },
    save: props => {
        const { attributes } = props;
        const { colorScheme, contentMaxWidth, attachmentId } = attributes;

        return (
            <div className="nhsuk-grid-row">
            <div className="nhsuk-panel-group nhsuk-grid-column-full">
            <InnerBlocks.Content />
            </div></div>
    );
    },
});
