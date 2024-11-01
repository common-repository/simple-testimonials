wp.blocks.registerBlockType('simpletestimonials/testimonials', {
  title: 'Simple Testimonials',
  icon: 'admin-comments',
  category: 'widgets',
  attributes: {
    num_of_testimonials: {type: 'number', default: 1},
    show_all_testimonials: {type: 'boolean', default: false},
    testimonial_categories: {type: 'string'}
  },

  edit: function(props) {
    function updateNumOfTestimonials(value) {
      value = parseInt(value);
      props.setAttributes({num_of_testimonials: value})
    }
    function updateShowAllTestimonials(value) {
      props.setAttributes({show_all_testimonials: value})
    }
    function updateTestimonialCategories(value) {
      props.setAttributes({testimonial_categories: value})
    }

    return React.createElement(
      "div",
      null,
      React.createElement(wp.components.TextControl, {
        label: 'Number of testimonials to display',
        type:'number',
        onChange: updateNumOfTestimonials,
        value: parseInt(props.attributes.num_of_testimonials),
        min:1,
        max:100,
        step:1 }),
      React.createElement(wp.components.ToggleControl, {
        label: 'No limit - show all testimonials',
        checked:props.attributes.show_all_testimonials,
          onChange: updateShowAllTestimonials
      }),
      React.createElement(wp.components.TextControl, {
        label: 'Optional testimonial categories',
        type:'text',
        onChange: updateTestimonialCategories,
        placeholder: 'Comma separated list',
        value: props.attributes.testimonial_categories,
 }),
    );
  },
  save: () => { return null }
})
