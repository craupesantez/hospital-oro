import AppForm from '../app-components/Form/AppForm';

Vue.component('appointment-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                status:  '' ,
                prescription:  '' ,
                comment:  '' ,
                diagnosis:  '' ,
                reason:  '' ,
                id_person:  '' ,
                id_specialist:  '' ,
                
            }
        }
    }

});