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
  </v-data-table>
</template>

<script>
export default {
  name: "TablaMascotas",
  data: () => ({
    columnas: [
      { text: "ID", align: "start", sortable: false, value: "id" },
      { text: "Nombre", value: "nombre" },
      { text: "Edad", value: "edad" },
      { text: "Procedimiento", value: "procedimiento" },
      { text: "Raza", value: "raza" },
      { text: "Foto", value: "ruta_foto" },
      { text: "Tipo", value: "tipo" },
    ],
    filas: []
  }),
  methods: {
    cargarInfo() {
      fetch(
        "http://localhost/mascotas/mascota.php?all_propietario=" +
          this.$route.params.id
      )
        .then(response => response.json())
        .then(result => {
          if (!result[0].mensaje) {
            this.filas = result[0];
          }
        });
    }
  },
  mounted() {
    this.cargarInfo();
  }
};
</script>

<style scoped></style>
