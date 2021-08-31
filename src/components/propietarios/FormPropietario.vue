<template>
  <v-dialog persistent v-model="dialog" max-width="500px">
    <template v-slot:activator="{ on, attrs }">
      <v-btn color="green darken-3" dark class="mb-2" v-bind="attrs" v-on="on">
        Nuevo propietario
      </v-btn>
    </template>
    <v-card>
      <v-card-title>
        <span class="text-h5">Formulario para propietario</span>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-form autocomplete="off" @submit.prevent="crearPropietario">
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
        <v-btn color="success darken-1" @click="crearPropietario">
          Guardar
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
import Swal from "sweetalert2";

export default {
  name: "FormPropietario",
  data: () => ({
    dialog: false,
    nombres: "",
    apellidos: "",
    documento: "",
    direccion: "",
    telefono: "",
    correo: ""
  }),
  methods: {
    async crearPropietario() {
      const result = await fetch(
        "http://localhost/mascotas/propietario.php?id_propietario_ins",
        {
          method: "POST",
          body: JSON.stringify({
            nombres: this.nombres,
            apellidos: this.apellidos,
            documento: this.documento,
            direccion: this.direccion,
            telefono: this.telefono,
            correo: this.correo
          })
        }
      ).then(result => result.json());

      this.nombres = "";
      this.apellidos = "";
      this.documento = "";
      this.direccion = "";
      this.telefono = "";
      this.correo = "";
      await Swal.fire({
        title: "Registro exitoso 👍",
        timer: 1300,
        showConfirmButton: false
      });
      this.dialog = false;
      this.$emit("refrescar");
    }
  }
};
</script>

<style scoped></style>
