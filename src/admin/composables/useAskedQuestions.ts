export default () => {
    const qaItems = [
        {
            question: 'What is a tab in album?',
            answer: 'Tab is what you see above the album. One tab represents one image. By default, each tab is numbered starting from 1. If you give an image a title, it will be used instead of the number. If you have tabs with the same title one after another, they will be grouped into one tab. Read more about grouped tabs down below in a separate section where we explain how to group tabs and what they are.',
        },
        {
            question: 'Why giving an image a title is important?',
            answer: 'Image tab title is used as a name for the image in album. By default, each image is numbered starting from 1. If you give an image a title, it will be used instead of the number. For example, if you have an image with your cat, you can give it a title "My cat". When',
        },
    ]

    return {
        qaItems,
    }
}