<template>
<div id="edit">
    <div class="container mt-3">
        <!-- {{ $route.params.id }} -->
        <!-- {{response}} -->
        <div class="row">
                <div class="col-md-12">
                    <form>
                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Nome</div>
                                </div>
                                <input type="text" class="form-control" id="name" v-model="form.name" name="name" placeholder="Informe o nome completo">
                                <div :class="{'invalid-feedback': error.name == false,'invalid-feedback error': error.name == true}">Nome inválido</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">E-mail</div>
                                </div>
                                <input type="email" class="form-control" id="email" name="email" v-model="form.email" placeholder="Informe apenas um email">
                                <div :class="{'invalid-feedback': error.email == false,'invalid-feedback error': error.email == true}">Email inválido</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">RA</div>
                                </div>
                                <input type="text" class="form-control" id="ra" name="ra" v-model="form.ra" maxlength="10" placeholder="Informe o registro acadêmico"
                                    :disabled="this.id ? true : false"
                                >
                                <div :class="{'invalid-feedback': error.ra == false,'invalid-feedback error': error.ra == true}" >Registro acadêmico inválido</div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">CPF</div>
                                </div>
                                <input type="text" class="form-control" id="cpf" name="cpf" v-model="form.cpf" maxlength="14" placeholder="Informe o número do documento"
                                    :disabled="this.id ? true : false"
                                >
                                <div :class="{'invalid-feedback': error.cpf == false,'invalid-feedback error': error.cpf == true}">CPF válido</div>
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
import { mapState, mapGetters, mapActions } from 'vuex';
export default {
    props: ['id'],
    data: function() {
        return {
            form: {
                name: null,
                email: null,
                ra: null,
                cpf: null
            },
            error: {
                name: false,
                email: false,
                cpf: false,
                ra: false
            },
            validated: false,
            wasUpdated: false
        };
    },
    mounted() {
        if (this.id) {
            this.find(this.id);
        }
    },
    computed: mapState({
        ...mapGetters('student', ['response'])
    }),
    watch: {
        response() {
            if (!this.response.status) {
                alert('Ocorreu um Erro!');
            };
            if (!this.id && this.response.status) {
                alert('Novo aluno adicionado com sucesso!');
                this.$router.push('/');
            };
            if (this.wasUpdated) {
                alert('Aluno editado com sucesso!');
                this.$router.push('/');
            }
            if (this.id) {
                this.form.name = this.response.result.name;
                this.form.email = this.response.result.email;
                this.form.ra = this.response.result.ra;
                this.form.cpf = this.response.result.cpf;
            };
        }
    },
    methods: {
        ...mapActions('student', ['find']),
        isValid() {
            this.error = {
                name: false,
                email: false,
                cpf: false,
                ra: false
            };

            if (!this.form.name) {
                this.error.name = true;
                return false;
            }

            if (!this.form.email) {
                this.error.email = true;
                return false;
            }
            const mailformat = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/;
            if (!this.form.email.match(mailformat)) {
                this.error.email = true;
                return false;
            }

            if (!this.id) {
                if (!this.form.ra || isNaN(this.form.ra)) {
                    this.error.ra = true;
                    return false;
                }
                if (!this.form.cpf) {
                    this.error.cpf = true;
                    return false;
                }
                const cpfformat = /[0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2}/;
                if (!this.form.cpf.match(cpfformat)) {
                    this.error.cpf = true;
                    return false;
                }
            }
            return true;
        },
        submit() {
            this.validated = true;
            if (this.isValid()) {
                if (!this.id) {
                    this.$store.dispatch('student/create', this.form);
                }

                if (this.id) {
                    this.$store.dispatch('student/update', { form: this.form, id: this.id });
                    this.wasUpdated = true;
                }
            }
        }
    }
};
</script>
