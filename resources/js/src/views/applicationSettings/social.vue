<template>
    <div class="container">

        <div class="vx-row">

            <div class="vx-col md:w-1/2 w-full mb-base">
                <vx-card title="google login configration" >
                    
                    <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                            <span>Activation</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full ml-auto">
                            <vs-checkbox class="inline-flex" v-model="check1"></vs-checkbox>
                        </div>
                    </div>
                    <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                            <span>Client ID</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                            <vs-input class="w-full" type="text" v-model="input2" />
                        </div>
                    </div>
                    <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                            <span>Client Secret</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                            <vs-input class="w-full" v-model="input3" />
                        </div>
                    </div>
                    
                    <div class="vx-row">
                        <div class="vx-col sm:w-2/3 w-full ml-auto">
                            <vs-button class="mr-3 mb-2">Submit</vs-button>
                            <vs-button color="warning" type="border" class="mb-2" @click="input1 = input2 = input3 = input4 = input4 = ''; check1 = false;">Reset</vs-button>
                        </div>
                    </div>

        
                </vx-card>
            </div>

            <div class="vx-col md:w-1/2 w-full mb-base">
                <vx-card title="facebook login configration" >
                    
                    <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                            <span>Activation</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full ml-auto">
                            <vs-checkbox class="inline-flex" v-model="check1"></vs-checkbox>
                        </div>
                    </div>
                    <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                            <span>App ID</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                            <vs-input class="w-full" type="email" v-model="input2" />
                        </div>
                    </div>
                    <div class="vx-row mb-6">
                        <div class="vx-col sm:w-1/3 w-full">
                            <span>App Secret</span>
                        </div>
                        <div class="vx-col sm:w-2/3 w-full">
                            <vs-input class="w-full" v-model="input3" />
                        </div>
                    </div>
                    
                    <div class="vx-row">
                        <div class="vx-col sm:w-2/3 w-full ml-auto">
                            <vs-button class="mr-3 mb-2">Submit</vs-button>
                            <vs-button color="warning" type="border" class="mb-2" @click="input1 = input2 = input3 = input4 = input4 = ''; check1 = false;">Reset</vs-button>
                        </div>
                    </div>

        
                </vx-card>
            </div>
            
        </div>
        
        
    </div>
</template>

<script>
export default{
	data() {
		return {
			check1: '',
			check2: '',
			check3: '',
			check4: '',
			check5: '',
			check6: '',
			check7: '',
			input1: '',
			input2: '',
			input3: '',
			input4: '',
			
		}
	}
}
</script>
