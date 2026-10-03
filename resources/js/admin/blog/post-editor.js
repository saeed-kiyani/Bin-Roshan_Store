document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('content');

    if (!textarea || typeof Quill === 'undefined') {
        return;
    }

    const wrapper = document.createElement('div');

    wrapper.id = 'content-editor';
    wrapper.className = 'rounded-lg';

    textarea.parentNode.insertBefore(wrapper, textarea);
    textarea.style.display = 'none';

    const quill = new Quill('#content-editor', {
        theme: 'snow',
        placeholder: 'Write your article content here...',
        modules: {
            toolbar: [
                [{ header: [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ list: 'ordered' }, { list: 'bullet' }],
                [{ indent: '-1' }, { indent: '+1' }],
                ['blockquote', 'code-block'],
                ['link'],
                [{ align: [] }],
                ['clean']
            ]
        }
    });

    const initialContent = textarea.value;

    if (initialContent) {
        quill.root.innerHTML = initialContent;
    }

    const form = textarea.closest('form');

    if (!form) {
        return;
    }

    form.addEventListener('submit', function () {
        textarea.value = quill.root.innerHTML;
    });
});
