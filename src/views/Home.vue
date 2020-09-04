<template>
  <div class="home">
    <WelcomePage msg="Welcome to Home Page"/>
  </div>
</template>

<script>
// @ is an alias to /src
import WelcomePage from '../components/WelcomePage.vue'

export default {
  name: 'Home',
  components: {
    WelcomePage
  }
}
</script>
