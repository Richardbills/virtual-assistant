<template>

    <div class="assessment-component" style="text-align: left;">

        <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
        <br><br>

        <h1 style="text-align: left; font-style: italic;"><span>Oh! <br><span style="color: #1b76d0; font-size: 40px;">sorry</span> seems based on your response so far I would need to advise you to speak directly to a Consultant as your situation does not fully suggest <span style="color: red; font-size: 25px;">depression...</span></span></h1>
        <br><br>

        <div style="text-align: right;">
            <button class="btn btn-md btn-primary" @click="loadConsultantPage" style="float: right;">See our Consultants</button>
        </div>
    </div>

</template>

<script>
export default {
    name: 'AssessmentBreakComponent',
    data() {
        return {
            sessionId : '',
        };
    },
    async mounted() {
        console.log('Assessment Break Component is mounted!');

        this.sessionId = this.$route.query.sessionId;
    },
    methods: {
        loadConsultantPage() {
            window.location.href = "https://virtual-assistant.test/doctors";
        }
    }
}
</script>

<style scoped>
.assessment-component {
    text-align: center;
    padding: 20px;
    font-family: Arial, sans-serif;
}

#message {
    color: red;
    font-weight: bold;
}
</style>
