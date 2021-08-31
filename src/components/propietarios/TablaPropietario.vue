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
        <FormPropietario @refrescar="cargarPropietarios" />
      </v-toolbar>
    </template>
    <template v-slot:item.acciones="{ item }">
      <FormPropietarioEditar :id="item.id" @refrescar="cargarPropietarios" />
      <v-btn fab dark small color="red darken-4" @click="eliminar(item.id)">
        <v-icon>
          mdi-delete
        </v-icon>
      </v-btn>
    </template>
    <template v-slot:item.id="{ item }">
      <router-link :to="'detalles/' + item.id" v-slot="{ navigate }" custom>
        <v-btn fab dark small color="info darken-2" @click="navigate">
          {{ item.id }}
          <v-icon>
            mdi-eye
          </v-icon>
        </v-btn>
      </router-link>
    </template>
  </v-data-table>
</template>

<script>
import FormPropietario from "@/components/propietarios/FormPropietario";
import FormPropietarioEditar from "@/components/propietarios/FormPropietarioEditar";
import Swal from "sweetalert2";
export default {
  name: "TablaPropietario",
  components: {
    FormPropietario,
    FormPropietarioEditar
  },
  data: () => ({
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
    cargarPropietarios() {
      fetch("http://localhost/mascotas/propietario.php?all_propietarios")
        .then(response => response.json())
        .then(result => {
          if (!result[0].mensaje) {
            this.filas = result;
          }
        });
    },
    async eliminar(id) {
      await Swal.fire({
        title: "¿Desea eliminar este registro?",
        text:
          "Tenga en cuenta que no se podra eliminar si el propietario tiene mascotas registradas",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#42b03d",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, eliminar!"
      }).then(async result => {
        if (result.isConfirmed) {
          const resultado = await fetch(
            "http://localhost/mascotas/?id_propietario_del=" + id
          ).then(result => result.json());
          if (resultado.mensaje !== "eliminado") {
            await Swal.fire("No eliminado!", "No se pudo eliminar", "error");
          } else {
            await Swal.fire("Eliminado!", "Propietario eliminado", "success");
          }
          await this.cargarPropietarios();
        }
      });
    }
  },
  mounted() {
    this.cargarPropietarios();
  }
};
</script>

<style scoped></style>
