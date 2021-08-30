<template>
  <TablaPropietario />
</template>

<script lang="ts">
import Vue from "vue";
import TablaPropietario from "@/components/propietarios/TablaPropietario.vue";

export default Vue.extend({
  name: "Home",

  components: {
    TablaPropietario
  }
});
</script>
