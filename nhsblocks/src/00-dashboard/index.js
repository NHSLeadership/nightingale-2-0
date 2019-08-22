/**
 *  NHS Panel Group Element
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/panel/index.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */

const { useState, setState } = wp.element;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, InspectorControls, URLInputButton, ColorPalette, MediaUpload, InnerBlocks } = wp.blockEditor;
const onecolsIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 30
    },
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "59.000",
            height: "30"
        }
    ),
);
const twocolsIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 30
    },
    wp.element.createElement( 'rect',
        {
            x: "31.000",
            y: "0.000",
            width: "29.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "29.000",
            height: "30"
        }
    ),
);
const threecolsIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 30
    },
    wp.element.createElement( 'rect',
        {
            x: "41.000",
            y: "0.000",
            width: "19.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "21.000",
            y: "0.000",
            width: "19.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "19.000",
            height: "30"
        }
    ),
);

const threetwocolstworowsIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 40
    },
    wp.element.createElement( 'rect',
        {
            x: "41.000",
            y: "0.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "21.000",
            y: "0.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "31.000",
            y: "20.000",
            width: "29.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "20.000",
            width: "29.000",
            height: "19"
        }
    ),
);
const threecolstworowsIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 40
    },
    wp.element.createElement( 'rect',
        {
            x: "41.000",
            y: "0.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "21.000",
            y: "0.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "41.000",
            y: "20.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "21.000",
            y: "20.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "20.000",
            width: "19.000",
            height: "19"
        }
    ),
);

const twothreecolstworowsIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 40
    },
    wp.element.createElement( 'rect',
        {
            x: "31.000",
            y: "0.000",
            width: "29.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "29.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "41.000",
            y: "20.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "21.000",
            y: "20.000",
            width: "19.000",
            height: "19"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "20.000",
            width: "19.000",
            height: "19"
        }
    ),
);
const GRID_OPTIONS = [
    {
        title: 'Full Width',
        icon: onecolsIcon,
        template: [
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-full'} ],
        ],
    },{
        title: 'Two Columns',
        icon: twocolsIcon,
        template: [
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-half'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-half'} ],
        ],
    },
    {
        title: 'Three Columns',
        icon: threecolsIcon,
        template: [
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
        ],
    },
    {
        title: 'Two Columns Then Three Columns',
        icon: twothreecolstworowsIcon,
        template: [
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-half'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-half'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
        ],
    },
    {
        title: 'Three Columns Then Two Columns',
        icon: threetwocolstworowsIcon,
        template: [
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-half'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-half'} ],
        ],
    },
    {
        title: 'Three Columns, Two Rows',
        icon: threecolstworowsIcon,
        template: [
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
            [ 'nhsblocks/dashpanel', { className: 'nhsuk-grid-column-one-third'} ],
        ],
    },
];

registerBlockType("nhsblock/dashboardnav", {
    title: __("Dashboard Navigation", "nhsblocks"),
    category: "nhsblocks",
    icon: 'tagcloud',
    attributes: {
        template: {
            type: "array"
        }
    },

    edit: props => {
        const {
            attributes: {
                template
            },
            setAttributes,
        } = props;
        const onChangetemplate = newTemplate => {
            setAttributes({ template: newTemplate });
        };
        const showTemplateSelector = ( template === null ) || ! template;
        return (
            <div className="nhsuk-grid-row">
            <div className="nhsuk-panel-group nhsuk-grid-column-full nhsuk-dashboard">
            <InnerBlocks
        template={ showTemplateSelector ? null : template }
        __experimentalTemplateOptions={ GRID_OPTIONS }
        __experimentalOnSelectTemplateOption={ onChangetemplate }
        />
        </div>
        </div>
    );
    },
    save: props => {
        const {
            attributes:
                {
                    template
                }
        } = props;
        return (
            <div className="nhsuk-grid-row">
            <div className="nhsuk-panel-group nhsuk-dashboard">
            <InnerBlocks.Content />
            </div>
            </div>
    );
    }
});


registerBlockType("nhsblocks/dashpanel", {
    title: __("Dashboard Region", "nhsblocks"),
    description: __("Simple image background with text and link to give Dashboard navigation panel"),
    icon: "feedback",
    category: "nhsblocks",
    parent: "nhsblocks/dashboardnav",

    attributes: {
        panelTitle: {
            type: "string",
            source: "html",
            selector: "h3"
        },
        panelLink: {
            type: "string",
            source: "attribute",
            selector: ".nhsuk-promo__link-wrapper",
            attribute: "href"
        },
        backgroundImage: {
            type: 'string',
            default: '/wp-content/themes/nightingale-2-0/assets/pixel_trans.png',
        },
        overlayColor: {
            type: 'string',
            default: '#ffffff',
        },
    },

    edit: props => {

        // Lift info from props and populate various constants.

        const {
            setAttributes,
            attributes,
            className
        } = props;
        const { overlayColor, backgroundImage,  panelTitle, panelLink } = attributes;
        // Grab newPanelLink, set the value of panelLink to newPanelLink.
        const onChangePanelLink = newPanelLink => {
            setAttributes({ panelLink: newPanelLink });
        };

        function onOverlayColorChange(changes) {
            setAttributes({
                overlayColor: changes
            })
        }
        function onImageSelect(imageObject) {
            setAttributes({
                backgroundImage: imageObject.sizes.full.url
            })
        }

        // Grab newPanelTitle, set the value of panelTitle to newPanelTitle.
        const onChangePanelTitle = newPanelTitle => {
            setAttributes({ panelTitle: newPanelTitle });
        };

        return ([
            <InspectorControls>
            <div>
            <strong>Add a link for this panel</strong>
            <URLInputButton
                className="nhsblocks-dropdown__input"
                label={__("Dashboard Link", "nhsblocks")}
                onChange={onChangePanelLink}
                url={panelLink}
            />
                </div>
            <div>
            <strong>Select a background color:</strong> <br /><i>(this will be ignored if you choose an image below)</i>
        <ColorPalette
        value={overlayColor}
        onChange={onOverlayColorChange}
        />
        </div>
        <div>
        <strong>Select a background image:</strong>
        <MediaUpload
        onSelect={onImageSelect}
        type="image"
        value={backgroundImage}
        render={({ open }) => (
        <button onClick={open}>
            Upload Image!
        </button>
    )}
        />
        </div>
        </InspectorControls>,
            <div className={`${className} nhsuk-panel-group__item`} >
    <div class="nhsuk-panel-with-label" style={{
            backgroundColor: overlayColor,
                backgroundImage: `url(${ backgroundImage })`,
                backgroundSize: 'cover',
                backgroundPosition: 'center'
        }}>
    <h3 class="nhsuk-panel-with-label__label">
        <RichText
        placeholder={__("Panel Title", "nhsblocks")}
        value={panelTitle}
        onChange={onChangePanelTitle}
        />
        </h3>
        <img src="/wp-content/themes/nightingale-2-0/assets/pixel_trans.png" class="nhsuk-dashboard__image" alt="" />
            </div>
        </div>
    ] );
    },
    save: props => {
        // console.info(props);

        const {
            attributes: {
                overlayColor, backgroundImage,  panelTitle, panelLink
            }
        } = props;

        return (
            <div className = "nhsuk-panel-group__item">
            <a href={panelLink} className="nhsuk-promo__link-wrapper">
            <div class="nhsuk-panel-with-label" style={{
            backgroundImage: `url(${backgroundImage})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                backgroundColor: overlayColor
        }}>
            <h3 class="nhsuk-panel-with-label__label">

            <RichText.Content value={panelTitle} />
        </h3>
        <img src="/wp-content/themes/nightingale-2-0/assets/pixel_trans.png" class="nhsuk-dashboard__image" alt="" />
            </div>
        </a>
        </div>
    );
    }
});

