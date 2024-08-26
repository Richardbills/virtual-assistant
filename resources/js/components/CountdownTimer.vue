<template>
    <div>
      Continue in {{ timeLeft }}s ...
    </div>
  </template>

  <script>
  export default {
    name: 'CountdownTimer',
    data() {
      return {
        timeLeft: 5,
        timer: null,
      };
    },
    mounted() {
      this.startCountdown();
    },
    methods: {
      startCountdown() {
        this.timer = setInterval(() => {
          if (this.timeLeft > 0) {
            this.timeLeft--;
          } else {
            clearInterval(this.timer);
            this.timer = null;
            this.$emit('countdown-finished'); // Emit an event when countdown finishes
          }
        }, 1000);
      },
    },
    beforeDestroy() {
      if (this.timer) {
        clearInterval(this.timer);
      }
    },
  };
  </script>

  <style scoped>
  p {
    font-size: 2em;
    text-align: center;
  }
  </style>
