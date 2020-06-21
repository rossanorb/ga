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
                <button type="button" class="btn btn-success btn-block">Cadastrar Aluno</button>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr class="table-secondary">
                                <th>Registro Acadêmico<span><IconCarteDown /></span></th>
                                <th>Nome<span><IconCarteDown /></span></th>
                                <th>E-mail<span><IconCarteDown /></span></th>
                                <th>CPF<span><IconCarteDown /></span></th>
                                <th>Ações<span><IconCarteDown /></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1111656</td>
                                <td>Otto</td>
                                <th>E-mail</th>
                                <td>999.999.999-99</td>
                                <td>-</td>
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
export default {
    name: 'Dashboard',
    components: {
        IconCarteDown
        // HelloWorld
    },
    created() {
        this.$store.dispatch('student/list');
    }
};
</script>
