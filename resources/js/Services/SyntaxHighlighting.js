import hljs from 'highlight.js/lib/common'
// import hljs from 'highlight.js/lib/core';
// import javascript from 'highlight.js/lib/languages/javascript'
// import php from 'highlight.js/lib/languages/php'
// import cpp from 'highlight.js/lib/languages/cpp'


import "highlight.js/styles/github-dark.css";


//
// hljs.registerLanguage("php", php)
// hljs.registerLanguage("cpp", cpp)
// hljs.registerLanguage("javascript", javascript)

export function highlight(selector) {
    if(!selector) {
        hljs.highlightAll();
        return;
    }
    document.querySelectorAll(selector).forEach(
       highlightElement
    )
}

export function highlightElement(element){
    hljs.highlightElement(element)
}
