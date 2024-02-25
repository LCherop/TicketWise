<template>
   <button @click="count++">You clicked me {{ count }} times.</button>
   <router-view/>
</template>

<script>
export default {
  data() {
    return {
      count: 0
    }
  }
}
</script>

