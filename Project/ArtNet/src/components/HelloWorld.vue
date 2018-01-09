<template>
    <div>
        <div v-for="(i,key) in goods" :key="key">
            <span>{{key}}：</span><input type="text" v-model="goods[key]">
        </div>
        <button type="button" @click="login">录入</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            goods: {
                images: "",
                colorful: "",
                shape: "",
                price: "",
                status: "",
                appraise: "",
                name: "",
                artist: "",
                material: "",
                size: "",
                time: "",
                classify: "",
                style: "",
                theme: "",
                position: ""
            }
        };
    },
    methods: {
        login() {
            this.$http
                .get("/api/login/checkUser")
                .then(data => {
                    console.log(data.data);
                })
                .catch(reject => {
                    console.log(reject);
                });
        }
    }
};
</script>