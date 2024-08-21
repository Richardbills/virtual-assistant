<template>

    <div class="assessment-component" style="text-align: left;">
        <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
        <br><br>

        <h1 style="text-align: left;"><span>Kindly answer <br>the following questions</span></h1>
        <span>Respond with a Yes / No</span>

        <div id="questionContainer" v-if="symptoms.length > 0">
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
            symptoms : [[]],
            ids : [],
            curSymptom : 0,
            totalSymptoms : 0,
            selectedResponse: '',
            responseMessage : '',
            curType : 'common'
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
                // (this.curSymptom == 0)?'0':this.ids[this.curSymptom++]+"
                console.log("/api/v1/fetch-common-symptoms?type="+this.curType+"&id="+this.curSymptom);

                // Send POST request to Laravel APIdd
                const response = await axios
                .get("/api/v1/fetch-common-symptoms?type="+this.curType+"&id="+this.curSymptom);

                if (response.data.question) {
                    this.symptoms = [response.data.question];
                    this.totalSymptoms = response.data.count;
                    this.ids = response.data.ids

                    this.curType = response.data.question.type
                    this.curId = response.data.question.id

                    if(this.curSymptom >= this.ids.length && null == this.question)
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
            if (this.selectedResponse !== '' && this.curSymptom < this.ids.length) {
                this.curSymptom += 1;
                this.selectedResponse = '';

                this.fetchGeneralSymptoms()
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
.radio {
  transform: scale(3.5);
  margin: 40px;
}

label {
  cursor: pointer;
}
</style>
