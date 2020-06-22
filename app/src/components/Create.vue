<template>
<div id="edit">
    <div class="container mt-3">
        <div class="row">
                <div class="col-md-12">
                    <form :class="{
                        'needs-validation was-validated': validated == true,
                        'needs-validation': validate = false
                    }">
                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nome</div>
                                </div>
                                <input type="text" class="form-control" id="name" v-model="form.name" name="name" placeholder="Informe o nome completo" required="">
                                <div class="invalid-feedback">O campo nome é obrigatório</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">E-mail</div>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" v-model="form.email" placeholder="Informe apenas um email" required="">
                                <div class="invalid-feedback">Informe um email válido</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">RA</div>
                                </div>
                                <input type="text" class="form-control" id="ra" name="ra" v-model="form.ra" placeholder="Informe o registro acadêmico" pattern="\d*" required="">
                                <div class="invalid-feedback">O campo registro acadêmico é obrigatório</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">CPF</div>
                                </div>
                                <input type="text" class="form-control" id="cpf" name="cpf" v-model="form.cpf" placeholder="Informe o número do documento" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}" required="">
                                <div class="invalid-feedback">Informe um CPF válido</div>
                            </div>
                        </div>
                   </form>
                </div>
                <div class="col-md-12 mt-5">
                    <div class="form-group row">
                        <router-link class="btn btn-secondary btn-lg" to="/">Cancelar</router-link>
                        <button type="submit" class="btn btn-primary btn-lg ml-1"  @click="submit()" >Salvar</button>
                    </div>
                </div>
        </div>
    </div>
</div>
</template>

<script>
import { mapState, mapGetters } from 'vuex';
export default {
    data: function() {
        return {
            form: {},
            validated: false
        };
    },
    computed: mapState({
        ...mapGetters('student', ['response'])
    }),
    watch: {
        response() {
            if (!this.response.status) {
                alert('Ocorreu um Erro!');
            }

            if (this.response.status) {
                alert('Novo usuario adicionado com sucesso!');
                this.$router.push('/');
            }
        }
    },
    methods: {
        isValid() {
            if (!this.form.name) {
                return false;
            }
            if (!this.form.email) {
                return false;
            }
            if (!this.form.ra) {
                return false;
            }
            if (!this.form.cpf) {
                return false;
            }

            return true;
        },
        submit() {
            this.validated = true;
            if (this.isValid()) {
                this.$store.dispatch('student/create', this.form);
            }
        }
    }
};
</script>
