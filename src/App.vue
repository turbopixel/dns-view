<script setup>
import FormDnsRequestWindow from "./components/FormDnsRequestWindow.vue";
</script>

<template>
  <main>
    <FormDnsRequestWindow/>
  </main>
</template>

<style scoped>

main{
  margin: 2rem auto;
}

header{
  line-height: 1.5;
}

@media (min-width: 1024px){
  header{
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }
}
</style>
