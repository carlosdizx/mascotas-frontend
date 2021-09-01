<template>
  <v-dialog persistent v-model="dialog" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn
        color="warning"
        small
        fab
        class="mb-2"
        v-bind="attrs"
        v-on="on"
        @click="buscarPropietario"
      >
        <v-icon>mdi-pencil</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Propietario {{ id }}</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-form autocomplete="off" @submit.prevent="">
            <v-text-field v-model="nombres" label="Nombres" />
            <v-text-field v-model="apellidos" label="Apellidos" />
            <v-text-field v-model="documento" label="Documento" />
            <v-text-field v-model="direccion" label="Direccion" />
            <v-text-field v-model="telefono" label="Telefono" />
            <v-text-field v-model="correo" label="Correo" />
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="red darken-1" dark @click="dialog = !dialog">
          Cancelar
        </v-btn>
        <v-btn color="success darken-1" @click="actualizarPropietario">
          Actualizar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import Swal from "sweetalert2";

export default {
  name: "FormPropietarioEditar",
  data: () => ({
    dialog: false,
    nombres: "",
    apellidos: "",
    documento: "",
    direccion: "",
    telefono: "",
    correo: ""
  }),
  props: {
    id: String
  },
  methods: {
    async buscarPropietario() {
      const result = await fetch(
        "http://localhost/clinica/mascotas/propietario.php?id_propietario=" + this.id
      ).then(result => result.json());
      const datos = result[0];
      this.nombres = datos.nombres;
      this.apellidos = datos.apellidos;
      this.documento = datos.documento;
      this.direccion = datos.direccion;
      this.telefono = datos.telefono;
      this.correo = datos.correo;
    },
    async actualizarPropietario() {
      const result = await fetch(
        "http://localhost/clinica/mascotas/propietario.php?id_propietario_upd",
        {
          method: "POST",
          body: JSON.stringify({
            id: this.id,
            nombres: this.nombres,
            apellidos: this.apellidos,
            documento: this.documento,
            direccion: this.direccion,
            telefono: this.telefono,
            correo: this.correo
          })
        }
      ).then(result => result.json());

      await Swal.fire({
        title: "Datos acutalizados con exito 👍",
        timer: 1300,
        showConfirmButton: false
      });
      this.dialog = false;
      this.$emit("refrescar");
    }
  },
  mounted() {
    this.buscarPropietario();
  }
};
</script>

<style scoped></style>
