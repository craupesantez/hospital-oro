<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'last_login_at' => 'Last login',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'role' => [
        'title' => 'Roles',

        'actions' => [
            'index' => 'Roles',
            'create' => 'New Role',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'guard_name' => 'Guard name',
            
        ],
    ],

    'city' => [
        'title' => 'Cities',

        'actions' => [
            'index' => 'Cities',
            'create' => 'New City',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'postal_code' => 'Postal code',
            
        ],
    ],

    'specialty' => [
        'title' => 'Specialties',

        'actions' => [
            'index' => 'Specialties',
            'create' => 'New Specialty',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'status' => 'Status',
            'user_registration' => 'User registration',
            'user_modification' => 'User modification',
            
        ],
    ],

    'exam' => [
        'title' => 'Exams',

        'actions' => [
            'index' => 'Exams',
            'create' => 'New Exam',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'person' => [
        'title' => 'Persons',

        'actions' => [
            'index' => 'Persons',
            'create' => 'New Person',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'firt_name' => 'Firt name',
            'last_name' => 'Last name',
            'identification' => 'Identification',
            'email' => 'Email',
            'telephone' => 'Telephone',
            'address' => 'Address',
            'birthday' => 'Birthday',
            'gender' => 'Gender',
            'id_cities' => 'City',
            
        ],
    ],

    'type-person-has-person' => [
        'title' => 'Type Person Has Person',

        'actions' => [
            'index' => 'Type Person Has Person',
            'create' => 'New Type Person Has Person',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'id_person' => 'Id person',
            'id_type_of_people' => 'Id type of people',
            
        ],
    ],

    'schedule' => [
        'title' => 'Schedule',

        'actions' => [
            'index' => 'Schedule',
            'create' => 'New Schedule',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'hour_start' => 'Hour start',
            'hour_end' => 'Hour end',
            
        ],
    ],

    'appointment' => [
        'title' => 'Appointments',

        'actions' => [
            'index' => 'Appointments',
            'create' => 'New Appointment',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'status' => 'Status',
            'prescription' => 'Prescription',
            'comment' => 'Comment',
            'diagnosis' => 'Diagnosis',
            'reason' => 'Reason',
            'id_person' => 'Id person',
            'id_specialist' => 'Id specialist',
            
        ],
    ],

    'types-of-person' => [
        'title' => 'Types Of People',

        'actions' => [
            'index' => 'Types Of People',
            'create' => 'New Types Of Person',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'specialist' => [
        'title' => 'Specialists',

        'actions' => [
            'index' => 'Specialists',
            'create' => 'New Specialist',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'id_person' => 'Id person',
            'id_specialities' => 'Id specialities',
            'year_of_specialization' => 'Year of specialization',
            'institution' => 'Institution',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];