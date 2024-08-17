<template>
    <div class="example-component">
        <img id="assistant" src="/public/img/eb-assistant.png" alt="EB Assistant Animation">
        <br><br>
        <hr><br>
        <h1><span>Let's get started</span></h1>
        <p>Feel free to summarize how you feel and let's help you identify what the issue might be</p>
        <form class="search-form">
            <input placeholder="Search : I feel fed up with life" type="text">
            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'ExampleComponent',
    mounted() {
        console.log('ExampleComponent is mounted!');
    }
}
</script>

<style scoped>
.example-component {
    text-align: center;
    padding: 20px;
    font-family: Arial, sans-serif;
}
</style>
