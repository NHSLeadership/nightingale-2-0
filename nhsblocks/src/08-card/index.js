/**
 *  NHS Care Card Element
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/care-card/care-card-non-urgent.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;
//@todo add in Card class variations
//@todo add in width variations

registerBlockType("nhsblocks/card1", {
  title: __("Card Region", "nhsblocks"),
  category: "nhsblocks",
  attributes: {
    cardTitle: {
      type: "string",
      source: "html",
      selector: ".nhsuk-care-card__heading-text"
    },
    cardText: {
        type: "array",
        source: "children",
        multiline: "p",
      selector: ".nhsuk-care-card__content"
    }
  },

  edit: props => {

    // Lift info from props and populate various constants.
    const {
      attributes: {
        cardTitle,
        cardText
      },
      className,
      setAttributes
    } = props;

    // Grab newCardTitle, set the value of cardTitle to newCardTitle.
    const onChangeCardTitle = newCardTitle => {
      setAttributes({ cardTitle: newCardTitle });
    };


    // Grab newCardText, set the value of cardText to newCardText.
    const onChangeCardText = newCardText => {
      setAttributes({ cardText: newCardText });
    };

    return (
        <div className={`${className} nhsuk-care-card`}>
              <div className="nhsuk-care-card__heading-container">
                  <h3 className="nhsuk-care-card__heading">
                  <span role="text">
                    <span className="nhsuk-u-visually-hidden">Non-urgent advice: </span>
                    <span className="nhsuk-care-card__heading-text">
                      <RichText
                          placeholder={__("Card Title", "nhsblocks")}
                          value={cardTitle}
                          onChange={onChangeCardTitle}
                      />
                    </span>
                  </span>
                  </h3>
                  <span className="nhsuk-care-card__arrow" aria-hidden="true"></span>
              </div>
              <div className="nhsuk-care-card__content">
                  <RichText
                      multiline="p"
                      placeholder={__("Card Contents", "nhsblocks")}
                      onChange={onChangeCardText}
                      value={cardText}
                  />
              </div>
        </div>
  );
  },
  save: props => {
    const {
      attributes: {
        cardTitle,
        cardText }
    } = props;

    return (
        <div className="nhsuk-grid-column-width nhsuk-care-card nhsuk-care-card--type">
            <div className="nhsuk-care-card__heading-container">
               <h3 className="nhsuk-care-card__heading">
                 <span role="text">
                    <span className="nhsuk-u-visually-hidden">Non-urgent advice: </span>
                    <span className="nhsuk-care-card__heading-text">
                        <RichText.Content value={cardTitle} />
                    </span>
                  </span>
                </h3>
                <span className="nhsuk-care-card__arrow" aria-hidden="true"></span>
            </div>
            <div className="nhsuk-care-card__content">
              <RichText.Content
                 multiline="p"
                 value={cardText}
              />
            </div>
          </div>

    );
  }
});
// card variations
wp.blocks.registerBlockStyle ('nhsblocks/card1',
    {
        name: 'default',
        label: 'Standard Blue',
        isDefault: true
    }
);
wp.blocks.registerBlockStyle ('nhsblocks/card1',
    {
        name: 'urgent',
        label: 'Urgent (Red)'
    }
);
wp.blocks.registerBlockStyle ('nhsblocks/card1',
    {
        name: 'immediate',
        label: 'Immediate (Red and Black)'
    }
);
