<template>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6 text-left"><h4>{{title}}</h4></div>
                    <div class="col-6 text-right"><router-link :to="{name:'table'}"><i class="fas fa-users iconadd"></i></router-link></div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="validateBeforeSubmit">
                    <div class="form-row">
                        <div class="form-group col-12 col-sm-6">
                            <label for="nombre">Nombre</label>
                            <input type="text" v-model="nombre" class="form-control" name="nombre" v-validate="'required|alpha_spaces'" id="nombre" placeholder="Introduzca su nombre">
                            <span v-show="errors.has('nombre')" class="text-danger">{{ errors.first('nombre') }}</span>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="email">Email</label>
                            <input type="email" v-model="email" class="form-control" name="email" v-validate="'required|email'" id="email" placeholder="Introduzca su email">
                            <span v-show="errors.has('email')" class="text-danger">{{ errors.first('email') }}</span>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="password">Contraseña</label>
                            <input type="password" v-model="password" class="form-control" name="contraseña" v-validate="(id=='')?'required':''" id="password" placeholder="Introduzca su contraseña">
                            <span v-show="errors.has('contraseña')" class="text-danger">{{ errors.first('contraseña') }}</span>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="roll">Roll</label>
                            <select v-model="roll" v-validate="'required'" name="roll" id="roll" class="form-control">
                                <option value="">Seleccione</option>
                                <option value="usuario">Usuario</option>
                                <option value="vendedor">Vendedor</option>
                                <option value="administrador">Administrador</option>
                            </select>
                            <span v-show="errors.has('roll')" class="text-danger">{{ errors.first('roll') }}</span>
                        </div>
                        <div class="form-group col-12 col-sm-6">
                            <label for="foto">Foto</label>
                            <input type="file" accept=".jpg,.jpeg,.png" ref="fotoFile" id="foto" class="filestyle" data-placeholder="Agregue una foto" data-text="Buscar" @change="addFoto" name="foto" v-validate="(id=='')?'required|mimes:jpg,jpeg,png':'mimes:jpg,jpeg,png'">
                            <span v-show="errors.has('foto')" class="text-danger">{{ errors.first('foto') }}</span>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
			return {
                nombre:"",
                email:"",
                password:"",
                roll:"",
                id:"",
                foto:"",
                url:'http://localhost/macasoft/public/api',
                title:'Agregar usuario'
            }
        },
        mounted(){
            if(this.$route.params.id){
                this.id = this.$route.params.id
                this.getUser()
                this.title = 'Editar usuario'
            }
        },
        methods: {
            validateBeforeSubmit(){
                this.$validator.validateAll().then((result) => {
					if (result) {
						this.sendUser();
					}
				});
            },
            addFoto(e){
                this.foto = this.$refs.fotoFile.files[0]
            },
            sendUser(){
                let url = (this.id=='')?`${this.url}/addUser`:`${this.url}/editUser`;
                let formData = new FormData()
                formData.append('nombre',this.nombre)
                formData.append('email',this.email)
                formData.append('password',this.password)
                formData.append('roll',this.roll)
                formData.append('id',this.id)
                formData.append('foto',this.foto)
                const config = { headers: { 'Content-Type': 'multipart/form-data' } };
                axios.post(url,formData,config).then(response => {
                    this.users = response.data
                    swal.fire({
                        title: '¡Guardado correctamente!',
                        text: 'Éste usuario fue guardado exitosamente.',
                        type: 'success',
                        confirmButtonText: 'Entendido'
                    })
                    .then((result) => {
                        if (result.value) {
                            this.$router.push('/table')
                        }
                    })
                })
            },
            getUser(){
                let url = `${this.url}/getUser`;
                 var data = {
                    id: this.id,
                }
                axios.post(url,data).then(response => {
                    this.nombre = response.data.nombre
                    this.email = response.data.email
                    this.roll = response.data.roll
                    this.foto = response.data.foto
                })
            }
        }
    }
</script>