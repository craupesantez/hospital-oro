import AppForm from '../app-components/Form/AppForm';

Vue.component('exam-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                description:  '' ,
                
            }
        }
    }

});