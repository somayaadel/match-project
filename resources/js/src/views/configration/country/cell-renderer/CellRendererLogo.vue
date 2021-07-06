<template>
    <div class="centerx">
        <div class="logo">
            <img
                :src="logo"
                alt="content-img"
                class="responsive card-img-top company-imgg p-3"
                style="width:100px; hight:30px"
            />
        </div>
    </div>
</template>
<script>
export default {
    name: "CellRendererLogo",
    data() {
        return {
            logo: ""
        };
    },
    created() {
        this.logo = this.params.data.logo;
    }
};
</script>