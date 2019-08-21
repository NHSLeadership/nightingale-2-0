/**
 *  NHS Hero  Element
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/promo/index.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {  RichText, InspectorControls, ColorPalette, MediaUpload, InnerBlocks } = wp.blockEditor;


registerBlockType("nhsblocks/heroblock", {
    title: __("Hero Block", "nhsblocks"),
    description: __("Full width zone, designed to go at the top of your page with an optional image background," +
        " texta area and call to action", "nhsblocks"),
    category: "nhsblocks",
    icon: "schedule",
    attributes: {
        overlayColor: {
            type: 'string',
            default: '#005eb8',
        },
        backgroundImage: {
            type: 'string',
            default: '/wp-content/themes/nightingale-2-0/assets/pixel_trans.png',
        },
    },
    edit: props => {
        const TEMPLATE_OPTIONS = [];
        const {
            setAttributes,
            attributes,
            className
        } = props;
        const { overlayColor, backgroundImage } = attributes;


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
        return ([
            <InspectorControls>
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
            <section className={`${className}  nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description`} style={{
                backgroundColor: overlayColor,
                backgroundImage: `url(${ backgroundImage })`,
                backgroundSize: 'cover',
                backgroundPosition: 'center'
        }}>
            <div className="nhsuk-hero__overlay">
            <div className="nhsuk-width-container">
            <div className="nhsuk-grid-row">
            <div className="nhsuk-grid-column-two-thirds">
            <InnerBlocks
                template={ TEMPLATE_OPTIONS }
            />
            </div>
            </div>
            </div>
            </div>
            </section>
        ])

    },
    save: props => {
        const { attributes, className } = props;
        const { overlayColor, backgroundImage } = attributes;
        return (
            <section className="nhsuk-hero nhsuk-hero--image nhsuk-hero--image-description" style={{
            backgroundImage: `url(${backgroundImage})`,
                backgroundSize: 'cover',
                backgroundPosition: 'center',
                backgroundColor: overlayColor
        }}>
            <div className="nhsuk-hero__overlay">
            <div className="nhsuk-width-container">
            <div className="nhsuk-grid-row">
            <div className="nhsuk-grid-column-two-thirds">
            <InnerBlocks.Content />
            </div>
            </div>
            </div>
            </div>
            </section>
    )
    }
});


registerBlockType("nhsblocks/heroinner", {
    title: __("Hero Block Inner Text", "nhsblocks"),
    description: __("Add some text to the header", "nhsblocks"),
    category: "nhsblocks",
    parent: "nhsblocks/heroblock",
    icon: "nametag",
    attributes: {
        texttitle: {
            type: 'array',
            source: 'children',
            selector: 'h1',
        },
        texttext: {
            type: 'array',
            source: 'children',
            selector: 'p',
        },
        fontColor: {
            type: 'string',
            default: '#ffffff',
        },
    },
    edit: props => {
        const {
            setAttributes,
            attributes,
            className
        } = props;
        const { fontColor } = attributes;
        function onTitleChange(changes) {
            setAttributes({
                texttitle: changes
            });
        }
        function onTextChange(changes) {
            setAttributes({
                texttext: changes
            });
        }
        function onTextColorChange(changes) {
            setAttributes({
                fontColor: changes
            })
        }
        return ([
            <InspectorControls>
            <div>
            <strong>Select a font color:</strong>
        <ColorPalette
        value={fontColor}
        onChange={onTextColorChange}
        />
        </div>
        </InspectorControls>,
            <div className="nhsuk-hero-content">
            <RichText
        tagName="h1"
        className="nhsuk-u-margin-bottom-3"
        value={attributes.texttitle}
        onChange={onTitleChange}
        placeholder="Enter your text here!"
        style={{color: fontColor}}
        />
        <RichText
        tagName="p"
        className="nhsuk-body-l nhsuk-u-margin-bottom-0"
        value={attributes.texttext}
        onChange={onTextChange}
        placeholder="Enter your text here!"
        style={{color: fontColor}}
        />
        <span className="nhsuk-hero__arrow" aria-hidden="true"></span>
            </div>
    ])

    },
    save: props => {
        const { attributes, className } = props;
        const { fontColor } = attributes;
        return (
            <div className="nhsuk-hero-content">
            <RichText.Content
        tagName="h1"
        className="nhsuk-u-margin-bottom-3"
        style={{ color:fontColor }}
        value={attributes.texttitle}
        />
        <RichText.Content
        tagName="p"
        className="nhsuk-body-l nhsuk-u-margin-bottom-0"
        style={{ color:fontColor }}
        value={attributes.textString}
        />
        <span className="nhsuk-hero__arrow" aria-hidden="true"></span>
            </div>
    )
    }
});
