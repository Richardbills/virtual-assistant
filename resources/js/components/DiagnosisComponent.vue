<template>
    <div class="assistant-component">
        <img id="assistant" src="/public/img/eb-assistant.png" alt="EB Assistant Animation">
        <hr>

        <h1><span>Let's get started</span></h1>
        <p>Feel free to summarize how you feel and let's help you identify what the issue might be</p>

        <form class="search-form" @submit.prevent="submitForm">
    <table class="table">
        <tbody>
            <tr>
                <!-- First column: Name -->
                <td class="form-group">
                    <label for="name">Name</label>
                    <input id="name" style="width: 100%;" placeholder="Rishi Eb" type="text" v-model="name" />
                </td>

                <!-- Second column: D.O.B -->
                <td class="form-group">
                    <label for="dob">D.O.B</label>
                    <input id="dob" type="date" style="width: 100%;" v-model="dob" />
                </td>

                <!-- Third column: Gender and Search -->
                <td class="form-group">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" v-model="gender" style="width: 100%; padding: 15px; background: #eee; border: 0; border-radius: 3px;">
                        <option value="" disabled>Select your gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
            <tr>
                 <td class="form-group" colspan="3">
                    <!-- Search input and button -->
                    <input placeholder="Search : I feel fed up with life" type="text" v-model="formData.search" style="width: 70%;" />
                    <button class="btn" type="submit" style="width: 20%; margin-top: 5px;"><i class="fa fa-search"></i></button><br>
                    <span v-if="message" v-html="message" style="color: red"></span>
                </td>
            </tr>
        </tbody>
    </table>
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
                    It seems to be you might be affected by issues. Such as <strong>{{ prediction }}</strong>/issue.
                    You are not alone dear, we are going to help you navigate thoughts like
                    <br>
                    <br>

                    <div v-html="similarSearch"></div>

                    <h4 style="color: #1b76d0"><br>Let's proceed with understanding how you feel with a few more
                        questions
                    </h4>
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
                name: '',
                gender: '',
                dob: ''
            },
            name: '',
            gender: '',
            dob: '',
            countdownKey: 0,
            prediction: ''
        };
    },
    mounted() {
        console.log('Assistant Component is mounted!');

        anime({
            targets: '#assistant',
            translateY: -30,
            duration: 1000,
        });
    },
    methods: {
        async submitForm() {
            if (this.formData.search.length > 1) {
                try {
                    // Send POST request to Laravel API
                    const response = await axios.post('/api/v1/assess-query', this.formData);

                    if (response.data.related_terms.length > 0) {
                        this.formData = { search: '' };
                        this.triggerModal();
                        this.responseFound = true;

                        this.similarSearch = "";
                        this.prediction = response.data.prediction;
                        response.data.related_terms.forEach(res => {
                            this.similarSearch += "<h4 style='color: #000 !important; font-size: 12px; margin: 2px;' class='badge badge-warning'><strong><i>" + res + " ...</i></strong></h4>";
                        });
                    }
                    else {
                        this.message = "Oh! sorry, am unable to continue with your diagnosis"
                    }
                } catch (error) {
                    // Handle errors
                    if (error.response && error.response.data) {
                        this.message = error.response.data.message || 'An error occurred';
                    } else {
                        this.message = 'An error occurred';
                    }
                }
            }
            else{
                this.message = "Oh! sorry, seems there are missing fields"
            }
        },
        triggerModal() {
            if ('' != this.name && '' != this.gender && '' != this.name) {
                $('#AssistantModal').modal()
                this.resetCountdown()
            }

        },
        onCountdownFinished() {
            if (this.responseFound) {
                if ('' != this.name && '' != this.gender && '' != this.name) {
                    $('#AssistantModal').modal('toggle')
                    this.proceedToDiagnosis();
                }
                else {
                    this.message = "Oh! sorry, seems there are missing fields"
                }
            }
        },
        resetCountdown() {
            this.countdownKey += 1; // Increment the key to reset the countdown
        },
        proceedToDiagnosis() {
            // Navigate to next page
            this.$router.push({
                path: '/assessment',
                query: { name: this.name, gender: this.gender, dob: this.dob }
            });
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
