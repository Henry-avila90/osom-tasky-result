<template>
  <div>
      <div  v-if="success == false">
      <div class="p">
        <label>
          <span class="ui-label">
            Nombre
            <span >°{{ messageName }}</span>
          </span>
          <br/>
          <input type="text" class="inputtext full" placeholder="Nombre y apellidos" name="nombre" v-model="name" v-on:keyup="validateName"/>
        </label>
      </div>
      <div class="p">
        <label>
          <span class="ui-label">
            Email
            <span>°{{ messageEmail }}</span>
          </span>
          <br/>
          <input type="email" class="inputtext full" placeholder="ejemplo@empresa.com" name="email" v-model="email" v-on:keyup="validateEmail"/>
        </label>
      </div>
      <div class="p">
        <label>
          <span class="ui-label">
            Teléfono
            <span>°{{ messagePhone }}</span>
          </span>
          <br/>
          <input type="tel" class="inputtext full" placeholder="10 dígitos" name="telefono" v-model="phone" v-on:keyup="validatePhone"/>
        </label>
      </div>
      <div class="p">
        <button  v-if="checkName == true && checkEmail ==true && checkPhone ==true" class="button" @click="saveUser">Enviar</button>
        <button  v-if="checkName == false || checkEmail ==false || checkPhone ==false" class="button" disabled="true">Enviar</button>
      </div>
    </div>
    <div class="cointainer" v-if="success == true">
        <h2>datos guardados con exito</h2>
    </div>
  </div>
</template>
<script>
import Axios from 'axios';
export default {
    data(){
        return{
            name:"",
            email:"",
            phone:"",
            messageName:"",
            messageEmail:"",
            messagePhone:"",
            checkName:false,
            checkEmail:false,
            checkPhone:false,
            success:false
        }
    },
    methods:{
        validateName(){
            if(!this.name){
                this.messageName = "validando...";
            }
            let arrayName = this.name.split(' ');
            if(arrayName.length <2){
                this.messageName = "introduce tus apellidos";
            }else{
                this.messageName ="Correcto."
                this.checkName = true;
            }
            console.log(arrayName);

        },
        validateEmail(){
            let validDomains = ["gmail","yahoo","hotmail","outlook"];
            let arrayEmail = /^([^]+)@(\w+).(\w+)$/.exec(this.email);
            let domain = false;
            for(let i=0; i < validDomains.length; i++){
                if(validDomains[i] == arrayEmail[2]){
                    domain = true;
                    this.messageEmail="Correcto";
                    this.checkEmail=true;
                    break;
                   
                }else{
                    domain = false;
                    this.messageEmail ="validando..."; 
                    
                }
            }
            if(domain == true){
                this.messageEmail ="Correcto."
            }else{
                this.messageEmail ="Ingrese un correo valido";
            }
        },
        validatePhone(){
            if(!this.phone){
                this.messagePhone = "validando...";
            }
            let numbers = this.phone.length;
            if(numbers <10 || numbers >10){
                this.messagePhone="ingrese numero valido";
            }
            else{
                this.messagePhone = "Correcto.";
                this.checkPhone = true;
            }

            
        },
        saveUser(){
            let json ={
                "name": this.name,
                "email": this.email,
                "phone": this.phone
            };
            axios.post('http://127.0.0.1:8000/api/lead',json)
            .then(data=>{
                this.success = true;
            })
            .catch(error=>{
                
            });
        }
    }
}
</script>

<style>

</style>