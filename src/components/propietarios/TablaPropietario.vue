<template>
  <v-data-table
    :headers="columnas"
    :items="filas"
    sort-by="calories"
    class="elevation-1"
  >
    <template v-slot:top>
      <v-toolbar flat>
        <v-toolbar-title>Propietarios</v-toolbar-title>
        <v-divider class="mx-4" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <FormPropietario />
      </v-toolbar>
    </template>
    <template v-slot:item.acciones="{ item }">
      <v-btn fab small color="warning">
        <v-icon>
          mdi-pencil
        </v-icon>
      </v-btn>
      <v-btn fab dark small color="red darken-4">
        <v-icon>
          mdi-delete
        </v-icon>
      </v-btn>
    </template>
    <template v-slot:item.id="{ item }">
      <v-btn fab dark small color="info darken-2">
        {{ item.id }}
        <v-icon>
          mdi-eye
        </v-icon>
      </v-btn>
    </template>
  </v-data-table>
</template>

<script>
import FormPropietario from "@/components/propietarios/FormPropietario";
export default {
  name: "TablaPropietario",
  components: {
    FormPropietario
  },
  data: () => ({
    dialog: false,
    dialogDelete: false,
    columnas: [
      { text: "Mas detalles", align: "start", sortable: false, value: "id" },
      { text: "Nombres", value: "nombres" },
      { text: "Apellidos", value: "apellidos" },
      { text: "Documento", value: "documento" },
      { text: "Direccion", value: "direccion", sortable: false },
      { text: "Telefono", value: "telefono", sortable: false },
      { text: "Correo", value: "correo", sortable: false },
      { text: "Acciones", value: "acciones", sortable: false }
    ],
    filas: []
  }),
  methods: {
    cargarDatos() {
      fetch("http://localhost/mascotas/?all_propietarios")
        .then(response => response.json())
        .then(result => (this.filas = result));
    }
  },
  mounted() {
    this.cargarDatos();
  }
};
</script>

<style scoped></style>
