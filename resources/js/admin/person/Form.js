import AppForm from '../app-components/Form/AppForm';

Vue.component('person-form', {
    mixins: [AppForm],
    props: [
        'availableSpecialties',
         'availableTypeOfPeople'
    ],
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
                specialties: '',
                typesOfPeople: '' ,
            }
        }
    }

});