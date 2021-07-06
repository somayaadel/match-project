<template>
  <div class="containe" :key="key">
    <div class="vx-row center">
      <div class="vx-col w-1/4">
        <statistics-card-line
          hideChart
          class="mb-base"
          icon="UsersIcon"
          :statistic="this.allUser.length"
          statisticTitle="total users"
        />
      </div>

      <div class="vx-col w-1/4">
        <statistics-card-line
          hideChart
          class="mb-base"
          icon="UsersIcon"
          :statistic="this.freeUser.length"
          statisticTitle="free users"
          color="dark"
        />
      </div>

      <div class="vx-col w-1/4">
        <statistics-card-line
          hideChart
          class="mb-base"
          icon="UsersIcon"
          :statistic="this.premiumUser.length"
          statisticTitle="premium users"
          color="warning"
        />
      </div>

      <div class="vx-col w-1/4">
        <statistics-card-line
          hideChart
          class="mb-base"
          icon="UsersIcon"
          :statistic="this.blockedUser.length"
          statisticTitle="blocked users"
          color="danger"
        />
      </div>
    </div>

    <div class="vx-row center">
      <div class="vx-col w-2/3">
        <div class="vx-row">
          <div class="vx-col w-1/3">
            <statistics-card-line
              hideChart
              class="mb-base"
              icon="UsersIcon"
              v-if="this.lastMonthsEarnings[300]"
              :statistic="this.lastMonthsEarnings[300]"
              statisticTitle="total earnings"
            />
          </div>

          <div class="vx-col w-1/3">
            <statistics-card-line
              hideChart
              v-if="this.lastMonthsEarnings[1]"
              class="mb-base"
              icon="UsersIcon"
              :statistic="this.lastMonthsEarnings[1]"
              statisticTitle="last month"
              color="warning"
            />
          </div>

          <div class="vx-col w-1/3">
            <statistics-card-line
              hideChart
              v-if="this.lastMonthsEarnings[3]"
              class="mb-base"
              icon="UsersIcon"
              :statistic="this.lastMonthsEarnings[3]"
              statisticTitle="last 3 months"
              color="dark"
            />
          </div>
        </div>
      </div>
      <div class="vx-col w-1/3">
        <div class="vx-row">
          <div class="vx-col w-1/2">
            <statistics-card-line
              hideChart
              v-if="this.lastMonthsEarnings[6]"
              class="mb-base"
              icon="UsersIcon"
              :statistic="this.lastMonthsEarnings[6]"
              statisticTitle="half yearly"
              color="danger"
            />
          </div>
          <div class="vx-col w-1/2" >
            <statistics-card-line
              hideChart
              v-if="this.lastMonthsEarnings[12]"
              class="mb-base"
              icon="UsersIcon"
              :statistic="this.lastMonthsEarnings[12]"
              statisticTitle="yearly"
              color="success"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import StatisticsCardLine from "@/components/statistics-cards/StatisticsCardLine.vue";
import axios from "../axios.js";

export default {
  components: {
    StatisticsCardLine,
  },
  computed: {
    application_id() {
      return this.$store.state.application_id;
    },
  },
  data() {
    return {
      // Area charts
      subscribersGained: {},
      revenueGenerated: {},
      quarterlySales: {},
      ordersRecevied: {},

      // Line Charts
      siteTraffic: {},
      activeUsers: {},
      newsletter: {},
      allUser: [],
      freeUser: [],
      premiumUser: [],
      blockedUser: [],
      allEarnings: "",
      lastMonthsEarnings :{} , 
      key : 0 , 
    };
  },
  mounted() {
    this.getallUser();
    this.getpremiumUser();
    this.getfreeUser();
    this.getblockedUser();
    this.getEarning() ; 
  },
  methods: {
    getallUser() {
      axios
        .get("/api/user/?application_id="+this.application_id)
        .then((res) => {
          this.allUser = res.data.data;
        })
        .catch((err) => {});
    },
    getfreeUser() {
      axios
        .get("/api/free_users/?application_id="+this.application_id)
        .then((res) => {
          this.freeUser = res.data.data;
        })
        .catch((err) => {});
    },
    getpremiumUser() {
      axios
        .get("/api/premium_users/?application_id="+this.application_id)
        .then((res) => {
          this.premiumUser = res.data.data;
        })
        .catch((err) => {});
    },
    getblockedUser() {
      axios
        .get("/api/blocked_users/?application_id="+this.application_id)
        .then((res) => {
          this.blockedUser = res.data.data;
        })
        .catch((err) => {});
    },
    async getEarning(){
       await this.getEarningByMonths(1) ; 
       await this.getEarningByMonths(3) ; 
       await this.getEarningByMonths(6) ; 
       await this.getEarningByMonths(12) ; 
       await this.getEarningByMonths(300) ; 
       this.key++ ; 
    },
    getEarningByMonths(months ) {
      return axios
        .get("/api/recentEarnings?months="+months+"&application_id="+this.application_id)
        .then((res) => {
            this.lastMonthsEarnings[months] = res.data.data+ " EGP";
        })
        .catch((err) => {});
    },
  },
};
</script>

<style scoped>
.containe {
  margin-top: 150px;
}
.center {
  margin: 0 auto;
  width: 90%;
  padding: 10px;
}
</style>
