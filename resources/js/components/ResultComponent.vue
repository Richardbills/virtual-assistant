<template>

    <div class="assessment-component" style="text-align: left;">

        <div>
            <router-link to="/diagnosis"><i class="fa fa-arrow-left"></i> Go back to diagnosis | Restart</router-link>
            <br><br>

            <img id="assistant" src="/public/img/eb-assistant.png" alt="RI Assistant Animation">
            <br><br>
            <hr><br>



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
            selectedResponse: '',
            responseMessage : '',
            curType : 'common',
            sessionId : '',
        };
    },
    async mounted() {
        console.log('Assessment Result Component is mounted!');

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
                        console.log("completed on :" + this.pos)
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
                        this.$router.push('/result');
                    }
                }
                else {
                    this.responseMessage = 'No symptoms loaded';
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
