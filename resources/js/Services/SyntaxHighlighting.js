import hljs from "highlight.js/lib/core";
import javascript from "highlight.js/lib/languages/javascript";
import html from "highlight.js/lib/languages/xml";
import css from "highlight.js/lib/languages/css";
import php from "highlight.js/lib/languages/php";
import yaml from "highlight.js/lib/languages/yaml";

hljs.registerLanguage("javascript", javascript);
hljs.registerLanguage("html", html);
hljs.registerLanguage("css", css);
hljs.registerLanguage("php", php);
hljs.registerLanguage("yaml", yaml);

import "highlight.js/styles/github-dark.css";

export function highlight(selector) {
  if(! selector) {
    hljs.highlightAll();
    return;
  }

  document.querySelectorAll(`${selector} pre code`).forEach(highlightElement);
}


export function highlightElement(element) {
  hljs.highlightElement(element);
}
