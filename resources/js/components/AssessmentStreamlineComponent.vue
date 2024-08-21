<template>

    <div class="assessment-component" style="text-align: left;">


        <div v-if="!ready">
            <h1 style="text-align: left; font-style: italic;"><span>There is about <br><span style="color: #1b76d0; font-size: 40px;">80% chance we diagnose</span> you correctly...</span></h1>
            <CountdownTimer :key="countdownKey" @countdown-finished="onCountdownFinished" />
            <br><br>
        </div>

        <div v-if="ready">
            <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
            <br><br>

            <div id="questionContainer" v-if="symptoms.length > 0 && assessmentStatus != 'completed'">
            <h1 style="text-align: left;"><span>Kindly answer <br>the following streamlining questions</span></h1>
            <span>Respond with a Yes / No</span>

            <hr>
                <!-- Question goes here ... -->
                <h2>{{ symptoms[0].question }}</h2>
                <br>
                <h6>{{ symptoms[0].description }}</h6>
                <br>
                <h4 style="font-size: 15px;">{{ curSymptom }} / {{ totalSymptoms }}</h4>

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
    </div>

</template>

<script>
import axios from 'axios';
import CountdownTimer from './CountdownTimer.vue';

export default {
    name: 'AssessmentStreamlineComponent',
    components : {
        CountdownTimer
    },
    data() {
        return {
            symptoms : [],
            ids : [],
            curSymptom : 0,
            totalSymptoms : 0,
            selectedResponse: '',
            responseMessage : '',
            curType : 'common',
            sessionId : '',
            assessmentStatus : "in-progress",
            countdownKey: 0,
            ready : false
        };
    },
    async mounted() {
        console.log('Assessment Streamline Component is mounted!');

        // Generate unique session identifierfff
        this.fetchGeneralSymptoms();

        anime({
            targets: '.assessment-component',
            translateY: 30,
            duration: 9000,
        });
    },
    methods: {
        async fetchGeneralSymptoms() {
            try {
                console.log(this.curSymptom)
                console.log(this.ids.length)
                // Send POST request to Laravel API
                if(this.ids.length > 0)
                {
                    if(this.curSymptom === this.ids.length)
                    {
                        this.assessmentStatus = "completed";
                    }
                }

                const response = await axios.get("/api/v1/fetch-common-symptoms?type="+this.curType+"&id="+this.curSymptom+"&session_id="+this.sessionId+"&question_id="+this.curSymptom+"&answer="+this.selectedResponse+"&flag="+this.assessmentStatus);

                if (response.data.question) {
                    this.symptoms = [response.data.question];
                    this.totalSymptoms = response.data.count;
                    this.ids = response.data.ids
                    this.curSymptom += 1;

                    this.curType = response.data.question.type
                    this.curId = response.data.question.id

                    if(this.ids.length > 0 && this.curSymptom > this.ids.length)
                    {
                        // New phase
                        alert("Next")
                    }
                }
                else {
                    this.responseMessage = 'No symptoms loaded';
                }
            } catch (error) {
                // Handle errors
                this.responseMessage = error.response?.data?.message || 'An error occurred';
            }
        },
        nextQuestion() {
            if (this.selectedResponse !== '' && this.curSymptom <= this.ids.length) {
                this.fetchGeneralSymptoms()
            }
        },
        onCountdownFinished() {
            this.ready = true
            this.resetCountdown()
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
.radio {
  transform: scale(3.5);
  margin: 40px;
}

label {
  cursor: pointer;
}
</style>
