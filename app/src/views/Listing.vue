<template>
<div id="listing">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" v-model="search" class="form-control" placeholder="Digite sua busca" aria-label="Digite sua busca">
                    <div class="input-group-append">
                        <button class="btn btn-primary" @click="find(search)">Pesquisar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <router-link to="/novo" class="btn btn-success btn-block" >Cadastrar Aluno</router-link>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-secondary">
                                <th @click="sort('ra')">Registro Acadêmico<span><IconCarteDown /></span></th>
                                <th @click="sort('name')">Nome<span><IconCarteDown /></span></th>
                                <th @click="sort('email')">E-mail<span><IconCarteDown /></span></th>
                                <th @click="sort('cpf')">CPF<span><IconCarteDown /></span></th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="student in students" :key="student.id">
                                <td>{{student.ra}}</td>
                                <td>{{student.name}}</td>
                                <td>{{student.email}}</td>
                                <td>{{student.cpf}}</td>
                                <td><span class="btn-delete" v-on:click="destroy(student.id)" >excluir</span> |
                                <router-link :to="{ name: 'Update', params: { id: student.id }}">editar</router-link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import IconCarteDown from '@/components/icons/Caretdown.vue';
import { mapState } from 'vuex';
export default {
    name: 'List',
    data: function() {
        return {
            search: '',
            order: false
        };
    },
    components: {
        IconCarteDown
    },
    created() {
        this.$store.dispatch('student/list');
    },
    computed: mapState({
        students: state => state.student.students
    }),
    methods: {
        destroy(id) {
            this.$store.dispatch('student/delete', id).then(() => {
                alert('excluido com sucesso!');
                this.$store.dispatch('student/list');
            });
        },
        find() {
            const queryString = `?order=&by=&limit=&like=${this.search}`;
            if (queryString.length > 2) {
                this.$store.dispatch('student/filter', queryString);
            }
        },
        sort(sort) {
            let order = '';
            this.order = !this.order;
            if (this.order) {
                order = 'asc';
            } else {
                order = 'desc';
            }
            const queryString = `?order=${sort}&by=${order}&limit=&like=${this.search}`;
            this.$store.dispatch('student/filter', queryString);
        }
    }
};
</script>
