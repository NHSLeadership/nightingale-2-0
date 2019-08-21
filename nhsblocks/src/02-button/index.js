/**
 * NHS Styled Buttons
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/button/index.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const {
    RichText,
    URLInputButton } = wp.blockEditor;
//@todo align
//@todo extended classes

registerBlockType("nhsblocks/nhsbutton", {
  title: __("Button", "nhsblocks"),
  category: "nhsblocks",
  icon: "admin-links",
  styles: [
    {
      name: "green",
      label: __("Standard (Green)"),
      isDefault: true
    },
    {
      name: "secondary",
      label: __("Secondary (Grey)")
    },
      {
          name: "reverse",
          label: __("Reverse (White)")
      }
  ],
  supports: {
      align: true,
  },
  attributes: {
      buttonLabel: {
          type: "string",
          source: "html",
          selector: ".nhsuk-button"
      },
      buttonLink: {
          type: "string",
          source: "attribute",
          selector: "a.nhsuk-button",
          attribute: "href"
      },
  },

    // https://wordpress.org/gutenberg/handbook/designers-developers/developers/block-api/block-edit-save/
    edit: props => {
    // Props parameter holds all the info.
    //console.info(props);

    // Lift info from props and populate various constants.
    const {
      attributes: {
        buttonLabel,
        buttonLink
      },
      className,
      setAttributes
    } = props;

    // Grab newButtonLabel, set the value of buttonLabel to newButtonLabel.
    const onChangeButtonLabel = newButtonLabel => {
      setAttributes({ buttonLabel: newButtonLabel});
    };
    // Grab newButtonLink, set the value of buttonLink to newButtonLink.
    const onChangeButtonLink = newButtonLink => {
      setAttributes({ buttonLink: newButtonLink });
    };

    return (
            <a href="#0" className={`${className} nhsuk-button`}>
            <RichText
              placeholder={__("Button Label", "nhsblocks")}
              value={buttonLabel}
              onChange={onChangeButtonLabel}
            />
            <URLInputButton
        className="nhsblocks-dropdown__input"
        label={__("Button URL", "nhsblocks")}
        onChange={onChangeButtonLink}
        url={buttonLink}
        />
            </a>
  )
  },
  save: props => {
    const {
      attributes: {
          buttonLabel, buttonLink
      }
    } = props;
     // console.info(props);
    return (
          <a href={buttonLink} className="nhsuk-button">
            <RichText.Content value={buttonLabel} />
          </a>
    )
  }
});
