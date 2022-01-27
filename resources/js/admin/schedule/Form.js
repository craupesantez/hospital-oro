import AppForm from '../app-components/Form/AppForm';

Vue.component('schedule-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name: '',
                hour_start:  '' ,
                hour_end:  '' ,
                
            }
        }
    }

});