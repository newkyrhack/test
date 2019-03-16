<template>
    <div class="container-fluid">
        <div class="card mt-2">
            <div class="card-header">
                <div class="row">
                    <div class="col-3 text-left"><h4>Usuarios</h4></div>
                    <div class="col-8">
                        <form>
                            <div class="form-row float-right">
                                <div class="col-auto">
                                    <input type="text" v-model="nombre" class="form-control" name="nombre"  id="nombre" placeholder="Introduzca su nombre">
                                </div>
                                <div class="col-auto">
                                    <select v-model="roll" name="roll" id="roll" class="form-control">
                                        <option value="">Seleccione</option>
                                        <option value="usuario">Usuario</option>
                                        <option value="vendedor">Vendedor</option>
                                        <option value="administrador">Administrador</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button @click="getUsers" type="button" class="btn btn-primary">Filtrar</button>
                                </div>
                                <div class="col-auto">
                                    <button @click="allUsers" type="button" class="btn btn-primary">Todos</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-1 text-right">
                        <router-link :to="{name:'form'}"><i class="fas fa-plus-square iconadd"></i></router-link>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover table-striped text-center">
                            <tr class="thead-dark">
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roll</th>
                                <th>Foto</th>
                                <th>Funciones</th>
                            </tr>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.nombre}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.roll}}</td>
                                <td><img :src="(user.foto!='')?`http://localhost/macasoft/storage/app/${user.foto}`:'http://localhost/macasoft/public/img/user.png'" width="50px"></td>
                                <td>
                                    <router-link :to="`edit/${user.id}`"><i class="fas fa-edit iconfunction"></i></router-link> 
                                    <i @click="deleteUser(user.id)" class="fas fa-trash iconfunction"></i>
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-end">
                            <pagination :data="users" @pagination-change-page="getUsers"></pagination>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
			return {
                users:{},
                nombre:'',
                roll:''
            }
        },
        created() {
            this.getUsers()
        },
        methods: {
            getUsers: function(page=1){
                var config = {
                    headers: {
                        'nombre': this.nombre,
                        'roll': this.roll
                    }
                };
                let url = 'http://localhost/macasoft/public/api/getUsers?page='+page
                axios.get(url,config).then(response => {
                    this.users = response.data
                })
            },
            deleteUser: function(id){
                let url = 'http://localhost/macasoft/public/api/deleteUser'
                swal.fire({
                    title: '¿Esta seguro de eliminar este usuario?',
                    text: "Si elimina este usuario no lo podra recuperar",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Borrar'
                    }).then((result) => {
                    if (result.value) {
                        axios.post(url,{id}).then(response => {
                            location.reload();
                        })
                    }
                })
            },
            allUsers: function(){
                this.nombre=""
                this.roll=""
                this.getUsers()
            }
        }
    }
</script>
