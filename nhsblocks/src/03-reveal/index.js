/**
 *  Reveal / Expander Element
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/details/expander.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;
//@todo add in Expander class option
//console.info(wp.components);


registerBlockType("nhsblocks/reveal1", {
  title: __("Simple Reveal", "nhsblocks"),
  category: "nhsblocks",
  icon: "plus-alt",
  styles: [
    {
      name: "downarrow",
      label: __("Down Arrow"),
      isDefault: true
    },
    {
      name: "expander",
      label: __("Plus Icon")
    }
  ],
  attributes: {
    revealTitle: {
      type: "string",
      source: "html",
      selector: ".nhsuk-details__summary-text"
    },
    revealText: {
      type: "string",
      source: "html",
      selector: ".nhsuk-details__text"
    },
      expanderBox: {
        type: "string"
      }
  },

  edit: props => {

    // Lift info from props and populate various constants.
    const {
      attributes: { revealTitle, revealText },
      className,
      setAttributes
    } = props;

    // Grab newRevealTitle, set the value of revealTitle to newRevealTitle.
    const onChangeRevealTitle = newRevealTitle => {
      setAttributes({ revealTitle: newRevealTitle});
    };

    // Grab revealText, set the value of revealText to newRevealtext
    const onChangeRevealText = newRevealText => {
      setAttributes({ revealText: newRevealText });
    };


    return (
        <details className={`${className} nhsuk-details newstyle`} open>
      <summary className="nhsuk-details__summary" role="button" aria-controls="details-content-"
          aria-expanded="true">
          <span className="nhsuk-details__summary-text">
          <RichText
          placeholder={__("Reveal Title", "nhsblocks")}
          value={revealTitle}
          onChange={onChangeRevealTitle}
          />
      </span>
      </summary>
      <div className="nhsuk-details__text" id="details-content-" aria-hidden="false">
          <RichText
              multiline="p"
              placeholder={__("Reveal Contents", "nhsblocks")}
              onChange={onChangeRevealText}
              value={revealText}
              />

  </div>
      </details>
  );
  },
  save: props => {
    const {
      attributes: { revealTitle, revealText }
    } = props;

    return (
        <details className="nhsuk-details" >
  <summary className="nhsuk-details__summary" role="button" aria-controls="details-content-"
      aria-expanded="false">
      <span className="nhsuk-details__summary-text">
          <RichText.Content value={revealTitle} />
  </span>
      </summary>
      <div className="nhsuk-details__text" id="details-content-" aria-hidden="false">
          <RichText.Content
      multiline="p"
      value={revealText}
      />
  </div>
      </details>
    );
  }
});

