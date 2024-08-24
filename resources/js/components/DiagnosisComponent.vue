<template>
    <div class="assistant-component">
        <img id="assistant" src="/public/img/eb-assistant.png" alt="EB Assistant Animation">
        <br><br>
        <hr><br>

        <h1><span>Let's get started</span></h1>
        <p>Feel free to summarize how you feel and let's help you identify what the issue might be</p>

        <form class="search-form" @submit.prevent="submitForm">
            <input placeholder="Search : I feel fed up with life" type="text" v-model="formData.search">
            <button class="btn" type="submit"><i class="fa fa-search"></i></button>
            <span v-if="message">{{ message }}</span>
        </form>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="AssistantModal" tabindex="-1" role="dialog" aria-labelledby="AssistantModalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-left" style="color: #000">

                    <img class="modal-title" src="/public/img/eb-assistant-bare.png" alt="EB Assistant Animation">
                    <br><br>
                    You are not alone dear, we are going to help you navigate thoughts like
                    <br>
                    <br>

                    <div v-html="similarSearch"></div>

                    <h4 style="color: #1b76d0">Let's proceed in understanding how you feel with a few more questions</h4>
                    <br>

                   <CountdownTimer :key="countdownKey" @countdown-finished="onCountdownFinished" />
                </div>
            </div>
        </div>
    </div>
    <!-- End of Modal -->

</template>

<script>
import axios from 'axios';
import CountdownTimer from './CountdownTimer.vue';

export default {
    components: {
        CountdownTimer,
    },
    name: 'DiagnosisComponent',
    data() {
        return {
            message: '',
            similarSearch: '',
            formData: {
                search: '',
            },
            countdownKey: 0,
        };
    },
    mounted() {
        console.log('Assistant Component is mounted!');
        anime({
            targets: '#assistant',
            translateY: 50,
            duration: 1000,
        });
    },
    methods: {
        async submitForm() {
            if (this.formData.search.length > 1) {
                try {
                    // Send POST request to Laravel API
                    const response = await axios.post('/api/v1/assess-query', this.formData);

                    if (response.data.length > 0) {
                        this.formData = { search: '' };
                        this.triggerModal();
                        this.responseFound = true;

                        this.similarSearch = "";
                        response.data.forEach(res => {
                            this.similarSearch += "<h4 style='color: #000 !important'><strong><i>" + res + " ...</i></strong></h4><br>";
                        });
                    }
                    else {
                        this.message = "Oh! sorry, am unable to continue with your diagnosis"
                    }
                } catch (error) {
                    // Handle errors
                    if (error.response && error.response.data) {
                        this.responseMessage = error.response.data.message || 'An error occurred';
                    } else {
                        this.responseMessage = 'An error occurred';
                    }
                }
            }
        },
        triggerModal() {
            $('#AssistantModal').modal()
            this.resetCountdown()
        },
        onCountdownFinished() {
            if(this.responseFound)
            {
                $('#AssistantModal').modal('toggle')
                this.proceedToDiagnosis();
            }
            else{
                this.resetCountdown()
            }
        },
        resetCountdown() {
            this.countdownKey += 1; // Increment the key to reset the countdown
        },
        proceedToDiagnosis() {
            // Navigate to next page
            this.$router.push('/assessment');
        },
    }
}
</script>

<style scoped>
.assistant-component {
    text-align: center;
    padding: 20px;
    font-family: Arial, sans-serif;
}

#message {
    color: red;
    font-weight: bold;
}
</style>
