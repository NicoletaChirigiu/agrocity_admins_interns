<template>
  <div class="register">
    <div class="register__container">
      <div class="register-title">
        Register
      </div>
      <p>Please fill in this form to create an acount.</p>

      <form class="register__form">
        <div v-if="errors.length">
          <b>Please correct the following error(s):</b>
          <ol>
            <li v-for="error in errors" :key="error">{{ error }}</li>
          </ol>
        </div>

        <input
          type="text"
          name="name"
          id="name"
          placeholder="Enter Your Name"
          required
          v-model="userName"
        />
        <input
          type="email"
          pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
          name="email"
          id="email"
          placeholder="Enter Email"
          required
          v-model="userEmail"
        />
        <input
          type="password"
          name="password"
          id="password"
          placeholder="Enter Password"
          autocomplete="cc-csc"
          required
          v-model="userFirstPassword"
        />
        <input
          type="password"
          name="password-repeat"
          id="password-repeat"
          placeholder="Repeat Password"
          autocomplete="cc-csc"
          required
          v-model="userCheckPassword"
        />
        <input
          type="text"
          name="decription"
          id="description"
          placeholder="Please enter a description about you"
          required
          v-model="userDescription"
        />
        <select name="teams" id="teams" v-model="userTeamSelection" required>
          <option disabled selected value="">Please select your team</option>
          <option value="team1">Team 1</option>
          <option value="team2">Team 2</option>
          <option value="team3">Team 3</option>
          <option value="team4">Team 4</option>
        </select>
        <button type="submit" @click="checkForm">Register</button>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  name: "RegisterPage",
  data() {
    return {
      errors: [],
      userName: null,
      userEmail: null,
      userFirstPassword: null,
      userCheckPassword: null,
      userPassword: false,
      userDescription: null,
      userTeamSelection: "",
    };
  },
  methods: {
    generateKey() {
      Math.random();
    },
    registerData() {
      axios
        .post("http://localhost:8888/register", {
          users_email: this.userEmail,
          users_password: this.userPassword,
          users_description: this.userDescription,
          users_name: this.userName,
          users_team: this.userTeamSelection,
        })
        .then((response) => {
          console.log(response);
          if(response.status === 200 && response.data.includes("Registered") ){
          this.$router.replace({name: 'Home'});
          console.log(response.data);
          }
        })
        .catch((e) => {
          console.log(e.response);
          if (e.response.status === 303)
            this.errors.push("This adress email is already used");
        });
    },

    checkPassword() {
      if (this.userFirstPassword === this.userCheckPassword) {
        this.userPassword = this.userCheckPassword;
      } else {
        this.errors.push("Passwords dosen't match");
      }
    },
    checkForm(e) {
      this.errors = [];
      if (!this.userEmail) this.errors.push("Email required");
      if (!this.userName) this.errors.push("Name required");
      this.checkPassword();
      if (!this.userPassword) this.errors.push("Password required");
      if (!this.userDescription) this.errors.push("Description required");
      if (this.userTeamSelection === "")
        this.errors.push("userTeamSelection required");
      if (Array.isArray(this.errors) && !this.errors.length) {
        e.preventDefault();
        console.log(this.errors.length);
        this.registerData();
      }
    },
  },
};
</script>

<style scoped>
.register__form {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
</style>
