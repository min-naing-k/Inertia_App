<template>
  <div class="highlight-wrapper">
    <button v-if="isSupported" class="copy-btn" @click="copy(trimCode)">{{ isCopied ? 'Copied' : 'Copy' }}</button>
    <pre><code ref="codeElement">{{ trimCode }}</code></pre>
  </div>
</template>

<script setup>
import { highlightElement } from '@/Services/SyntaxHighlighting';
import { computed, onMounted, ref } from 'vue';
import useClipboard from '@/composable/useClipboard';

const props = defineProps({
  code: {
    type: String
  }
});
const codeElement = ref(null);
const trimCode = computed(() => props.code.trim());

const { copy, isCopied, isSupported } = useClipboard();

onMounted(() => {
  highlightElement(codeElement.value);
});
</script>

<style>
.highlight-wrapper {
  position: relative;
}

.highlight-wrapper .copy-btn {
  position: absolute;
  top: 0;
  right: 0;
  display: flex;
  padding: .25rem .5rem .5rem;
  margin: .25rem .25rem 0 0;
  color: #fff;
  font-size: .875rem;
  line-height: 1;
  border-radius: .2rem;
}

.highlight-wrapper .copy-btn:hover {
  background-color: rgba(100, 100, 100, 1);
}

.highlight-wrapper code {
  font-family: 'Fira Code';
  border-radius: .5rem;
  font-size: 1rem !important;
}
</style>