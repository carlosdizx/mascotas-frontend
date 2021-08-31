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
          <v-form
            autocomplete="off"
            @submit.prevent="registrarMascota"
            enctype="multipart/form-data"
            method="post"
          >
            <v-text-field v-model="nombre" label="Nombre" />
            <v-text-field v-model="edad" label="Edad" />
            <v-text-field
              v-model="procedimiento"
              label="Procedimiento"
              name="preocedimiento"
            />
            <v-text-field v-model="raza" label="raza" />
            <v-select
              v-model="tipo"
              label="Tipo de animal"
              :items="tipos"
              item-text="nombre"
            />
            <v-file-input
              v-model="imagen"
              type="file"
              label="Imagen de la mascota"
              accept="image/*"
            />
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="red darken-1" dark @click="dialog = !dialog">
                Cancelar
              </v-btn>
              <v-btn color="success darken-1" type="submit">
                Guardar
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-container>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import Swal from "sweetalert2";
import axios from "axios";

export default {
  name: "FormMascota",
  data: () => ({
    dialog: false,
    nombre: "",
    edad: "",
    procedimiento: "",
    raza: "",
    tipos: [],
    tipo: null,
    imagen: null
  }),
  props: {
    id: String
  },
  methods: {
    async cargarInfo() {
      const resultado = await fetch(
        "http://localhost/clinica/mascotas/tipo_mascotas.php?all"
      ).then(result => result.json());
      this.tipos = resultado[0];
    },
    async registrarMascota() {
      await this.tipos.forEach(tipo => {
        if (tipo.nombre === this.tipo) {
          this.tipo = tipo.id;
        }
      });
      const formData = new FormData();
      formData.append("nombre", this.nombre);
      formData.append("edad", this.edad);
      formData.append("procedimiento", this.procedimiento);
      formData.append("raza", this.raza);
      formData.append("tipo", this.tipo);
      formData.append("imagen", this.imagen);
      formData.append("dueño", this.id);

      let respuesta = null;
      await axios
        .post("http://localhost/clinica/mascotas/mascota.php?insertar", formData)
        .then(response => (respuesta = response));
      if (respuesta.data.mensaje === "registro exitoso") {
        await Swal.fire("Registro exitoso", "", "success");
        this.dialog = false;
        this.nombre = "";
        this.edad = "";
        this.procedimiento = "";
        this.raza = "";
        this.imagen = null;
        this.tipo = null;
        return this.$emit("refrescar");
      } else {
        await Swal.fire("Alerta", `${respuesta.data.mensaje}`, "success");
      }
    }
  },
  mounted() {
    this.cargarInfo();
  }
};
</script>

<style scoped></style>
