const { registerBlockType } = wp.blocks;

registerBlockType('igv/test-block', {
  // built-in attr
  title: 'Call to Action',
  description: 'Generate a Custom Call to Action',
  icon: 'format-image',
  category: 'layout',
  // custom attr
  attributes: {
    'author': {
      'type': 'string'
    }
  },
  // built-in func
  edit({ attributes, setAttributes }) {
    function updateAuthor(event) {
      console.log(event.target.value);
      setAttributes({author: event.target.value});
    }
    return <input value={attributes.author} onChange={updateAuthor} type="text" />;
  },
  save({ attributes }) {
    return <div>{attributes.author}</div>;
  }
})
