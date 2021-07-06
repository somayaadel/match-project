<template>
    <div class="container">

        <div class="mt-5">
            <vs-tabs alignment="fixed">
                <vs-tab label="general">
                    <general/>
                </vs-tab>
                <vs-tab label="terms & conditions ">
                    <terms/>
                </vs-tab>
                <vs-tab label="Privacy Policy">
                    <privacy/>
                </vs-tab>
                <vs-tab label="SMTP">
                    <SMTP/>
                </vs-tab>
                <vs-tab label="payment">
                    <payment/>
                </vs-tab>
                <vs-tab label="social media login">
                    <social/>
                </vs-tab>
                <vs-tab label="email">
                    <email/>
                </vs-tab>
                <vs-tab label="FAQ">
                    <FAQ/>
                </vs-tab>

            </vs-tabs>
        </div>

    </div>
</template>

<script>
import general from './general.vue' ; 
import terms from './terms.vue' ; 
import privacy from './privacy.vue' ; 
import SMTP from './SMTP.vue' ; 
import payment from './payment.vue' ; 
import email from './email/show.vue' ; 
import FAQ from './FAQ.vue' ; 
import social from './social.vue' ; 

export default {
    components:{
        general, terms , privacy , SMTP , payment , email , FAQ , social ,
    }
}
</script>
<style lang="stylus" scoped>
.container{
    margin-top:150px ; 
}
</style>