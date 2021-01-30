<template>
  <div>
    <h1 class="text-center">Gestionar articulos</h1>
    <hr />

    <button @click="modificar=false; abrirModal();" type="button" class="btn btn-primary btn-lg my-4">Nuevo</button>

    <!-- Modal -->
    <div class="modal" :class="{mostrar:modal}">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">{{tituloModal}}</h4>
            <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">
              &times;
            </button>
          </div>
          <div class="modal-body">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Nombre:</label>
                <div class="col-12">
                  <input
                    v-model="articulo.nombre"
                    type="text"
                    class="form-control"
                    id="nombre"
                    placeholder=""
                  />
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd"
                  >Descripcion:</label
                >
                <div class="col-12">
                  <input
                   v-model="articulo.descripcion"
                    type="text"
                    class="form-control"
                    id="descripcion"
                    placeholder=""
                  />
                </div>
              </div>

                       <div class="form-group">
                <label class="control-label col-sm-2" for="pwd"
                  >Cantidad:</label
                >
                <div class="col-12">
                  <input
                   v-model="articulo.stock"
                    type="number"
                    class="form-control"
                    id="cantidad"
                    placeholder=""
                  />
                </div>
              </div>
      
             
        
          </div>
          <div class="modal-footer">

               <div class="form-group">
                <div class="col-sm-offset-2 col-12">
                  <button @click="guardar();" type="submit" class="btn btn-primary btn-lg btn-block">Guardar</button>
                </div>
              </div>

            <button @click="cerrarModal();" type="button" class="btn btn-warning btn-lg" data-dismiss="modal">
              Cancelar
            </button>
          </div>
        </div>
      </div>
    </div>

    <table class="table table-striped">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Cantidad</th>
          <th scope="col" colspan="2" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="art in articulos" :key="art.id">
          <td>{{ art.id }}</td>
          <td>{{ art.nombre }}</td>
          <td>{{ art.descripcion }}</td>
          <td>{{ art.stock }}</td>
          <td>
            <button @click="modificar=true; abrirModal(art);"
              type="button"
              class="btn btn-warning"
            >
              Editar
            </button>
          </td>

          <td>
            <button @click="eliminar(art.id)" class="btn btn-danger">
              Eliminar
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>


<script>
export default {
  data() {
    return {

        //Crear articulo
        articulo:{
            nombre: '',
            descripcion:'',
            stock: 1,

        },

        //Mod
        id:0,

        modal:0,
        modificar:true,
        tituloModal:'',
        articulos: [],
    };
  },
  methods: {
    async listar() {
      const res = await axios.get("/articulos");
      this.articulos = res.data;
    },

    async eliminar(id) {
      const res = await axios.delete("/articulos/" + id);
      this.listar();
    },

      async guardar() {
         
         if(this.modificar){
             //Editar articulo
            const res = await axios.put("/articulos/" + this.id, this.articulo);
         }

         else{
             //Crear articulo
             const res = await axios.post("/articulos/",this.articulo);
    
         }
         this.cerrarModal();
         this.listar();
     

    },
    abrirModal(data={}){
        this.modal=1;
        if(this.modificar==true){
            this.id=data.id;
            this.tituloModal='Modificar Articulo';
            this.articulo.nombre=data.nombre;
            this.articulo.descripcion=data.descripcion;
            this.articulo.stock=data.stock;
        }

        else{
            this.id=0;
            this.tituloModal = 'Crear Articulo';
            this.articulo.nombre='';
            this.articulo.descripcion='';
            this.articulo.stock=1;
        }
    },
    cerrarModal(){
        this.modal=0;
    },
  },

  created() {
    this.listar();
  },
};
</script>

<style>
    .mostrar{
        display: list-item;
        opacity: 1;
        background: rgb(68, 64, 64);
    }

</style>