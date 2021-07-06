<template>
  <div>
    <vs-button class="button" @click="logInWithFacebook"> Login with Facebook</vs-button>
  </div>
</template>
<script>
export default {
  name:"facebookLogin",
  methods: {
    async logInWithFacebook() {
      await this.loadFacebookSDK(document, "script", "facebook-jssdk");
      await this.initFacebook();
      
      return false;
    },
    login(){
      window.FB.login(function(response) {
        if (response.authResponse) {
          alert("You are logged in &amp; cookie set!");
            console.log(response) ; 
        } else {
          alert("User cancelled login or did not fully authorize.");
        }
      });
    },
    async initFacebook() {
      var component = this ;
      window.fbAsyncInit = function() {
        window.FB.init({
          appId: "164588472032997", //You will need to change this
          cookie: true, // This is important, it's not enabled by default
          version: "v13.0"  
        });
        console.log('aye ha',window.FB);
        
         component.login(); 
      };
    },
    async loadFacebookSDK(d, s, id) {
      var js,
        fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) {
        return;
      }
      js = d.createElement(s);
      js.id = id;
      js.src = "https://connect.facebook.net/en_US/sdk.js";
      fjs.parentNode.insertBefore(js, fjs);
    }
  }
};
</script>
<style>

</style>