<script id="numbers_analyzer_plugin">
    window.addEventListener('DOMContentLoaded', (event) => {
        const classLink = "{{ numbers_analyzer_plugin()->get('class_link') }}";
        const cookie = "{{ $cookie }}";
        const domain = "{{ numbers_analyzer_plugin()->get('domain') }}";
        const buttonContent = "{!! numbers_analyzer_plugin()->get('button_content') !!}";

        if (!classLink || !cookie || !domain || !buttonContent) {
            return;
        }

        document.querySelectorAll(`.${classLink}`)?.forEach((element) => {
            const link = `${location.protocol}//${domain}/auth/wordpress?c=${cookie}`;
            if (element.tagName === "IFRAME") {
                element.setAttribute('src', link);
            } else if (element.tagName === "A") {
                element.setAttribute('href', link);
            }
        });
    });
</script>