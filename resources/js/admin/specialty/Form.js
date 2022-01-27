import AppForm from '../app-components/Form/AppForm';

Vue.component('specialty-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                status:  '' ,
                 user_registration:  '' ,
                 user_modification:  '' ,
                
            }
        }
    }

});