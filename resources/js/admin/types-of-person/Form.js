import AppForm from '../app-components/Form/AppForm';

Vue.component('types-of-person-form', {
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