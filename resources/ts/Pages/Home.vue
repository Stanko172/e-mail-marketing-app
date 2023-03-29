<script lang="ts" setup>
import { ref } from 'vue';

const superAmaazingConst = ref<number>(1);
</script>

<template>
  <div>
    Welcome Home! {{ superAmaazingConst.toFixed(2) }}
  </div>
</template>
