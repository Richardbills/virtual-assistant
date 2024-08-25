<template>

    <div class="assessment-component" style="text-align: left; color: #000">

        <div>

            <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
            <br><br>

            Thank you Bueze. All done! I have put together a report that outlines the possible causes of your situation.
            <br><br>
            Don't forget that this is not a medical diagnosis. If in doubt it is always best to seek advice from a medical professional
            <br>
            <br>

            <h3><strong>Report</strong></h3>
            <hr>
            <ul>
                <li>Name: Bueze</li>
                <li>Gender: Male</li>
                <li>Date of birth: 24/11/2024</li>
            </ul>

            <br>
            <h2>Summary:</h2>
            <hr>
            You are more likely to be experiencing Postnatal depression which is characterized by 70% of the symptoms you presented with and includes most of the following;
            <ul>
                <li>Sadness</li>
            </ul>

            <h2>Possible solution</h2>
            <hr>
            1.
            <br><br>

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
            ids : [],
            pos : -1,
            curSymptom : 0,
            totalSymptoms : 0,
            responseMessage : '',
            sessionId : '',
        };
    },
    async mounted() {
        console.log('Assessment Result Component is mounted!');

        this.sessionId = this.$route.query.sessionId;

        // Generate unique session identifier
        this.fetchResultSymptoms();
    },
    methods: {
        async fetchResultSymptoms() {
            try {
                const response = await axios.get("/api/v1/fetch-streamline-symptoms");

                if (response.data.question) {
                    this.symptoms = [response.data.question];
                    this.totalSymptoms = response.data.count;
                    this.ids = response.data.ids
                    this.pos += 1;

                    this.curType = response.data.question.type
                    this.curId = response.data.question.id

                    // if(this.totalSymptoms > 0 && this.pos > this.totalSymptoms)
                    // {
                    //     this.$router.push('/result');
                    // }
                }
            } catch (error) {
                // Handle errors
                this.responseMessage = error.response?.data?.message || 'An error occurred';
            }
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
