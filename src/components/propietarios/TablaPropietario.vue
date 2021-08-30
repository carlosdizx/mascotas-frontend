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
      </v-toolbar>
    </template>
    <template v-slot:item.acciones="{ item }">
      <v-btn fab dark small color="info darken-4">
        <v-icon>
          mdi-eye
        </v-icon>
      </v-btn>
      <v-btn fab dark small color="orange darken-4">
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
  </v-data-table>
</template>

<script>
export default {
  name: "TablaPropietario",
  data: () => ({
    dialog: false,
    dialogDelete: false,
    columnas: [
      { text: "ID", value: "id" },
      { text: "Nombres", value: "nombres" },
      { text: "Apellidos", value: "apellidos" },
      { text: "Documento", value: "documento" },
      { text: "Direccion", value: "direccion", sortable: false },
      { text: "Telefono", value: "telefono", sortable: false },
      { text: "Correo", value: "correo", sortable: false },
      { text: "Acciones", value: "acciones", sortable: false }
    ],
    filas: [
      {
        id: 1,
        nombres: "Carlos",
        apellidos: "Diaz",
        documento: 1082749257,
        direccion: "Mz g Casa 5, Los heroes",
        telefono: 3163930876,
        correo: "carlodiaz@umariana.edu.co"
      }
    ]
  })
};
</script>

<style scoped></style>
