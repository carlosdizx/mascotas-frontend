<template>
  <v-dialog persistent v-model="dialog" max-width="500px">
  <template v-slot:activator="{ on, attrs }">
    <v-btn
        color="info darken-2"
        small
        fab
        class="mb-2"
        v-bind="attrs"
        v-on="on"
    >
      <v-icon>mdi-image</v-icon>
    </v-btn>
  </template>
  <v-card>
    <v-card-title>
      <span class="text-h5">{{ nombre }}</span>
    </v-card-title>
    <v-card-text>
      <v-img src=""></v-img>
    </v-card-text>
    <v-card-actions>
      <v-btn color="red darken-1" dark @click="dialog = !dialog">
        Cerrar <v-icon>mdi-close</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>
</template>

<script>
export default {
  name: "Visor",
  data: () => ({
    dialog: false,
    nombre: ""
  }),
  props: {
    id: String
  }
}
</script>

<style scoped>

</style>