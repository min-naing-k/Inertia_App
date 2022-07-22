import { ref } from "vue";

export default function useClipboard() {
  let isCopied = ref(false);
  // const isSupported = navigator && 'clipboard' in navigator;
  const isSupported = Boolean(navigator && navigator.clipboard);

  const copy = (text) => {
    if(navigator && navigator.clipboard) {
      navigator.clipboard.writeText(text);
      isCopied.value = true;

      setTimeout(() => {
        isCopied.value = false;
      }, 5000);

      return;
    }

    alert('Apologies, your brower does not support Clipboard API');
  }

  return {
    copy,
    isCopied,
    isSupported
  }
}