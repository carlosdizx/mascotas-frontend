<template>
  <TablaPropietario />
</template>

<script lang="ts">
import Vue from "vue";
import TablaPropietario from "@/components/Listados/TablaPropietario.vue";

export default Vue.extend({
  name: "Home",

  components: {
    TablaPropietario
  }
});
</script>
