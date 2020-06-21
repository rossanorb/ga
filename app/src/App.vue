<template>
    <section id="wrapper">
        <aside id="sidebar">
            <ul>
                <li class="user">
                    <h4>Módulo Acadêmico</h4>
                </li>
                <li><a href="">Alunos</a></li>
            </ul>
        </aside>
        <main>
            <nav>
                <h3>Admin Template</h3>
            </nav>
            <router-view />
        </main>
    </section>
</template>

<style lang="scss">
@import 'assets/css/app.scss';
</style>
