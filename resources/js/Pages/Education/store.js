import { writable } from 'svelte/store';


export const pageprops = writable({

    header: {
        list:"List of Education Levels",
        new:"New Education Level",
        show:"Education Level Properties",
        update:"Update Education Level Properties"
    },

    table: {

        filter:{
            placeholder:"Keyword ..."
        },

        thead :[
            "Id",
            "Education Level Title",
            "Created At",
            "Actions"
        ],

        tfoot: [
            "Id",
            "Education Level Title",
            "Created At",
            "Actions"          
        ]      
    },

    form:{

        title:{
            label:'Education Level Title',
            placeholder:'Enter education title ...'
        },

        remarks:{
            id:"ed10",
            label:"Education Level Description, Details and Remarks",
            placeholder:"Enter education level description, details and remarks ... ",
            content:''
        },

        submit :{
            new :{
              label:"Create"
            },
        
            update:{
              label:"Update"
            }
        }

    },

  
    commands:{
        add:{
            label:"Add Education"
        },

    }
})


export let iconprops = writable({
    size:'S',
    color:'link'
})