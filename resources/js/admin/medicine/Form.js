import AppForm from '../app-components/Form/AppForm';

Vue.component('medicine-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                indications:  '' ,
                amount:  '' ,
                measure:  '' ,
                
            }
        }
    }

});