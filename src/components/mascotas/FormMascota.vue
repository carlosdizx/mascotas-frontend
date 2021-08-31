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
            <v-text-field v-model="nombre" label="Nombre" name="nombre" />
            <v-text-field v-model="edad" label="Apellidos" name="edad" />
            <v-text-field
              v-model="preocedimiento"
              label="Documento"
              name="preocedimiento"
            />
            <v-text-field v-model="raza" label="Direccion" name="direccion" />
            <v-select
              v-model="tipo"
              name="tipo"
              label="Tipo de animal"
              :items="tipos"
              item-text="nombre"
            />
            <v-file-input
              name="imagen"
              v-model="imagen"
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

export default {
  name: "FormMascota",
  data: () => ({
    dialog: false,
    nombre: "",
    edad: "",
    preocedimiento: "",
    raza: "",
    tipos: [],
    tipo: null,
    imagen: null
  }),
  methods: {
    async cargarInfo() {
      const resultado = await fetch(
        "http://localhost/mascotas/tipo_mascotas.php?all"
      ).then(result => result.json());
      this.tipos = resultado[0];
    },
    async registrarMascota() {
      this.tipos.forEach(tipo => {
        if (tipo.nombre === this.tipo) {
          this.tipo = tipo.id;
        }
      });
      const mascota = {
        nombre: this.nombre,
        edad: this.edad,
        procedimiento: this.procedimiento,
        raza: this.raza,
        tipo: this.tipo,
        imagen: this.imagen
      };
      const resultado = await fetch(
        "http://localhost/mascotas/mascota.php?insertar",
        {
          method: "POST",
          headers: {
            "Content-Type": "multipart/form-data"
          },
          body: {
            nombre: this.nombre,
            edad: this.edad,
            procedimiento: this.procedimiento,
            raza: this.raza,
            tipo: this.tipo,
            imagen: this.imagen
          }
        }
      ).then(result => result.json());
    }
  },
  mounted() {
    this.cargarInfo();
  }
};
</script>

<style scoped></style>
