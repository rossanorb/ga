<template>
<div id="listing">
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Digite sua busca" aria-label="Digite sua busca">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Pesquisar</button>
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
                                <th>Registro Acadêmico<span><IconCarteDown /></span></th>
                                <th>Nome<span><IconCarteDown /></span></th>
                                <th>E-mail<span><IconCarteDown /></span></th>
                                <th>CPF<span><IconCarteDown /></span></th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="student in students" :key="student.id">
                                <td>{{student.ra}}</td>
                                <td>{{student.name}}</td>
                                <td>{{student.email}}</td>
                                <td>{{student.cpf}}</td>
                                <td><span class="btn-delete" >excluir</span> | <span class="btn-edit">editar</span></td>
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
    name: 'Dashboard',
    components: {
        IconCarteDown
        // HelloWorld
    },
    created() {
        this.$store.dispatch('student/list');
    },
    computed: mapState({
        students: state => state.student.students
    })
};
</script>
