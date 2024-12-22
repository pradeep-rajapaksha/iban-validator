<template>
    <div>
        <Header />
        <main>
            <router-view />
        </main>
    </div>
</template>

<script>
import Header from "./components/Header.vue";

export default {
    name: "App",
    components: {
        Header,
    }
};
</script>

<style>
body {
    font-family: Arial, sans-serif;
}
</style>