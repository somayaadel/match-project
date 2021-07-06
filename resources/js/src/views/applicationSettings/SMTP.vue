<template>
    <div class="container">

  
        <div class="vx-row mb-6">
            <div class="vx-col sm:w-1/3 w-full">
                <span>SMTP Host</span>
            </div>
            <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" />
            </div>
        </div>
    
        

        <div class="vx-row mb-6">
            <div class="vx-col sm:w-1/3 w-full">
                <span>SMTP Port</span>
            </div>
            <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" />
            </div>
        </div>


        <div class="vx-row mb-6">
            <div class="vx-col sm:w-1/3 w-full">
                <span>SMTP User</span>
            </div>
            <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" />
            </div>
        </div>


        <div class="vx-row mb-6">
            <div class="vx-col sm:w-1/3 w-full">
                <span>SMTP password</span>
            </div>
            <div class="vx-col sm:w-2/3 w-full">
                <vs-input class="w-full" />
            </div>
        </div>






        <div class="vx-row">
        <div class="vx-col sm:w-2/3 w-full ml-auto">
            <vs-button class="mr-3 mb-2">save</vs-button>
            <vs-button color="warning" type="border" class="mb-2" @click="input1 = input2 = input3 = input4 = input4 = ''; check1 = false;">Reset</vs-button>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    
}
</script>
<style lang="stylus" scoped>
.container{
    margin-top:150px ; 
}
</style>