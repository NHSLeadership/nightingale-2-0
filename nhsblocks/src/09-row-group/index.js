/**
 *  NHS Panel Group Element
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/panel/index.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */

const { useState, setState } = wp.element;
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InnerBlocks } = wp.blockEditor;
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

const twoleftthirdIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 30
    },
    wp.element.createElement( 'rect',
        {
            x: "21.000",
            y: "0.000",
            width: "39.000",
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
const tworightthirdIcon = wp.element.createElement('svg',
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
            x: "0.000",
            y: "0.000",
            width: "39.000",
            height: "30"
        }
    )
);
const twofourfourIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 30
    },
    wp.element.createElement( 'rect',
        {
            x: "46.000",
            y: "0.000",
            width: "14.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "31.000",
            y: "0.000",
            width: "14.000",
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

const fourtwofourIcon = wp.element.createElement('svg',
    {
        width: 60,
        height: 30
    },
    wp.element.createElement( 'rect',
        {
            x: "46.000",
            y: "0.000",
            width: "14.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "16.000",
            y: "0.000",
            width: "29.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "14.000",
            height: "30"
        }
    ),
);

const fourfourtwoIcon = wp.element.createElement('svg',
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
            x: "16.000",
            y: "0.000",
            width: "14.000",
            height: "30"
        }
    ),
    wp.element.createElement( 'rect',
        {
            x: "0.000",
            y: "0.000",
            width: "14.000",
            height: "30"
        }
    ),
);
//@todo add in Panel class variations
//@todo add in width variations
const GRID_OPTIONS = [
    {
        title: 'Two Columns',
        icon: twocolsIcon,
    template: [
    [ 'nhsblocks/onehalf' ],
    [ 'nhsblocks/onehalf' ],
],
},
{
    title: 'Three Columns',
        icon: threecolsIcon,
    template: [
    [ 'nhsblocks/onethird' ],
    [ 'nhsblocks/onethird' ],
    [ 'nhsblocks/onethird' ],
],
},
    {
        title: 'One Third / Two Thirds Columns',
        icon: twoleftthirdIcon,
        template: [
            [ 'nhsblocks/onethird' ],
            [ 'nhsblocks/twothirds' ]
        ],
    },
    {
        title: 'Two Thirds / One Third Columns',
        icon: tworightthirdIcon,
        template: [
            [ 'nhsblocks/twothirds' ],
            [ 'nhsblocks/onethird' ]
        ],
    },
    {
        title: 'One Quarter / One Half / One Quarter Columns',
        icon: fourtwofourIcon,
        template: [
            [ 'nhsblocks/onequarter' ],
            [ 'nhsblocks/onehalf' ],
            [ 'nhsblocks/onequarter' ]
        ],
    },
    {
        title: 'One Quarter / One Quarter / One Half Columns',
        icon: fourfourtwoIcon,
        template: [
            [ 'nhsblocks/onequarter' ],
            [ 'nhsblocks/onequarter' ],
            [ 'nhsblocks/onehalf' ]
        ],
    },
    {
        title: 'One Half / One Quarter / One Quarter Columns',
        icon: twofourfourIcon,
        template: [
            [ 'nhsblocks/onehalf' ],
            [ 'nhsblocks/onequarter' ],
            [ 'nhsblocks/onequarter' ]
        ],
    },
];
const ITEM_OPTIONS = [
    {
        title: 'Panel',
        icon: 'feedback',
        template: [
        [ 'nhsblocks/panel1' ]
    ],
    },
    {
        title: 'Promo',
        icon: 'megaphone',
        template: [
            [ 'nhsblocks/promo1'],
        ],
    },
    {
        title: 'Quote / Testimonial',
        icon: 'format-quote',
        template: [
        [ 'nhsblocks/quote1'],
    ],
    },
];

registerBlockType("nhsblock/rowgroup", {
    title: __("Grouped Items", "nhsblocks"),
    category: "nhsblocks",
    icon: 'layout',
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
            <div className="nhsuk-panel-group nhsuk-grid-column-full">
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
            <div className="nhsuk-panel-group nhsuk-grid-column-full">
            <InnerBlocks.Content />
            </div>
            </div>
    );
    }
});

registerBlockType("nhsblocks/onehalf", {
    title: __("One Half Width", "nhsblocks"),
    category: "nhsblocks",
    parent: ["nhsblock/rowgroup"],
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
            <div className="nhsuk-grid-column-one-half">
            <InnerBlocks
        template={ showTemplateSelector ? null : template }
        __experimentalTemplateOptions={ ITEM_OPTIONS }
        __experimentalOnSelectTemplateOption={ onChangetemplate }
        />
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
            <div className="nhsuk-grid-column-one-half">
            <InnerBlocks.Content />
            </div>
    );
    }
});
registerBlockType("nhsblocks/onethird", {
    title: __("One Third Width", "nhsblocks"),
    category: "nhsblocks",
    parent: ["nhsblock/rowgroup"],
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
            <div className="nhsuk-grid-column-one-third">
            <InnerBlocks
        template={ showTemplateSelector ? null : template }
        __experimentalTemplateOptions={ ITEM_OPTIONS }
        __experimentalOnSelectTemplateOption={ onChangetemplate }
        />
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
            <div className="nhsuk-grid-column-one-third">
            <InnerBlocks.Content />
            </div>
    );
    }
});

registerBlockType("nhsblocks/onequarter", {
    title: __("One Quarter Width", "nhsblocks"),
    category: "nhsblocks",
    parent: ["nhsblock/rowgroup"],
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
            <div className="nhsuk-grid-column-one-quarter">
            <InnerBlocks
        template={ showTemplateSelector ? null : template }
        __experimentalTemplateOptions={ ITEM_OPTIONS }
        __experimentalOnSelectTemplateOption={ onChangetemplate }
        />
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
            <div className="nhsuk-grid-column-one-quarter">
            <InnerBlocks.Content />
            </div>
    );
    }
});

registerBlockType("nhsblocks/twothirds", {
    title: __("Two Thirds Width", "nhsblocks"),
    category: "nhsblocks",
    parent: ["nhsblock/rowgroup"],
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
            <div className="nhsuk-grid-column-two-thirds">
            <InnerBlocks
        template={ showTemplateSelector ? null : template }
        __experimentalTemplateOptions={ ITEM_OPTIONS }
        __experimentalOnSelectTemplateOption={ onChangetemplate }
        />
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
            <div className="nhsuk-grid-column-two-thirds">
            <InnerBlocks.Content />
            </div>
    );
    }
});

registerBlockType("nhsblocks/threequarters", {
    title: __("Three Quarter Width", "nhsblocks"),
    category: "nhsblocks",
    parent: ["nhsblock/rowgroup"],
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
            <div className="nhsuk-grid-column-three-quarters">
            <InnerBlocks
        template={ showTemplateSelector ? null : template }
        __experimentalTemplateOptions={ ITEM_OPTIONS }
        __experimentalOnSelectTemplateOption={ onChangetemplate }
        />
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
            <div className="nhsuk-grid-column-three-quarters">
            <InnerBlocks.Content />
            </div>
    );
    }
});
