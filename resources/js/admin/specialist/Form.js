import AppForm from '../app-components/Form/AppForm';

Vue.component('specialist-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                id_person:  '' ,
                id_specialities:  '' ,
                year_of_specialization:  '' ,
                institution:  '' ,
                
            }
        }
    }

});