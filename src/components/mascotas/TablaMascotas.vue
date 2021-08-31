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
        <v-toolbar-title>{{ propietario }}</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-toolbar-title>{{ documento }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <FormMascota :id="id" @refrescar="cargarInfo" />
      </v-toolbar>
    </template>
    <template v-slot:item.acciones="{ item }">
      <v-btn fab small color="info" @click="">
        <v-icon>
          mdi-eye
        </v-icon>
      </v-btn>
      <v-btn fab small color="warning" @click="">
        <v-icon>
          mdi-pencil
        </v-icon>
      </v-btn>
      <v-btn fab dark small color="red darken-4" @click="">
        <v-icon>
          mdi-delete
        </v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import FormMascota from "@/components/mascotas/FormMascota";
export default {
  name: "TablaMascotas",
  components: { FormMascota },
  data: () => ({
    propietario: "",
    documento: "",
    columnas: [
      { text: "Nombre", value: "nombre" },
      { text: "Edad", value: "edad" },
      { text: "Raza", value: "raza" },
      { text: "Tipo", value: "tipo" },
      { text: "Procedimiento", value: "procedimiento", sortable: false },
      { text: "Acciones", value: "acciones", sortable: false }
    ],
    filas: [],
    id: "0"
  }),
  methods: {
    async cargarInfo() {
      this.id = this.$route.params.id;
      let resultado = await fetch(
        "http://localhost/clinica/mascotas/propietario.php?id_propietario=" + this.id
      ).then(result => result.json());
      this.propietario = resultado[0].nombres + " " + resultado[0].apellidos;
      this.documento = resultado[0].documento;

      resultado = await fetch(
        "http://localhost/clinica/mascotas/mascota.php?all_propietario=" + this.id
      ).then(response => response.json());

      if (!resultado[0].mensaje) {
        this.filas = resultado[0];
      }
    }
  },
  mounted() {
    this.cargarInfo();
  }
};
</script>

<style scoped></style>
