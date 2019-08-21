/**
 *  NHS Panel Element
 *  @reference: https://nhsuk.github.io/nhsuk-frontend/components/panel/index.html
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */
const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText, InnerBlocks } = wp.blockEditor;
//@todo add in Panel class variations
//@todo add in width variations
const TEMPLATE_OPTIONS = [
        [ 'core/paragraph', { placeholder: 'Panel Text' } ],
          [ 'nhsblocks/nhsbutton', { align: 'right'} ],
];
registerBlockType("nhsblocks/panel1", {
  title: __("Panel Region", "nhsblocks"),
  description: __("By default this block includes a title, block of text and button link. You can remove the button" +
      " if you wish by clicking it then clicking three dots on the navigation bar at the top of the page then the" +
      " bin", "nhsblocks"),
  icon: "feedback",
  category: "nhsblocks",
  styles: [
    {
      name: "default",
      label: __("Plain white panel"),
      isDefault: true
    },
    {
      name: "panel-grey",
      label: __("Grey")
    },
    {
      name: "panel-with-label",
      label: __("With Label")
    }
  ],
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

return (
    <div className={`${className} nhsuk-panel`}>
<h3>
<RichText
placeholder={__("Panel Title", "nhsblocks")}
value={panelTitle}
onChange={onChangePanelTitle}
/>
</h3>
<div className="paneltext">
    <InnerBlocks
template={ TEMPLATE_OPTIONS }
/>
</div>
</div>
);
},
  save: props => {
     // console.info(props);

      const {
      attributes: {
        panelTitle }
    } = props;

    return (
          <div className="nhsuk-panel">
            <h3>
              <RichText.Content value={panelTitle} />
            </h3>
            <div className="paneltext">
                <InnerBlocks.Content />
            </div>
          </div>
    );
  }
});

