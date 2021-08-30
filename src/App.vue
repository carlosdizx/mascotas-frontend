<template>
  <v-app>
    <v-main>
      <Toolbar />
      <v-container>
        <router-view />
      </v-container>
    </v-main>
  </v-app>
</template>

<script lang="ts">
import Toolbar from "@/components/Toolbar.vue";
import Vue from "vue";

export default Vue.extend({
  name: "App",
  components: {
    Toolbar
  }
});
</script>
