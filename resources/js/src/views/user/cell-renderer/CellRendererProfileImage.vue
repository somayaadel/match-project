<template>
    <div class="centerx">
        <div class="logo">
            <img
                :src="profileImage"
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
            profileImage: ""
        };
    },
    created() {
        this.profileImage = this.params.data.user_data.profile_image;
    }
};
</script>