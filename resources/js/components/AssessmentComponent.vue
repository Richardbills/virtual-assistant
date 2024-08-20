<template>

    <div class="assessment-component" style="text-align: left;">
        <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
        <br><br>

        <h1 style="text-align: left;"><span>Kindly answer <br>the following questions</span></h1>
        <span>Respond with a Yes / No</span>

        <hr>
        <div id="questionContainer">
            <!-- Question goes here ... -->
             <h2>Do you experience headache?</h2>
             <h5>Do you experience headache?</h5>
             <h4 style="font-size: 15px;">{{ curSymptoms }} / {{ totalSymptoms }}</h4>

             <br>

            <input class="radio" type="radio" name="response" v-model="selectedResponse" value="YES" id="yesOption" />
            <label for="yesOption" style="font-size: 20px; font-weight: bold; color: black;">YES</label>

             <input class="radio" type="radio" name="response" v-model="selectedResponse" value="NO" id="noOption" />
             <label for="noOption" style="font-size: 20px; font-weight: bold; color: black;">NO</label>

            <br>
            <div style="text-align: right;">
                <button class="btn btn-md btn-primary" @click="nextQuestion" style="float: right;">Next</button>
            </div>

        </div>
    </div>

</template>

<script>
import axios from 'axios';

export default {
    name: 'AssessmentComponent',
    data() {
        return {
            symptoms : [],
            curSymptoms : 0,
            totalSymptoms : 0,
            selectedResponse: '',
            responseMessage : '',
        };
    },
    mounted() {
        console.log('Assessment Component is mounted!');
        this.fetchGeneralSymptoms()

        anime({
            targets: '.assessment-component',
            translateY: 30,
            duration: 9000,
        });
    },
    methods: {
        async fetchGeneralSymptoms() {
                try {
                    // Send POST request to Laravel API
                    const response = await axios.get('/api/v1/fetch-common-symptoms');

                    if (response.data.length > 0) {
                        this.symptoms = response.data;
                        this.totalSymptoms = response.data.length;
                    }
                    else {
                        this.responseMessage = 'No symptoms loaded';
                    }
                } catch (error) {
                    // Handle errors
                    this.responseMessage = error.response?.data?.message || 'An error occurred';
                } finally {
                    this.curSymptoms = 0;
                }
        },
        nextQuestion() {
            if (this.selectedResponse !== '') {
                this.curSymptoms += 1;
                this.selectedResponse = '';

                // Optionally load the next symptom/question here
            }
        },
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
.radio {
    margin: 40px;
}
</style>
