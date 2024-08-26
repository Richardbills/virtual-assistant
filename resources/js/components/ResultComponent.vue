<template>

    <div class="assessment-component" style="text-align: left; color: #000">

        <div>

            <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
            <br><br>

            Thank you. All done! I have put together a report that outlines the possible causes of your situation.
            <br>
            Don't forget that this is not a medical diagnosis. If in doubt it is always best to seek advice from a medical professional
            <br>
            <br>

            <h3><strong>Report</strong></h3>
            <hr>
            <ul v-if="symptoms.length > 0">
                <li>Name: {{symptoms[0].name}}</li>
                <li>Gender: {{symptoms[0].gender}}</li>
                <li>Date of birth: {{symptoms[0].dob}}</li>
            </ul>

            <br>
            <h2>Summary:</h2>
            <hr>
            You exhibit symptoms common to the following symptoms based on your submission during the assessment:
            <br><br>
            <div v-for="(symptom, index) in symptoms" :key="index" style="border-left: 5px solid green; padding: 10px; margin-bottom: 15px;">
                <strong>{{ symptom.group }}:</strong>
                <span style="float: right; font-style: italic;">{{Math.round((symptom.yes_count/symptom.total_questions)*100)}}% match</span>
                <br>
                <p v-html="symptom.description"></p>

                <p style="padding: 0px !important;"><strong>Possible solution</strong></p>
                <p v-html="symptom.solution" style="padding: 0px 0px 10px 0px !important;"></p>

                <p style="padding: 0px !important;"><strong>Links</strong></p>
                <p v-html="symptom.link" style="padding: 0px !important;"></p>
            </div>
            <br><br>

            <div class="jumbotron">
                <h4 style="color: red; font-weight: bold;">Need Help?</h4>
                <span>
                    If you think you need more help to navigate your situation.
                    Kindly reach out to any of our consultant or use the chat service<br><br>
                    <button class="btn btn-sm btn-primary" @click="loadConsultantPage" style="float: right;">See our Consultants</button>
                </span>
            </div>
        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    name: 'ResultComponent',
    data() {
        return {
            symptoms : [],
            sessionId : '',
            name : '',
            gender : '',
            dob : '',
            timeLeft: 1000000
        };
    },
    async mounted() {
        console.log('Assessment Result Component is mounted!');

        this.sessionId = this.$route.query.sessionId;
        this.name = this.$route.query.name;
        this.gender = this.$route.query.gender;
        this.dob = this.$route.query.dob;

        this.fetchResultSymptoms();
    },
    methods: {
        async fetchResultSymptoms() {
            try {
                const response = await axios.get("/api/v1/fetch-result-symptoms?session_id="+this.sessionId);
                if (response.data.length > 0) {
                    this.symptoms = response.data;
                }
                else {
                    loadConsultantPage()
                }
            } catch (error) {
                // Handle errors
                this.responseMessage = error.response?.data?.message || 'An error occurred';
            }
        },
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
