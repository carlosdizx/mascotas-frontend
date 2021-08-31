<template>
  <v-data-table
    :headers="columnas"
    :items="filas"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <router-link to="/" v-slot="{ navigate }" custom>
          <v-btn fab small color="info" @click="navigate" role="link">
            <v-icon>mdi-arrow-left</v-icon>
          </v-btn>
        </router-link>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-toolbar-title>Detalles del propietario</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-toolbar-title>Sus mascotas</v-toolbar-title>
        <v-spacer></v-spacer>
      </v-toolbar>
    </template>
    <template v-slot:item.acciones="{ item }">
      <v-btn fab dark small color="red darken-4">
        <v-icon>
          mdi-delete
        </v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
export default {
  name: "TablaMascotas",
  data: () => ({
    columnas: [
      { text: "ID", align: "start", sortable: false, value: "id" },
      { text: "Nombre", value: "nombre" }
    ],
    filas: []
  }),
  props: {
    idPropietario: String
  },
  methods: {
    cargarInfo() {
      console.log(this.$route.params.id);
    }
  },
  mounted() {
    this.cargarInfo();
  }
};
</script>

<style scoped></style>
