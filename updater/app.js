const { createApp } = Vue

  createApp({
    data() {
      return {
        iframeAddress : '/autovmupdatepage.php',
        ActonResponse : null,
      }
    },

    methods: {
        funcDelete() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'delete'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data;
            console.log(response.data);
          })
          .catch(error => {
            // Handle errors
            console.error(error);
          });
        }, 

        funcInstall() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'install'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data;
            console.log(response.data);
          })
          .catch(error => {
            // Handle errors
            console.error(error);
          });
        },

        funcUpdate() {
          axios.post('./autovmupdatefunc.php', {funcmethod: 'update'})
          .then(response => {
            // Handle the response from the server
            this.ActonResponse = response.data;
            console.log(response.data);
          })
          .catch(error => {
            // Handle errors
            console.error(error);
          });
        }
    },

  }).mount('#app')