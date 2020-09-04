<template>
  <div>
    <div>Welcome {{ name }}</div>
    <form>
      <select name="week" id="week" v-model="week">
        <option disabled value="" selected>Select Week</option>
        <option value="1">Week 1</option>
        <option value="2">Week 2</option>
        <option value="3">Week 3</option>
        <option value="4">Week 4</option>
        <option value="5">Week 5</option>
        <option value="6">Week 6</option>
        <option value="7">Week 7</option>
        <option value="8">Week 8</option>
        <option value="9">Week 9</option>
        <option value="10">Week 10</option>
        <option value="11">Week 11</option>
        <option value="12">Week 12</option>
        <option value="13">Week 13</option>
        <option value="14">Week 14</option>
      </select>

      <select name="skillType" id="skillType" v-model="skillType">
        <option disabled value="" selected>Select Type of skill</option>
        <option value="softSkill">Soft Skill</option>
        <option value="hardSkill">Hard Skill</option>
      </select>

      <select
        name="hardSkills"
        id="hardSkills"
        v-if="skillType == 'hardSkill'"
        v-model="skill"
      >
        <option disabled value="" selected>hard skills</option>
        <option value="9">html</option>
        <option value="10">css</option>
        <option value="11">sccss</option>
        <option value="12">tailwind</option>
        <option value="13">js</option>
        <option value="14">vue</option>
        <option value="15">php</option>
        <option value="16">laravel</option>
      </select>

      <select
        name="softSkills"
        id="softSkills"
        v-else-if="skillType == 'softSkill'"
        v-model="skill"
      >
        <option disabled value="" selected>Soft skills</option>
        <option value="1">Comunicare</option>
        <option value="2">spiritDeEchipa</option>
        <option value="3">organizare</option>
        <option value="4">flexibilitate</option>
        <option value="5">creativitate</option>
        <option value="6">proactiv </option>
        <option value="7"> logic</option>
        <option value="8"> punct</option>
      </select>

      <select
        name="grade"
        id="grade"
        v-model="grade"
        v-if="skillType === 'softSkill' || skillType === 'hardSkill'"
      >
        <option disabled value="" selected>grade</option>
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6 </option>
        <option value="7"> 7</option>
        <option value="8"> 8</option>
        <option value="9"> 9</option>
        <option value="10"> 10</option>
      </select>
    </form>
    <button type="submit" @click="sendData">Submit</button>
  </div>
</template>

<script>
import Store from "../../store/store";
import Axios from "axios";
export default {
  name: "UserPage",
  data() {
    return {
      name: "",
      week: "",
      skillType: "",
      skill: "",
      grade: "",
      user_id: null,
    };
  },
  methods: {
    getData() {
      this.name = Store.userName;
      this.user_id = Store.userId;
    },

    sendData() {
      Axios.post("http://localhost:8888/insertSkills", {
        grade: this.grade,
        week: this.week,
        users_id: this.user_id,
        skill_id: this.skill,
      })
        .then((response) => {
          console.log(response);
          console.log(this.skill);
        })
        .catch((e) => {
          console.log(e.response);
          console.log(this.skill);
        });
    },
  },
  mounted() {
    this.getData();
  },
};
</script>

<style></style>
