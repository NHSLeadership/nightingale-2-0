/**
 *  NHS Latest News Block
 *  @reference: n/a - new element for this theme
 *  @author Tony Blacker, NHS Leadership Academy
 *  @version 1.0 22nd July 2019
 */

const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { RichText } = wp.blockEditor;
const { withSelect } = wp.data;


registerBlockType("nhsblocks/latestnews", {
  title: __("Latest Posts / News", "nhsblocks"),
  category: "nhsblocks",


  edit:
      withSelect( select => {
    return {
      // Send a GET query to the REST API.
      posts: select( "core" ).getEntityRecords( "postType", "post", {
        per_page: 6
      })
    };
  })(({ posts, className }) => {
    // Wait for posts to be returned.
    if ( !posts ) {
      return "Loading...";
    }

    // If no posts are returned.
    if ( posts && posts.length === 0 ) {
      return "No posts";
    }

    // Grab the first post.
    const post = posts[0];

    const featImg = imageURL => {
      return imageURL ? imageURL : '';
    }

    return (
        <div className="nhsuk-grid-column-one-'.$width.' nhsuk-panel-group__item">
          <div className="nhsuk-panel">
              <h3>
                <RichText.Content value={post.title.rendered} />
              </h3>
              <img src={featImg(post.featured_image_nhsblocksFeatImg_url)} alt="{post.title.rendered}" />
              <RichText.Content value={post.excerpt.rendered} />
              <a href={post.link}>Read More Link</a>
          </div>
        </div>
    );
  }),

  save(props) {
    return null;
  }
});
