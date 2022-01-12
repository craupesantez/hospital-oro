import AppForm from '../app-components/Form/AppForm';

Vue.component('type-person-has-person-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                id_person:  '' ,
                id_type_of_people:  '' ,
                
            }
        }
    }

});