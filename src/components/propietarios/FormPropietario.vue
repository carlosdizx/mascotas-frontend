<template>
  <v-dialog v-model="dialog" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="indigo" dark class="mb-2" v-bind="attrs" v-on="on">
        Nuevo propietario
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Formulario para propietario</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-form autocomplete="off">
            <v-text-field label="Nombres" />
            <v-text-field label="Apellidos" />
            <v-text-field label="Documento" />
            <v-text-field label="Direccion" />
            <v-text-field label="Telefono" />
            <v-text-field label="Correo" />
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" dark @click="dialog = !dialog">
          Cancelar
        </v-btn>
        <v-btn color="success darken-1">
          Guardar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "FormPropietario",
  data: () => ({
    dialog: false
  })
};
</script>

<style scoped></style>
