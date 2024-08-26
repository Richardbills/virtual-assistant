<template>

    <div class="assessment-component" style="text-align: left;">


        <div v-if="!ready">
            <h1 style="text-align: left; font-style: italic;"><span>There is about <br><span style="color: #1b76d0; font-size: 40px;">{{Math.round($route.query.percentage)}}% chance we diagnose</span> you correctly...</span></h1>
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
                <h4 style="font-size: 15px;">{{ pos }} / {{ totalSymptoms }}</h4>

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
            pos : -1,
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

        this.sessionId = this.$route.query.sessionId;

        // Generate unique session identifier
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
                // Send POST request to Laravel API
                if(this.ids.length > 0)
                {
                    this.curSymptom = this.ids[this.pos];

                    if(parseInt(this.pos) >= parseInt(this.totalSymptoms))
                    {
                        this.assessmentStatus = "completed";
                        this.curSymptom = this.ids[this.pos-1];
                    }
                }

                const response = await axios.get("/api/v1/fetch-streamline-symptoms?type="+this.curType+"&id="+this.curSymptom+"&session_id="+this.sessionId+"&question_id="+this.curSymptom+"&answer="+this.selectedResponse+"&flag="+this.assessmentStatus);

                if (response.data.question) {
                    this.symptoms = [response.data.question];
                    this.totalSymptoms = response.data.count;
                    this.ids = response.data.ids
                    this.pos += 1;

                    this.curType = response.data.question.type
                    this.curId = response.data.question.id

                    if(this.totalSymptoms > 0 && this.pos > this.totalSymptoms)
                    {
                        this.$router.push({
                            path: '/result',
                            query: { sessionId: this.sessionId }
                        });
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
            if (this.selectedResponse !== '' && (parseInt(this.pos) <= parseInt(this.totalSymptoms))) {
                this.fetchGeneralSymptoms()
            }
        },
        onCountdownFinished() {
            this.ready = true
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
