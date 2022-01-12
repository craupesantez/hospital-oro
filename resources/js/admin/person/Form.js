import AppForm from '../app-components/Form/AppForm';

Vue.component('person-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                firt_name:  '' ,
                last_name:  '' ,
                identification:  '' ,
                email:  '' ,
                telephone:  '' ,
                address:  '' ,
                birthday:  '' ,
                gender:  '' ,
                id_cities:  '' ,
                
            }
        }
    }

});