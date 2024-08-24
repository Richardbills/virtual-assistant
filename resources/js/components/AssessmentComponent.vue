<template>

    <div class="assessment-component" style="text-align: left;">
        <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
        <br><br>

        <div id="questionContainer" v-if="symptoms.length > 0 && assessmentStatus != 'completed'">
        <h1 style="text-align: left;"><span>Kindly answer <br>the following questions</span></h1>
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

</template>

<script>
import axios from 'axios';

export default {
    name: 'AssessmentComponent',
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
            trueAnswers : 0
        };
    },
    async mounted() {
        console.log('Assessment Component is mounted!');

        // Generate unique session identifier
        this.sessionId = await this.generateUniqueId();
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
                    if(this.curSymptom === this.ids.length)
                    {
                        this.assessmentStatus = "completed";
                    }
                }

                if(this.selectedResponse == "YES") {this.trueAnswers +=1 }

                const response = await axios.get("/api/v1/fetch-common-symptoms?type="+this.curType+"&id="+this.curSymptom+"&session_id="+this.sessionId+"&question_id="+this.curSymptom+"&answer="+this.selectedResponse+"&flag="+this.assessmentStatus);

                if (response.data.question) {
                    this.symptoms = [response.data.question];
                    this.totalSymptoms = response.data.count;
                    this.ids = response.data.ids
                    this.curSymptom += 1;

                    this.curType = response.data.question.type
                    this.curId = response.data.question.id

                    var accuracy = parseInt(this.trueAnswers)/parseInt(this.totalSymptoms)
                    console.log(accuracy)

                    if(this.ids.length > 0 && this.curSymptom > this.ids.length)
                    {
                        if(accuracy >= 0.71)
                        {
                            this.$router.push({
                                path: '/assessment-streamline',
                                query: { sessionId: this.sessionId, percentage : (this.trueAnswers/this.totalSymptoms)*100 }
                            });
                        }
                        else{
                            this.$router.push({
                                path: '/assessment-break',
                                query: { sessionId: this.sessionId, percentage : (this.trueAnswers/this.totalSymptoms)*100 }
                            });
                        }
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
        async generateUniqueId(length = 16) {
            // Characters to use for the identifier
            const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            let result = '';

            // Add randomness using current time
            const datePart = Date.now().toString(36); // Base36 for compactness
            result += datePart;

            // Generate random characters
            for (let i = result.length; i < length; i++) {
                const randomIndex = Math.floor(Math.random() * chars.length);
                result += chars[randomIndex];
            }

            // Return the unique identifier, trimmed to the desired length
            return result.substr(0, length);
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
