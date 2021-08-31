<template>
  <v-dialog persistent v-model="dialog" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="green darken-3" dark class="mb-2" v-bind="attrs" v-on="on">
        Nueva mascota
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Formulario para mascota</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-form autocomplete="off" @submit.prevent="">
            <v-text-field v-model="nombre" label="Nombre" />
            <v-text-field v-model="edad" label="Apellidos" />
            <v-text-field v-model="preocedimiento" label="Documento" />
            <v-text-field v-model="raza" label="Direccion" />
            <v-select />
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" dark @click="dialog = !dialog">
          Cancelar
        </v-btn>
        <v-btn color="success darken-1" @click="">
          Guardar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import Swal from "sweetalert2";

export default {
  name: "FormMascota",
  data: () => ({
    dialog: false,
    nombre: "",
    edad: "",
    preocedimiento: "",
    raza: "",
    telefono: "",
    correo: ""
  }),
  methods: {}
};
</script>

<style scoped></style>
