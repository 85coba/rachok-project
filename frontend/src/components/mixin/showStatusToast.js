export default {
    methods: {
        showErrorMessage(message) {
            this.$toast.error(message, {
                queueable: true
              });
        },

        showSuccessMessage(message) {
            this.$toast.success(message, {
                queueable: true
              });
        },
    }
};
