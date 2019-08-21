/**
 * Do / Dont listing
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/do-dont-list/index.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, InnerBlocks } = wp.blockEditor;


registerBlockType("nhsblocks/dodont", {
    title: __("Do and Don't List", "nhsblocks"),
    category: "nhsblocks",
    icon: "yes-alt",
    attributes: {
        panelTitle: {
            type: "string",
            source: "html",
            selector: "h3"
        }
    },

    edit: props => {

        // Lift info from props and populate various constants.
        const {
            attributes: {
                panelTitle
            },
            className,
            setAttributes
        } = props;

        // Grab newPanelTitle, set the value of panelTitle to newPanelTitle.
        const onChangePanelTitle = newPanelTitle => {
            setAttributes({ panelTitle: newPanelTitle });
        };
        const ALLOWED_BLOCKS = [ ];



        return (
            <div className="nhsuk-do-dont-list">
                <h3 className="nhsuk-do-dont-list__label">
                    <RichText
                        placeholder={__("Panel Title", "nhsblocks")}
                        value={panelTitle}
                        onChange={onChangePanelTitle}
                    />
                </h3>
                <ul className="nhsuk-list nhsuk-list--cross">
                    <InnerBlocks allowedBlocks={ ALLOWED_BLOCKS } />
                </ul>
            </div>
    );
    },
    save: props => {
        // console.info(props);

        const {
            attributes: {
                panelTitle,
                panelText }
        } = props;

        return (
            <div className="nhsuk-do-dont-list">
                <h3 className="nhsuk-do-dont-list__label">
                    <RichText.Content value={panelTitle} />
                </h3>
                <ul className="nhsuk-list nhsuk-list--cross">
                    <InnerBlocks.Content />
                </ul>
            </div>
    );
    }
});


registerBlockType("nhsblocks/doitem", {
    title: __("List Item with Tick", "nhsblocks"),
    category: "nhsblocks",
    icon: "yes",
    parent: ["nhsblocks/dodont"],
    attributes: {
        panelText: {
            type: "string",
            source: "html",
            selector: "span"
        }
    },

    edit: props => {

        // Lift info from props and populate various constants.
        const {
            attributes: {
                panelText
            },
            setAttributes
        } = props;

        // Grab newPanelText, set the value of panelText to newPanelText.
        const onChangePanelText = newPanelText => {
            setAttributes({ panelText: newPanelText });
        };

        return (
            <li>
                <svg class="nhsuk-icon nhsuk-icon__tick" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path stroke-width="4" stroke-linecap="round" d="M18.4 7.8l-8.5 8.4L5.6 12"></path>
                </svg>
                <span>
                    <RichText placeholder={__("Text", "nhsblocks")} value={panelText} onChange={onChangePanelText} />
                </span>
            </li>
        );
    },
    save: props => {
        // console.info(props);

        const {
            attributes: {
                panelText }
        } = props;

        return (
            <li>
                <svg class="nhsuk-icon nhsuk-icon__tick" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <path stroke-width="4" stroke-linecap="round" d="M18.4 7.8l-8.5 8.4L5.6 12"></path>
                </svg>
                <span>
                    <RichText.Content value={panelText} />
                </span>
            </li>
    );
    }
});


registerBlockType("nhsblocks/dontitem", {
    title: __("List Item with Cross", "nhsblocks"),
    category: "nhsblocks",
    icon: "no-alt",
    parent: ["nhsblocks/dodont"],
    attributes: {
        panelText: {
            type: "string",
            source: "html",
            selector: "span"
        }
    },

    edit: props => {

        // Lift info from props and populate various constants.
        const {
            attributes: {
                panelText
            },
            setAttributes
        } = props;

        // Grab newPanelText, set the value of panelText to newPanelText.
        const onChangePanelText = newPanelText => {
            setAttributes({ panelText: newPanelText });
        };



        return (
        <li>
            <svg class="nhsuk-icon nhsuk-icon__cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M17 18.5c-.4 0-.8-.1-1.1-.4l-10-10c-.6-.6-.6-1.6 0-2.1.6-.6 1.5-.6 2.1 0l10 10c.6.6.6 1.5 0 2.1-.3.3-.6.4-1 .4z"></path>
                <path d="M7 18.5c-.4 0-.8-.1-1.1-.4-.6-.6-.6-1.5 0-2.1l10-10c.6-.6 1.5-.6 2.1 0 .6.6.6 1.5 0 2.1l-10 10c-.3.3-.6.4-1 .4z"></path>
            </svg>
            <span>
                <RichText placeholder={__("Text", "nhsblocks")} value={panelText} onChange={onChangePanelText} />
            </span>
        </li>
    );
    },
    save: props => {
        // console.info(props);

        const {
            attributes: {
                panelText }
        } = props;

        return (
            <li>
            <svg class="nhsuk-icon nhsuk-icon__cross" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M17 18.5c-.4 0-.8-.1-1.1-.4l-10-10c-.6-.6-.6-1.6 0-2.1.6-.6 1.5-.6 2.1 0l10 10c.6.6.6 1.5 0 2.1-.3.3-.6.4-1 .4z"></path>
                <path d="M7 18.5c-.4 0-.8-.1-1.1-.4-.6-.6-.6-1.5 0-2.1l10-10c.6-.6 1.5-.6 2.1 0 .6.6.6 1.5 0 2.1l-10 10c-.3.3-.6.4-1 .4z"></path>
            </svg>
            <span>
                <RichText.Content value={panelText} />
            </span>
        </li>
    );
    }
});
