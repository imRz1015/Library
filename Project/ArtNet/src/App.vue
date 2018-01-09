<template>
	<div id="app">
		<myhead></myhead>
		<router-view/>
		<myfooter></myfooter>
	</div>
</template>

<script>
import myhead from "@/components/Head";
import myfooter from "@/components/Footer";
export default {
	components:{myhead,myfooter}
	
};
</script>

<style>
#app {
    font-family: "Avenir", Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}
</style>
